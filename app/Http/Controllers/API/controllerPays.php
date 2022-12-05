<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pays;
use App\Models\historique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class controllerPays extends Controller
{
    //création d'un pays
    public function createPays(Request $request)
    {
        $request->validate([
            "nom" => "required",
            "code_pays" => "required"
        ]);
        $pays = new Pays();
        $pays->nom = $request->nom;
        $pays->code_pays = $request->code_pays;
        $pays->save();

        $message = "creation d'un pays" . " " . $request->nom;
        $historique = new historique();
        $historique->operations = $message;
        $historique->nom = Auth::user()->email;
        $historique->save();

        return response()->json([
            "status" => 1,
            "message" => "ok"
        ],200);
    }

    //Suppression d'un pays
    public function delete($id)
    {
        if (Pays::where(['id' => $id])->exists()) {
            $message = "suppresion d'un pays" . " " . $id;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = Auth::user()->email;
            $historique->save();


            $agence_delete = Pays::whereId($id)->first();
            $agence_delete->delete();

            
            return response()->json([
                "status" => "1",
                "message" => "Suppression est faite avec success !"
            ],200);
        } else {
            return response()->json([
                "status" => "1",
                "message" => "Pays non trouvé !"
            ],403);
        }
    }
    //compteur pour les pays
    public function nombresPays()
    {
        $compteur = DB::select('select count(*) as compteur from Pays');
        foreach ($compteur as $compteurs) :
            $robert = $compteurs->compteur;
        endforeach;
        return response()->json([
            "Status" => 1,
            "message" => "tout va bien!",
            "compteur" => $robert
        ],200);
    }
}
