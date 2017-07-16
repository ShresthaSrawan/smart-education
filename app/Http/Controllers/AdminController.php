<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        return Datatables::eloquent(User::hasRole('admin'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreAdmin|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmin $request)
    {
        User::create($request->data());

        return redirect('admin.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Admin' ]));
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.show', compact($user));
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.edit', compact($user));
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

        return redirect('admin.index')->withSuccess(trans('messages.update_success', [ 'entity' => 'Admin' ]));
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('admin.index')->withSuccess(trans('messages.delete_success', [ 'entity' => 'Admin' ]));
    }
}
