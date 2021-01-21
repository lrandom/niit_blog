<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function posts($id)
    {
    	$tag = Tag::find($id);
    	$posts = $tag->posts()->paginate();
    	return view('tags.posts', compact('posts'));
    }
}
