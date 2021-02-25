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
Route::get('login', 'AuthController@getFormLogin')->name('login');
Route::post('logout', 'AuthController@logout')->name('logout');
Route::post('login', 'AuthController@submitLogin');

Route::get('register', 'AuthController@getFormRegister');
Route::post('register', 'AuthController@submitRegister')->name('register.submit');


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::put('posts', 'PostController@update');
    Route::get('posts-edit', 'PostController@edit');
    Route::delete('posts', 'PostController@destroy');
    Route::get('posts/create', 'PostController@create')->name('posts.create');
    Route::post('posts', 'PostController@store')->name('posts.store');
    // Route::get('posts', 'PostController@index')->name('posts.index')->middleware('permission.checker:editor|moderator|admin');
    Route::get('posts', 'PostController@index')->name('posts.index');
    Route::get('posts/{id}/edit', 'PostController@edit')->name('posts.edit');
    Route::put('posts/{id}', 'PostController@update')->name('posts.update');
    Route::delete('posts/{id}', 'PostController@destroy')->name('posts.destroy');
    Route::get('categories/{id}/posts', 'CategoryController@posts');
    Route::get('tags/{id}/(posts', 'TagController@posts');
    Route::get('only-male', function() {
        echo "Male Zone";
    })->middleware('only.male');
});
// Cập nhật dữ liệu




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


Route::get('fake-user', function () {
    $user =  new \App\Models\User;
    $user->name = 'Nguyễn Thị A';
    $user->email = 'ant@topcv.vn';
    $user->gender = 2;
    $user->password = bcrypt('123456789');
    $user->save();
});

Route::get('fake-profile', function () {
    $profile =  new \App\Models\Profile;

    $profile->id_code = '12341231234';
    $profile->address = 'Ha Noi';
    $profile->gender = 1;
    $profile->user_id = 1;

    $profile->save();
});

Route::get('relationship/one-to-one', function () {
    $user = \App\Models\User::find(1);

    echo "Name: {$user->name} <br>";
    echo "Address: {$user->profile->address} <br>";
});



Route::get('relationship/one-to-one-reverse', function () {
    $profile = \App\Models\Profile::find(1);

    echo "Address: {$profile->address} <br>";
    echo "Name: {$profile->user->name} <br>";
    echo "Email: {$profile->user->email} <br>";
});


Route::get('fake-tag', function () {
    $tag = new \App\Models\Tag;
    $tag->name = 'covid';
    $tag->save();


    $tag = new \App\Models\Tag;
    $tag->name = 'kinh doanh';
    $tag->save();


    $tag = new \App\Models\Tag;
    $tag->name = 'MMA';
    $tag->save();

});


Route::get('relationship/one-to-one-reverse', function () {
    $profile = \App\Models\Profile::find(1);

    echo "Address: {$profile->address} <br>";
    echo "Name: {$profile->user->name} <br>";
    echo "Email: {$profile->user->email} <br>";
});

Route::get('403', function() {
    return view('403');
})->name('403');

Route::get('test', function() {
    $posts = \App\Models\Post::whereIn('category_id', [2, 3])->orderBy('id', 'desc')->get();

    $postsWith2Category = $posts->filter(function($post) {
        return $post->category_id == 2;
    });

    dd($postsWith2Category);
    // $arr = [
    //     1,
    //     3,
    //     5
    // ];
    // $first = array_shift($arr);
    // echo $first;

    $arr = collect([2, 1, 4, 6, 50, 10]);
    echo $arr->first() . "<br>";
    echo $arr->last() . "<br>";
    echo $arr->max() . "<br>";
    echo $arr->min() . "<br>";
    echo "Duyệt mảng :<br>";
    $arr->push(90);
    foreach ($arr as $key => $value) {
        echo $value . "<br>";
    }
    echo "Mảng sắp xếp :<br>";
    $arr = $arr->sort();
    foreach ($arr as $key => $value) {
        echo $value . "<br>";
    }
    echo "Mảng lẻ :<br>";
    $oddArr = $arr->filter(function ($item) {
        return $item % 2 == 1;
    });
    foreach ($oddArr as $key => $value) {
        echo $value . "<br>";
    }
    echo "Mảng chẵn :<br>";
    $oddArr = $arr->filter(function ($item) {
        return $item % 2 == 0;
    });
    foreach ($oddArr as $key => $value) {
        echo $value . "<br>";
    }
    echo "Mảng sau khi nhân tất cả phần tử cho 5 :<br>";
    $mul5Arr = $arr->map(function ($item) {
        return $item * 5;
    });
    foreach ($mul5Arr as $key => $value) {
        echo $value . "<br>";
    }


});




