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


Route::get('giai-pt-b2', 'Ptb2Controller@getFormGiaiPtb2');
Route::get('giai-pt-b2-submit', 'Ptb2Controller@submitPtb2');

// Lấy dữ liệu
Route::get('login', 'AuthController@getFormLogin');

// Tạo mới dữ liệu
Route::post('login', 'AuthController@submitLogin');

// Cập nhật dữ liệu
Route::put('posts', 'PostController@update');
Route::get('posts-edit', 'PostController@edit');

// Xóa dữ liệu
Route::delete('posts', 'PostController@destroy');


// Route::post('posts/create', 'PostController@update');
// Route::post('posts/update', 'PostController@update');
// Route::post('posts/delete', 'PostController@update');


// Route::post('posts', 'PostController@update');
// Route::put('posts', 'PostController@update');
// Route::delete('posts', 'PostController@update');

//Hiển thị form tạo mới
Route::get('posts/create', 'PostController@create')->name('posts.create');

//Nhận dữ liệu từ form tạo mới
Route::post('posts', 'PostController@store')->name('posts.store');
Route::get('posts', 'PostController@index')->name('posts.index');

// posts/10/edit

// posts/10
Route::get('posts/{id}/edit', 'PostController@edit')->name('posts.edit');
Route::put('posts/{id}', 'PostController@update')->name('posts.update');
Route::delete('posts/{id}', 'PostController@destroy')->name('posts.destroy');


Route::get('fake-du-lieu', function () {
    for ($i=0; $i < 122; $i++) {
        $post = new \App\Models\Post;
        $post->title = 'Nóng nhất thể thao tối 9/1: Mayweather lại "cà khịa" Pacquiao là ông già';
        $post->description = 'Nóng nhất thể thao tối 9/1: Mayweather lại "cà khịa" Pacquiao là ông già';
        $post->content = 'Nóng nhất thể thao tối 9/1: Mayweather lại "cà khịa" Pacquiao là ông già';
        $post->save();
    }
});


Route::get('fake-category', function () {
    $categories = [
        'Pháp luật',
        'Thể thao',
        'Teen',
    ];

    foreach ($categories as $category) {
        $cate = new \App\Models\Category;
        $cate->name = $category;
        $cate->description = $category;
        $cate->save();
    }

});




