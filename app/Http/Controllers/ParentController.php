<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParent;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parent.index');
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        return Datatables::eloquent(User::hasRole('parent'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parent.create');
    }

    /**
     * Store a newly created resource in storage.;
     * @param StoreParent|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParent $request)
    {
        User::create($request->data());

        return redirect('parent.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Parent' ]));
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('parent.show', compact($user));
    }

    /**
     * Show the form for editing the specified resource.;
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('parent.edit', compact($user));
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

        return redirect('parent.index')->withSuccess(trans('messages.update_success', [ 'entity' => 'Parent' ]));
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('parent.index')->withSuccess(trans('messages.delete_success', [ 'entity' => 'Parent' ]));
    }
};
