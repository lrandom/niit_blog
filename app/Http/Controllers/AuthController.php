<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;

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

    public function getFormRegister()
    {
        return view('auth.register');
    }

    public function submitRegister(UserRegisterRequest $request)
    {

    }
}
