<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function posts($id)
    {
    	$category = Category::find($id);
    	$posts = $category->posts()->paginate(2);
    	return view('category.posts', compact('posts'));
    }
}
