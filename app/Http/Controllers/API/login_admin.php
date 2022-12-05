<?php

namespace App\Http\Controllers\API;
use App\Models\Agents;
use App\Models\admin;
use App\Models\historique;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class login_admin extends Controller
{
    //URL : http://127.0.0.1:82/api/login_ad
    public function login_ad(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        //verification de l'agent s'il existe 
        $admin = admin::whereEmail($request->email)->wherePassword($request->password)->first();

        if ($admin == true) {
            $token = $admin->createToken('auth_token')->plainTextToken;

            $message = "Vous etes connecté" . " " . $request->email;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = $request->email;
            $historique->save();

            return response()->json([
                "status" => 1,
                "message" => "Connexion réussie!",
                "access_token" => $token
            ], 200);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Cet agent n'existe pas!"
            ], 403);
        }
    }
    //déconnexion de l'Admin
    public function logout_ad(Request $request)
    {
        Auth::tokens()->user()->delete();
        return response()->json([
            "status" => 0,
            "message" => "Vous êtes déconnectés"
        ], 200);
    }
    public function AdminSession(){

    }
}
