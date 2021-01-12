<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
	public function create()
	{
		$categories = Category::all();
		return view('posts.create', compact('categories'));
	}

	public function store(Request $request)
	{
		//php artisan make:model Post
		$title = $request->input('title');
		$description = $request->input('description');
		$content = $request->input('content');
		$categoryId = $request->input('category_id');

		$post = new Post;
		$post->title = $title;
		$post->description = $description;
		$post->content = $content;
		$post->category_id = $categoryId;
		$post->save();

		return redirect()->route('posts.index');
	}

	public function index(Request $request)
	{
		$keyword = $request->input('keyword');

		$postQuery = Post::query();

		if ($keyword) {
			$postQuery->where('title', 'like', "%{$keyword}%");
		}
		// $postQuery->orderBy('id', 'desc');
		// $postQuery->orderBy('created_at', 'desc');
		$postQuery->latest('id');


		$posts = $postQuery->paginate();
		return view('posts.index', compact('posts'));
	}

	public function edit($id)
	{
		$categories = Category::all();
		$post = Post::find($id);
		return view('posts.edit', compact('post', 'categories'));
	}

	public function update($id, Request $request)
	{
		$post = Post::find($id);

		$title = $request->input('title');
		$description = $request->input('description');
		$content = $request->input('content');
		$categoryId = $request->input('category_id');
		$post->title = $title;
		$post->description = $description;
		$post->content = $content;
		$post->category_id = $categoryId;
		$post->save();
		return redirect()->route('posts.index');
	}

	public function destroy($id)
	{
		$post = Post::find($id);
		$post->delete();
		return redirect()->route('posts.index');
	}


}
