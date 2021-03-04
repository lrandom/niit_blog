<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{

	public function home()
	{
		$posts = Post::whereNotNull('user_id')->orderBy('id', 'desc')->paginate(4);
		return view('client.page.home', compact('posts'));
	}

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
