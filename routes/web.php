<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage	');
});

Route::get('/niit', function () {
    return view('welcome');
});

Route::get('/hello', 'PageController@hello');


Route::get('/create-post', function () {
    $post = new \App\Models\Post;

    $post->title = 'Chào lớp NIIT laravel';
    $post->description = 'Đây là mô tả của bài viết Chào lớp NIIT laravel';
    $post->content = 'Đây là nội dung của bài viết Chào lớp NIIT laravel';
    $post->status = 1;
    $post->category_id = 1;
    $post->user_id = 1;
    $post->save();
    echo "Create new Post success";
});

Route::get('/update-post', function () {
    $post = \App\Models\Post::find(1);
    $post->title = 'Đây là bài viết số 1';
    $post->description = 'Đây là mô tả của bài viết Chào lớp NIIT laravel';
    $post->content = 'Đây là nội dung của bài viết Chào lớp NIIT laravel';
    $post->status = 1;
    $post->category_id = 1;
    $post->user_id = 1;
    $post->save();
    echo "Update Post success";
});
Route::get('/delete-post', function () {
    $post = \App\Models\Post::find(1);
    $post->delete();
    echo "Delete Post success";
});
Route::get('/delete-posts', function () {
    $post = \App\Models\Post::where('id', '>=', 12)->where('category_id', 2);
    $post->delete();
    echo "Delete Post success";
});
Route::get('/count-post', function () {
    $totalPost = \App\Models\Post::where('status', 2)->count();

    echo "Tổng số bài viết là " . $totalPost;
});

Route::get('/posts', function () {
    $posts = \App\Models\Post::all();
	foreach($posts as $post) {
		echo $post->title . "<br>";
	}
});

Route::get('/posts-by-category', function () {
    $posts = \App\Models\Post::where('category_id', 3)->where('status', 1)->get();
	foreach($posts as $post) {
		echo $post->title . "<br>";
	}
});
Route::get('/posts-by-where-or', function () {
    $posts = \App\Models\Post::where('id', 10)->orWhere('id', 12)->get();
	foreach($posts as $post) {
		echo $post->title . "<br>";
	}
});

Route::get('/posts-by-where-or2', function () {
    $posts = \App\Models\Post::where('id', 10)->orWhere(function ($query) {
    	$query->where('id', 12);
    	$query->where('status', 1);
    })->get();
    // $posts = \App\Models\Post::where('id', 10)->orWhere('id', 12);->orWhere('status', 1);->get();

    // (id = 10) || (id = 12 && status = 1)
	foreach($posts as $post) {
		echo $post->title . "<br>";
	}
});



