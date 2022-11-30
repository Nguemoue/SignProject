<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\NewPasswordResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    function index(){
        return view("admin.home");
    }

    function updatePassword(Request $request){
        //je verifie si il a envoyer bien la photo
        Validator::make($request->only('password'), [
            'password' => ['required',Password::min(4), 'confirmed']
        ]);
        $admin = auth()->user();
        $admin->password = $request->password;
        $admin->save();
        $admin->notify(new NewPasswordResetNotification($request->password));
        return redirect()->back()->with("success","votre mot de passe a ete mis a jour avce success");
    }
    function updateProfile(Request $request){
        //je verifie si il a envoyer bien la photo
        Validator::make($request->only('photo'),[
            'photo'=> ['required','image']
        ]);

        $admin =  auth('admin')->user();
        $admin->photo = $request->file('photo')->store('avatar');
        $admin->save();
        return redirect()->back()->with('success','photo de profil mis a jour avec success');

    }
}
