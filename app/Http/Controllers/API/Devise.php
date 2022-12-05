<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Devises;
use Illuminate\Http\Request;
use App\Models\historique;
use Illuminate\Support\Facades\Auth;

class Devise extends Controller
{
    //Ajout d'une dévise
    public function ajoutDevise(Request $request)
    {
        $request->validate([
            "intitule" => "required"
        ]);
        $devise = new Devises();
        $devise->intitule = $request->intitule;
        $devise->save();

        $message = "creation d'un pays" . " " . $request->nom;
        $historique = new historique();
        $historique->operations = $message;
        $historique->nom = Auth::user()->email;
        $historique->save();

        return response()->json([
            "status" => "1",
            "message" => "Ajout effectué avec succès"
        ], 200);
    }

    //Suppression d'une dévise
    public function delete($id)
    {
        if (Devises::where(['id' => $id])->exists()) {
            $message = "suppresion de devise" . " " . $id;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = Auth::user()->email;
            $historique->save();

            $agence_delete = Devises::whereId($id)->first();
            $agence_delete->delete();


            return response()->json([
                "status" => "1",
                "message" => "Suppression est fait avec success !"
            ],200);
        } else {
            return response()->json([
                "status" => "1",
                "message" => "Devise non trouvé !"
            ],403);
        }
    }
}
