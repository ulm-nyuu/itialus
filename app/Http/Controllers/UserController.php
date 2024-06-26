<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class UserController extends Controller
{

    public function getUsers(){
        return User::all();
    }

    public function getCurrentUser(){
        return response()->json(Auth::user());
    }
    
    public function logout(){
        Auth::logout();
        return \Redirect::to('/login');
    }
}
