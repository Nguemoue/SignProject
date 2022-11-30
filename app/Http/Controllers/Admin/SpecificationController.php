<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class SpecificationController extends Controller
{
    function update(Request $request,Produit $produit){
        
        $receiveData = $request->only(['width', 'height', 'depth', 'consigne', 'peremtion', 'weight']);
        $validatedData = Validator::make($receiveData,[
            'width' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'depth' => ['required', 'numeric'],
            'consigne'=>['required','string'],
            'peremtion' => ['required', 'string'],
            'weight' => ['required', 'numeric'],
            
        ])->validate();
        if($produit->specification == null){
            $produit->specification()->create($receiveData);
        }else{
            $produit->specification()->update($receiveData);
        }
        return redirect()->back()->with('success','mis a jour des specification avec success');
    }
}
