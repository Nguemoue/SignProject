<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardAccountController extends Controller
{
    
    // lorque on rencontre le profile
    function profile(){
        $user = auth()->user();
        return view("users.profile.index",compact("user"));
    }

    function updatePhoto(Request $request){
        $request->validate([
            'photo' => ['required', 'file']
        ]);

        $user = auth()->user();
        $user->photo = $request->file("photo")->store("avatars");
        $user->save();
        return redirect()->back()->with("success", "Photo de profile modifier avec success");
    }

    function updatePassword(Request $request){
        $user = auth()->user();
        $request->validate([
            'password' => ["required", "string", "confirmed"]
        ]);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with("success", "mot de passe mis a jour avec success");
    }

    function updateAdresse(Request $request){
        $adresse = auth()->user()->adresse;
        $request->validate([
            'ville'=>["required","string"],
            'pays'=>["required","string"],
            'quartier'=>["required","string"],
            'district'=>["required","string"],
            'numeroRue' => ["required"],
            'boitePostal'=>['required'],
            'zip' => ["required"]
        ]);

        $adresse->ville = $request->ville;
        $adresse->pays = $request->pays;
        $adresse->quartier = $request->quartier;
        $adresse->district = $request->district;
        $adresse->numeroRue = $request->numeroRue;
        $adresse->boitePostal = $request->boitePostal;
        $adresse->zip = $request->zip;
        $adresse->save();
        return redirect()->back()->with("success", "Adresse mis a jour avec success");
        


    }

    function updateProfile(Request $request){
        $user = auth()->user();
        $request->validate([
            'name' => ["required", "string"],
            "telephone" => ["required"]
        ]);
        $user->name = $request->name;
        $user->telephone = $request->telephone;
        $user->save();
        return redirect()->back()->with("success", "profile mis a jour avec success");
    }
}
