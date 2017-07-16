<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.index');
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        return Datatables::eloquent(User::hasRole('teacher'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.;
     * @param StoreTeacher|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacher $request)
    {
        User::create($request->data());

        return redirect('teacher.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Teacher' ]));
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('teacher.show', compact($user));
    }

    /**
     * Show the form for editing the specified resource.;
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('teacher.edit', compact($user));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->data());

        return redirect('teacher.index')->withSuccess(trans('messages.update_success', [ 'entity' => 'Teacher' ]));
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('teacher.index')->withSuccess(trans('messages.delete_success', [ 'entity' => 'Teacher' ]));
    }
};
