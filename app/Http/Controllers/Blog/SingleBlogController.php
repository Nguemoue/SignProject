<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleBlogController extends Controller
{
    function __invoke(Request $request,$blogId)
    {
        $blog = null;
        return view("blog.single",compact('blog'));
    }
}
