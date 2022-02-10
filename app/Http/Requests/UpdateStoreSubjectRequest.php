<?php

namespace App\Http\Requests;

use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateStoreSubjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function index()
    {
        $subjects = Subject::with('masters', 'specialities', 'diplomas')->get();
        return $subjects;
    }

    public function store(Request $request)
    {
        $subject = Subject::create($request->only('name'));
        $subject->masters()->attach($request->get('masters'));
        $subject->diplomas()->attach($request->get('diplomas'));
        $subject->specialities()->attach($request->get('specialities'));

        $subject->masters;
        $subject->diplomas;
        $subject->specialities;
        
        return $subject;
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->only('name'));

        $subject->masters()->detach();
        $subject->diplomas()->detach();
        $subject->specialities()->detach();

        $subject->masters()->attach($request->get('masters'));
        $subject->diplomas()->attach($request->get('diplomas'));
        $subject->specialities()->attach($request->get('specialities'));

        return $subject;
    }
}
