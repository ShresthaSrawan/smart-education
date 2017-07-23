<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacher;
use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return Datatables::of(User::type(User::TEACHER))->make(true);
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
     * @param StoreUser $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        DB::transaction(function () use ($request)
        {
            $user = User::create($request->data());
            $user->attachRole(User::TEACHER);
        });

        return redirect()->route('teacher.index')->withSuccess(trans('messages.create.success', [ 'entity' => 'Admin' ]));
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

        return redirect()->route('teacher.index')->withSuccess(trans('messages.update_success', [ 'entity' => 'Teacher' ]));
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('teacher.index')->withSuccess(trans('messages.delete_success', [ 'entity' => 'Teacher' ]));
    }
};
