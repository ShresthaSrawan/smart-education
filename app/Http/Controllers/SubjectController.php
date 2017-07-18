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

        return view('grade.subject.index', compact('grade', 'teachers'));
    }

    public function data(Grade $grade)
    {
        return $grade->subjects()->with('teacher')->get();
    }

    public function store(Grade $grade, StoreSubject $request)
    {
        $grade->subjects()->create($request->data());
        $subjects = $this->data($grade);

        return [ 'status' => 'ok', 'subjects' => $subjects ];
    }

    public function destroy(Grade $grade, Subject $subject)
    {
        $subject = $grade->subjects()->find($subject->id);
        if ($subject)
        {
            $subject->delete();
            $subjects = $this->data($grade);

            return [ 'status' => 'ok', 'subjects' => $subjects ];
        }
        abort('404');
    }
}
