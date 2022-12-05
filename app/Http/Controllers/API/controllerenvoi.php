<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Envois;
use Illuminate\Support\Facades\Auth;
use App\Models\historique;


class controllerenvoi extends Controller
{
    //URL : 127.0.0.1:82/api/createEnvoi
    public function createEnvoi(Request $request)
    {
        $request->validate([
            "num_envoi" => "required",
            "montant_envoi" => "required",
            "id_devise" => "required",
            "expediteur" => "required",
            "beneficiaire" => "required",
            "phone_exp" => "required",
            "id_agence" => "required",
            "id_pays" => "required"
        ]);
        $client = new Envois();
        $client->num_envoi = $request->num_envoi;
        $client->montant_envoi = $request->montant_envoi;
        $client->id_devise = $request->id_devise;
        $client->expediteur = $request->expediteur;
        $client->beneficiaire = $request->beneficiaire;
        $client->phone_exp = $request->phone_exp;
        $client->id_agence = $request->id_agence;
        $client->id_pays = $request->id_pays;
        $client->save();

        $message = "Transaction d'envoi effectuée par Mr ou Mme" . " " . $request->nom . " " . $request->email;
        $historique = new historique();
        $historique->operations = $message;
        $historique->nom = Auth::user()->email;
        $historique->save();


        return response()->json([   
            "status" => 1,
            "message" => "Opération effectuée avec succès!"
        ],200);
    }
}
