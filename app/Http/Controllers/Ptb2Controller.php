<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ptb2Controller extends Controller
{
    public function getFormGiaiPtb2()
    {
    	return view('ptb2.form');
    }

    public function submitPtb2(Request $request)
    {
    	$a = $request->input('number_a');
    	$b = $request->input('number_b');
    	$c = $request->input('number_c');

    	$delta = $b * $b - 4 * $a * $c;
    	$nghiem = [];

    	if ($delta == 0) {
    		$nghiem[] = -$b / (2 * $a);
    	} else if ($delta > 0) {
    		$nghiem[] = (-$b - sqrt($delta)) / (2 * $a);
    		$nghiem[] = (-$b + sqrt($delta)) / (2 * $a);
    	}

    	return view('ptb2.result', compact('nghiem'));
    }
}
