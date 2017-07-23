<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrade;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class GradeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $classTeachers = array_filter(Grade::pluck('class_teacher_id')->unique()->toArray());
        $teachers      = User::type(User::TEACHER)->whereNotIn('id', $classTeachers)->get();

        return view('grade.index', compact('teachers'));
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        return Datatables::of(Grade::with(['classTeacher', 'subjects']))->make(true);
    }

    /**
     * @param StoreGrade $request
     * @return mixed
     */
    public function store(StoreGrade $request)
    {
        DB::transaction(function () use ($request)
        {
            $grade = Grade::create($request->data());
        });

        return redirect()->route('grade.index')->withSuccess(trans('messages.create.success', [ 'entity' => 'Grade' ]));
    }
}
