<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getFormLogin()
    {
    	return view('auth.login');
    }

    public function submitLogin(Request $request)
    {
    	$username =  $request->input('username');
    	$password =  $request->input('password');

    	dd($username, $password);
    }
}
