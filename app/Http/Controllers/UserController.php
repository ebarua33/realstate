<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function userIndex(){
        return view('user.user_home.index');
    }
}
