<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\CategoriePost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class SingleBlogController extends Controller
{
    function __invoke(Request $request,$blogId)
    {
        $blog = Post::find($blogId);
        $allCategories = CategoriePost::all();
        $allTags = Tag::all();
        return view("blog.single",compact('blog','allCategories','allTags'));
    }
}
