<?php

namespace App\Http\Controllers\Admin;

use App\Action\DecryptBase64File;
use App\Http\Controllers\Controller;
use App\Models\CategoriePost;
use App\Models\Post;
use App\Models\RessourcePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $blogs = Post::query()->orderBy("id","desc")->get();
        return view("admin.blog.index", compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = CategoriePost::all();
        return view("admin.blog.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre'=>"required|string",
            "content"=>"required|string",
            "categorie"=>"required",
            "photo"=>"required|file",
            "cropdata"=>"required|string"
        ],[
            "cropdata"=>"probeleme lors du redimensionnement veuillez verifier"
        ]);
        $stream = DecryptBase64File::decrypt($request->cropdata);

        $filename = "posts/" . $stream->name;

        Post::query()->create([
            'titre'=>$request->titre, 
            'categorie_post_id'=>$request->categorie,
            'contenu'=>$request->content, 
            'administrateur_id'=>auth('admin')->user()->id,
            'image'=>$filename
        ]);

        // je stocke mon image 
        Storage::put($filename, $stream->content);

        return to_route("admin.blogs.index")->with("success", "post creer avec success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //je recupere mon blog
        $blog = Post::find($id);
        $categories = CategoriePost::query()->selectRaw("distinct *")->get();
        return view("admin.blog.edit", compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // je valides mes entrees
        $request->validate([
            'content' => "required|string|min:4",
            "titre" => "required|string|min:4",
            "categorie" => "required"
        ]);

        // je cree ma resource

        // je mmet a jour je recupere d'abord l
        $blog = Post::query()->find($id);
        // je verifie que mes titre sont differents
        if ($blog->titre !== $request->input("titre"))
            $blog->titre = $request->input("titre");

        //je dechiffre mon stream 
        
        // si il y'a la photo du produit
        if ($request->file("photo")) {
            $stream = DecryptBase64File::decrypt($request->input("cropData"));
            $filename = "posts/" . $stream->name;
            $blog->image = $filename;
            Storage::put($filename, $stream->content);
        }

        $blog->categorie_post_id = $request->input("categorie");
        $blog->contenu = $request->input("content");

        $resourceType = $request->input("resource_type");

        //si l'utilisateur a uploder la resource 
        if ($request->file("resource")) {
            // je met a jour ou je creer un nouveau
            if ($temp = $blog->resource) {
                $temp->type = $resourceType;
                $temp->contenu = $request->file('resource')->store("resourcesPost");
                $temp->updated_at = now();
                $temp->save();
            } else {
                RessourcePost::query()->create([
                    'post_id' => $blog->id,
                    'contenu' => $request->file('resource')->store("resourcesPost"),
                    'type' => $resourceType
                ]);
            }
        }

        $blog->save();
        return redirect()->route("admin.blogs.index")->with("success", "mis a jour reussi !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
