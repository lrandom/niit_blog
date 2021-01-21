<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
	public function create()
	{
		$categories = Category::all();
		$tags = Tag::all();
		return view('posts.create', compact('categories', 'tags'));
	}

	public function store(Request $request)
	{
		//php artisan make:model Post
		$title = $request->input('title');
		$description = $request->input('description');
		$content = $request->input('content');
		$categoryId = $request->input('category_id');
		$tagIds = $request->input('tags_id', []);

		$post = new Post;
		$post->title = $title;
		$post->description = $description;
		$post->content = $content;
		$post->category_id = $categoryId;
		$post->save();
		$post->tags()->sync($tagIds);

		return redirect()->route('posts.index');
	}

	public function index(Request $request)
	{
		$keyword = $request->input('keyword');
		$categoryId = $request->input('category_id');
		$tagIds = $request->input('tag_ids', []);


		$postQuery = Post::query();

		if ($keyword) {
			$postQuery->where('title', 'like', "%{$keyword}%");
		}
		if ($categoryId) {
			$postQuery->where('category_id', $categoryId);
		}
		if (count($tagIds) > 0) {
			$postQuery->whereHas('tags', function ($query) use ($tagIds) {
				$query->whereIn('tags.id', $tagIds);
			});
		}
		// $postQuery->orderBy('id', 'desc');
		// $postQuery->orderBy('created_at', 'desc');
		$postQuery->latest('id');
		$categories = Category::all();
		$tags = Tag::all();
		$posts = $postQuery->paginate();
		return view('posts.index', compact('posts', 'categories', 'tags'));
	}

	public function edit($id)
	{
		$tags = Tag::all();
		$categories = Category::all();
		$post = Post::find($id);
		return view('posts.edit', compact('post', 'categories', 'tags'));
	}

	public function update($id, Request $request)
	{
		$post = Post::find($id);

		$title = $request->input('title');
		$description = $request->input('description');
		$content = $request->input('content');
		$categoryId = $request->input('category_id');

		$tagIds = $request->input('tags_id', []);

		$post->title = $title;
		$post->description = $description;
		$post->content = $content;
		$post->category_id = $categoryId;
		$post->save();

		$post->tags()->sync($tagIds);

		return redirect()->route('posts.index');
	}

	public function destroy($id)
	{
		$post = Post::find($id);
		$post->delete();
		return redirect()->route('posts.index');
	}


}
