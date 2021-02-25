<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Validator;
use App\Http\Requests\CreateNewPostRequest;
use Gate;

class PostController extends Controller
{
	public function create()
	{
		if (Gate::denies('post-create')) {
			abort(403);
		}
		$categories = Category::all();
		$tags = Tag::all();
		return view('posts.create', compact('categories', 'tags'));
	}


	// php artisan make:request CreateNewPostRequest

	public function store(CreateNewPostRequest $request)
	{
		// $this->validate($request, [
		// $request->validate([
		// 	'title' => 'required|min:10|unique:posts',
		// 	'description' => 'required',
		// 	'content' => 'required',
		// 	'category_id' => 'required',
		// ], [
		// 	'title.unique' => 'Tiêu đề đã tồn tại trên hệ thống',
		// 	'title.required' => 'Tiêu đề là trường bắt buộc',
		// 	'description.required' => 'Mô tả là trường bắt buộc',
		// 	'content.required' => 'Nội dung là trường bắt buộc',
		// 	'category_id.required' => 'Danh mục là trường bắt buộc',
		// 	'title.min' => 'Tiêu đề tối thiểu 10 ký tự',
		// ]);

		// $validator = Validator::make($request->all(), [
		// 	'title' => 'required|min:8|unique:posts',
		// 	'description' => 'required',
		// 	'content' => 'required',
		// 	'category_id' => 'required',
		// ], [
		// 	'title.unique' => 'Tiêu đề đã tồn tại trên hệ thống',
		// 	'title.required' => 'Tiêu đề là trường bắt buộc',
		// 	'description.required' => 'Mô tả là trường bắt buộc',
		// 	'content.required' => 'Nội dung là trường bắt buộc',
		// 	'category_id.required' => 'Danh mục là trường bắt buộc',
		// 	'title.min' => 'Tiêu đề tối thiểu 8 ký tự',
		// ]);

		// dd($validator->fails());
		// if ($validator->fails()) {
		// 	return redirect()->back()->withErrors($validator)->withInput();
		// }
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
		// $post->slug = Str::slug($title);
		// $post->save();
		event(new \App\Events\PostCreated($post));
		return redirect()->route('posts.index');
	}

	public function index(Request $request)
	{
		if (Gate::denies('post-index')) {
			abort(403);
		}
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
		$validator = Validator::make($request->all(), [
			'title' => 'required|min:8|unique:posts,title,' . $id .',id',
			'description' => 'required|same:title',
			'content' => 'required',
			'category_id' => 'required',
		], [
			'title.email' => 'Email không hợp lệ',
			'title.required' => 'Tiêu đề là trường bắt buộc',
			'description.required' => 'Mô tả là trường bắt buộc',
			'content.required' => 'Nội dung là trường bắt buộc',
			'category_id.required' => 'Danh mục là trường bắt buộc',
			'title.min' => 'Tiêu đề tối thiểu 8 ký tự',
		]);

		// dd($validator->fails());
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

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
		event(new \App\Events\PostUpdated($post));
		return redirect()->route('posts.index');
	}

	public function destroy($id)
	{
		$post = Post::find($id);
		$post->delete();
		return redirect()->route('posts.index');
	}


}
