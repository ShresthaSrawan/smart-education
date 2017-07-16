<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        return Datatables::eloquent(User::with('role'))->make(true);
    }

    public function create()
    {
        if (auth()->user()->isRole('admin'))
        {
            $roles = Role::all();
        }
        elseif (auth()->user()->isRole('teacher') && auth()->user()->is_grade_assigned)
        {
            $roles = Role::where('slug', '<>', 'admin')->get();
        }
        else
        {
            $roles = Role::where('slug', 'parent')->get();
        }

        return view('user.create', compact('roles'));
    }
}
