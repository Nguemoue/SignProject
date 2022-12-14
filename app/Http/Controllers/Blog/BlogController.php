<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\CategoriePost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function __invoke(Request $request)
    {
        $categorieFilter = $request->query('categorie');
        $tagFilter = $request->query("tag");
        // dd($categorieFilter);
        $blogs = Post::query()->with('categorie')->when($categorieFilter, function ($query) use ($categorieFilter) {
            $temp = CategoriePost::query()->where("nom", "=", $categorieFilter)->pluck("id")->first();
            $query->where("categorie_post_id", '=', $temp);
        })->when($tagFilter, function ($query) use ($tagFilter) {
            $dd = $query->whereHas('tags', function ($b) use($tagFilter) {
                return $b->where('nom', '=', $tagFilter);
           });
        })
        ->paginate(4)->withQueryString();
        $latestCategories = CategoriePost::query()->withExists(['posts'])->take(3)->get();
        $allCategories = CategoriePost::all();
        $allTags = Tag::all();
        return view("blog.all",compact('blogs','latestCategories','allCategories','allTags'));
    }
}
