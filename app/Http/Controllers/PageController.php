<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function hello()
    {
    	$date = date('Y-m-d H:i:s');
    	$totalStudent = 6;

    	// return view('hello', [
    	// 	'date1' => $date
    	// ]);
    	return view('hello', compact('date', 'totalStudent'));
    }
}
