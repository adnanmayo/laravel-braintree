<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //

    public function index()
    {
        $users =  User::with('payments')->get();
        return view('admin.users.index', ['users' => $users]);
    }
}
