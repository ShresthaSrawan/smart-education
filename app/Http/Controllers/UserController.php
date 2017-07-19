<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        $users = User::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get()
            ->map(function($user){
                return [
                    'code' => $user->email,
                    'name' => $user->name
                ];
            });

        return $users;
    }
}
