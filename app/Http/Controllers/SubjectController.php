<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubject;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Grade $grade)
    {
        $teachers = User::type(User::TEACHER)->get()->pluck('name', 'id');
        $subjects = $grade->subjects()->with('teacher')->get();

        return view('grade.subject.index', compact('grade', 'teachers', 'subjects'));
    }

    public function store(Grade $grade, StoreSubject $request)
    {
        $grade->subjects()->create($request->data());

        return redirect()->route('grade.subject.index', $grade->slug)->withSuccess(trans('messages.create_success', [ 'entity' => 'Subject' ]));
    }

    public function destroy(Grade $grade, Subject $subject)
    {
        $subject = $grade->subjects()->find($subject->id);
        if ($subject)
        {
            $subject->delete();
            return redirect()->route('grade.subject.index', $grade->slug)->withSuccess(trans('messages.create_success', [ 'entity' => 'Subject' ]));
        }
        abort('404');
    }
}
