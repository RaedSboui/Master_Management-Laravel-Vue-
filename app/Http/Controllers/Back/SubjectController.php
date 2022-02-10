<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoreSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = (new UpdateStoreSubjectRequest)->index();
        return response()->json(['subjects' => $subjects]);
    }

    public function store(UpdateStoreSubjectRequest $request)
    {
        $subject = (new UpdateStoreSubjectRequest)->store($request);
        return response()->json(['message'=>'Subject created succesfully !', 'subject'=>$subject]);
    }

    public function update(UpdateStoreSubjectRequest $request, Subject $subject)
    {
        $subject = (new UpdateStoreSubjectRequest)->update($request, $subject);
        return response()->json(['message'=>'Subject updated succesfully !', 'subject'=>$subject]);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(['message'=>'Subject deleted succesfully !']);
    }

    public function deleteMultiple($subjects)
    {
        Subject::whereIn('id', $subjects = explode(',', $subjects))->delete();
        return response()->json(['message'=>count($subjects).' Selected Subjects deleted succesfully !']);
    }
}
