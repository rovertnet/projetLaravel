<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agences;
use App\Models\historique;
use Illuminate\Support\Facades\Auth;



class Agence extends Controller
{
    //l'ajout d'une agence URL : http://127.0.0.1:82/api/ajoutAgence
    public function ajoutAgence( Request $request)
    {
        $request->validate([
            "nom_agence" => "required",
            "adresse" => "required",
            "phone_service" => "required",
            "id_pays" => "required"
        ]);
        $agence = new Agences();
        $agence->nom_agence = $request->nom_agence;
        $agence->adresse = $request->adresse;
        $agence->phone_service = $request->phone_service;
        $agence->id_pays = $request->id_pays;
        $agence->save();

        $message = "creation d'une agence"." ".$request->nom_agence;
        $historique = new historique();
        $historique->operations = $message;
        $historique->nom = Auth::user()->email;
        $historique->save();

        return response()->json([
            "status" => "1",
            "message" => "Ajout effectué avec succès"
        ],200);
    }
    //la supression d'une agence URL : http://127.0.0.1:82/api/delete
    public function delete($id){
        if(Agences::where(['id' => $id])->exists()){
            $message = "Suppression d'une agence" . " " . $id;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = Auth::user()->email;
            $historique->save();

            $agence_delete = Agences::whereId($id)->first();
            $agence_delete->delete();

            return response()->json([
                "status" => "1",
                "message" => "Suppression est faite avec success !"
            ],200);
        }else{
            return response()->json([
                "status" => "0",
                "message" => "Agence non trouvée !"
            ],403);
        }
    }
    //La modiffication du pays URL : http://127.0.0.1:82/api/update
    public function update(Request $request, $id)
    {
        if(Agences::where(['id' => $id])->exists()){

            $message = "Modification d'un agent" . " " . $id;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = Auth::user()->email;
            $historique->save();

            $agence = Agences::where(['id' => $id])->first();
            $agence->update([
                "nom_agence" => $request->nom_agence,
                "adresse" => $request->adrese,
                "phone_service" => $request->phone_service
            ]);
            return response()->json([
                "status" => 1,
                "message" => "Modification effectuée avec succès",
                "data" => $agence
            ], 200);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Modification echouée, veuillez ressayer s'il vous plaît"
            ], 403);
        }
    }
    //URL : http://127.0.0.1:82/api/listAgence
    public function listAgence(){
        $listAgence = Agences::all();
        return response()->json([
            "status" => "1",
            "message" => "required",
            "data" => $listAgence
        ], 200);
    }
}
