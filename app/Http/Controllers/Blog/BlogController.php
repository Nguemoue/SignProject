<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\CategoriePost;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function __invoke(Request $request)
    {
        $blogs = Post::query()->with('categorie')->paginate(10);
        $categories = CategoriePost::query()->withExists(['posts'])->take(3)->get();
        return view("blog.all",compact('blogs','categories'));
    }
}
