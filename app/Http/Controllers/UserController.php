<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index_user()
    {
        $users = User::all();
        return view('dashboard.data_user', compact('users'));
    }
}
