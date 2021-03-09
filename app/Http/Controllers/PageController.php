<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PageController extends Controller
{

    public function home ()
    {
        $posts = Post::whereNotNull('user_id')->orderBy('id', 'desc')->paginate(4);
        $tags = Tag::all();
        $popularPosts = Post::orderBy('id', 'desc')->take(4)->get();
        return view('client.page.home', compact('posts',
            'tags',
            'popularPosts'));
    }

    public function hello ()
    {
        $date = date('Y-m-d H:i:s');
        $totalStudent = 6;

        // return view('hello', [
        // 	'date1' => $date
        // ]);
        return view('hello', compact('date', 'totalStudent'));
    }

    public function tags ($id)
    {
        $tag = Tag::find($id);
        $posts = Post::whereHas('tags', function ($query) use ($id) {
            $query->where('tags.id', $id);
        })->paginate(10);
        return view('client.post.tags', compact('posts', 'tag'));
    }
}
