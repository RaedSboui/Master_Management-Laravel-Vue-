<?php

namespace App\Exports;

use App\Models\Candidacy;
use App\Models\Choice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;



class CandidaciesExport implements FromCollection, WithMapping, WithHeadings
{
    protected $masterID;

    public function __construct($masterID)
    {
        $this->masterID = $masterID;
    }

    public function collection()
    {
        $candidacy = Choice::where('master_id', $this->masterID)->get('candidacy_id');
        return Candidacy::whereIn('id', $candidacy)->with('study', 'higherStudies', 'choices')->get();            
    }

    public function map($candidacy) : array {
        return [
            //Candidacy
            $candidacy->id,
            $candidacy->identity,
            $candidacy->firstName,
            $candidacy->lastName,
            $candidacy->dateOfBirth,
            $candidacy->placeOfBirth,
            $candidacy->nationality,
            $candidacy->address,
            $candidacy->country,
            $candidacy->government,
            $candidacy->city,
            $candidacy->postalCode,
            $candidacy->phone,
            $candidacy->email,
            $candidacy->sfe,

            //Study
            $candidacy->study->baccalaureateYear,
            $candidacy->study->baccalaureateAverage,
            $candidacy->study->nbOfRepetitionsFromBaccalaureate,
            $candidacy->study->preparatory,
            $candidacy->study->nbOfRepetitionsInPreparatory,
            $candidacy->study->nbOfRegistrationWithdrawals,
            $candidacy->study->yearOfGraduation,
            $candidacy->study->professionalSituation,
            $candidacy->study->numberOfInternships,
            $candidacy->study->diploma->name,
            $candidacy->study->otherSpeciality ? $candidacy->study->otherSpeciality : $candidacy->study->speciality->name,
            $candidacy->study->otherEstablishment ? $candidacy->study->otherEstablishment : $candidacy->study->establishment->name,
            
            //HIgher Study
            $candidacy->higherStudies[0]->schoolYear,
            $candidacy->higherStudies[0]->level,
            $candidacy->higherStudies[0]->establishment_id ? $candidacy->higherStudies[0]->establishment->name : $candidacy->study->otherEstablishment,
            $candidacy->higherStudies[0]->continuingStudies,
            $candidacy->higherStudies[0]->mean,
            $candidacy->higherStudies[0]->redouble,
            $candidacy->higherStudies[0]->mention,
            $candidacy->higherStudies[0]->session,

            $candidacy->higherStudies[1]->schoolYear,
            $candidacy->higherStudies[1]->level,
            $candidacy->higherStudies[1]->establishment_id ? $candidacy->higherStudies[1]->establishment->name : $candidacy->study->otherEstablishment,
            $candidacy->higherStudies[1]->continuingStudies,
            $candidacy->higherStudies[1]->mean,
            $candidacy->higherStudies[1]->redouble,
            $candidacy->higherStudies[1]->mention,
            $candidacy->higherStudies[1]->session,

            isset($candidacy->higherStudies[2]) ? $candidacy->higherStudies[2]->schoolYear : '',
            isset($candidacy->higherStudies[2]) ? $candidacy->higherStudies[2]->level : '',
            isset($candidacy->higherStudies[2]) ? ($candidacy->higherStudies[2]->establishment_id ? $candidacy->higherStudies[2]->establishment->name : $candidacy->study->otherEstablishment) : '',
            isset($candidacy->higherStudies[2]) ? $candidacy->higherStudies[2]->continuingStudies : '',
            isset($candidacy->higherStudies[2]) ? $candidacy->higherStudies[2]->mean : '',
            isset($candidacy->higherStudies[2]) ? $candidacy->higherStudies[2]->redouble : '',
            isset($candidacy->higherStudies[2]) ? $candidacy->higherStudies[2]->mention : '',
            isset($candidacy->higherStudies[2]) ? $candidacy->higherStudies[2]->session : '',

            isset($candidacy->higherStudies[3]) ? $candidacy->higherStudies[3]->schoolYear : '',
            isset($candidacy->higherStudies[3]) ? $candidacy->higherStudies[3]->level : '',
            isset($candidacy->higherStudies[3]) ? ($candidacy->higherStudies[2]->establishment_id ? $candidacy->higherStudies[3]->establishment->name : $candidacy->study->otherEstablishment) : '',
            isset($candidacy->higherStudies[3]) ? $candidacy->higherStudies[3]->continuingStudies : '',
            isset($candidacy->higherStudies[3]) ? $candidacy->higherStudies[3]->mean : '',
            isset($candidacy->higherStudies[3]) ? $candidacy->higherStudies[3]->redouble : '',
            isset($candidacy->higherStudies[3]) ? $candidacy->higherStudies[3]->mention : '',
            isset($candidacy->higherStudies[3]) ? $candidacy->higherStudies[3]->session : '',

            //Choices
            $candidacy->choices[0]->master->title,
            $candidacy->choices[1]->master->title,
            isset($candidacy->choices[2]->master->title) ? $candidacy->choices[2]->master->title : '',

            
            $candidacy->created_at,
            $candidacy->updated_at,
        ] ;
    }

    public function headings(): array
    {
        return [
            //Candidacy
            'id',
            'Identity',
            'First Name',
            'Last Name',
            'Date Of Birth',
            'Place Of Birth',
            'Nationality',
            'Address',
            'Country',
            'Government',
            'City',
            'Postal Code',
            'Phone',
            'E-mail',
            'SFE Note',

            //Study
            'Baccalaureate Year',
            'Baccalaureate Average',
            'Number Of Repetitions From Baccalaureate',
            'Preparatory',
            'Number Of Repetitions In Preparatory',
            'Number Of Registration With Drawals',
            'Year Of Graduation',
            'Professional Situation',
            'Number Of Internships',
            'Diploma',
            'Speciality',
            'Establishment',

            //HIgher Study
            'School Year 1',
            'Level 1',
            'Establishment 1',
            'Continuing Studies 1',
            'Mean 1',
            'Redouble 1',
            'Mention 1',
            'Session 1',

            'School Year 2',
            'Level 2',
            'Establishment 2',
            'Continuing Studies 2',
            'Mean 2',
            'Redouble 2',
            'Mention 2',
            'Session 2',

            'School Year 3',
            'Level 3',
            'Establishment 3',
            'Continuing Studies 3',
            'Mean 3',
            'Redouble 3',
            'Mention 3',
            'Session 3',

            'School Year 4',
            'Level 4',
            'Establishment 4',
            'Continuing Studies 4',
            'Mean 4',
            'Redouble 4',
            'Mention 4',
            'Session 4',

            //Choices
            'Choice 1',
            'Choice 2',
            'Choice 3',

            'Created at',
            'Updated at',
            'result'
        ];
    }
}
