<?php

namespace App\Http\Requests;

use App\Models\Candidacy;
use App\Models\Candidate;
use App\Models\Choice;
use Illuminate\Support\Facades\Hash;
use App\Models\HigherStudy;
use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Mail\CandidateCredentialsMail;
use Illuminate\Support\Facades\Mail;

class UpdateStoreCandidacyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'candidacy' => [
                'identity'=>'required',
                'firstName'=>'required',
                'lastName'=>'required',
                'dateOfBirth'=>'required',
                'placeOfBirth'=>'required',
                'nationality'=>'required',
                'address'=>'required',
                'country'=>'required',
                'government'=>'required',
                'city'=>'required',
                'postalCode'=>'required',
                'phone'=>'required',
                'email'=>['required','email']
            ],
            'study' => [
                "baccalaureateYear"=>'required',
                "baccalaureateAverage"=>'required',
                "nbOfRepetitionsFromBaccalaureate"=>'required',
                "preparatory"=>'required',
                "nbOfRepetitionsInPreparatory"=>'required',
                "nbOfRegistrationWithdrawals"=>'required',
                "yearOfGraduation"=>'required',
                "professionalSituation"=>'required',
                "numberOfInternships"=>'required',
                //"speciality_id"=>'required',
                //"diploma_id"=>'required',
                //"establishment_id"=>'required'
            ],
            'higherStudies' => [
                "schoolYear"=>'required', 
                "level"=>'required',
                "continuingStudies"=>'required',
                "mean"=>'required',
                "redouble"=>'required',
                "mention"=>'required',
                "session"=>'required',
                //"establishment_id"=>'required'
            ],
            'choices' => [
                "choice"=>'required',
                "master_id"=>'required'
            ]
        ];
    }

    
    public function index()
    {
        $candidacies = Candidacy::orderBy('created_at', 'DESC')->with('study', 'higherStudies', 'choices')->get();

         $candidacies->each(function($candidacy,$key){
            $candidacy->choices->each(function($choice,$key){
                $choice->setAttribute('masterTitle',$choice->master['title']);
                unset($choice['master']);
            });
         }); 
         
        return $candidacies;
    }

    public function store(Request $request)
    {
        $candidacy = Candidacy::create($request->get('candidacy'));

        $password = uniqid();
        $candidate['candidacy_id'] = $candidacy->id;
        $candidate['identity'] = $candidacy->identity;
        $candidate['password'] =  $password;
        $candidate['password'] =  Hash::make($password);

        $newCandidate = Candidate::create($candidate);
        $newCandidate->password = $password;

        $newCandidate->name = $candidacy->firstName.' '.$candidacy->lastName;
        Mail::to($candidacy->email)->send(new CandidateCredentialsMail($newCandidate));

        $study = $request->get('study');
        $study['candidacy_id'] = $candidacy->id;
        Study::create($study);

        $higherStudies = $request->higherStudies;
        foreach($higherStudies as $higherStudy){
           $higherStudy['candidacy_id'] = $candidacy->id;
           HigherStudy::create($higherStudy);
        }

        $choices = $request->choices;
        foreach($choices as $choice){
            $choice['candidacy_id'] = $candidacy->id;
            Choice::create($choice);
        }

        return $newCandidate;
    }

    public function show(Candidacy $candidacy)
    {
        $this->study = $candidacy->study;
        if($this->study['otherEstablishment'] === null)$this->study->setAttribute('establishmentTitle',$this->study->establishment['name']);
        unset($this->study['establishment']);
        $this->study->diploma;
        if($this->study['otherSpeciality'] === null)$this->study->setAttribute('specialityTitle',$this->study->speciality['name']);
        unset($this->study['speciality']);


        $higherStudies = $candidacy->higherStudies;
        $higherStudies->each(function($higherStudy,$key){
            $higherStudy->setAttribute('establishmentTitle', $this->study['otherEstablishment'] ? $this->study['otherEstablishment'] : $higherStudy->establishment['name']);
            unset($higherStudy['establishment']);
        });
        

        $choices = $candidacy->choices;
        $choices->each(function($choice,$key){
            $choice->setAttribute('masterTitle',$choice->master['title']);
            unset($choice['master']);
        });
     

        unset($candidacy['study']);
        unset($candidacy['higherStudies']);
        unset($candidacy['choices']);

        return ['candidacy'=>$candidacy, 'study'=>$this->study, 'higherStudies'=>$higherStudies, 'choices'=>$choices];
    }

    public function update(Request $request, Candidacy $candidacy)
    {
        $candidacy->update($request->get('candidacy'));

        $study = Study::find($request->study['id']);
        $study->update($request->study);

        $higherStudies = $request->higherStudies;
        foreach($higherStudies as $higherStudy){
            $higherStudyToUpdate = HigherStudy::find($higherStudy['id']);
            $higherStudyToUpdate->update($higherStudy);
        }

        $choices = $request->choices;
        foreach($choices as $choice){
            $choiceToUpdate = Choice::where([
                ['candidacy_id',$candidacy->id], 
                ['choice',$choice['choice']]
            ]);
            $choiceToUpdate->update($choice);
        }
        
        return $candidacy;
    }
}
