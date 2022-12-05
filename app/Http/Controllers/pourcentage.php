<?php

namespace App\Http\Controllers;

use App\Models\Pourcentages;
use App\Models\historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pourcentage extends Controller
{
    // Ajout du pourcentage
    public function ajoutPource(Request $request)
    {
        $request->validate([
            "p_use" => "required",
            "p_cdf" => "required"
        ]);
        $pourcentage = new Pourcentages();
        $pourcentage->p_use = $request->p_use;
        $pourcentage->p_cdf = $request->p_cdf;
        $pourcentage->save();

        $message = "Ajout du pourcentage en dollard et en cdf" . " " . $request->nom . " " . $request->email;
        $historique = new historique();
        $historique->operations = $message;
        $historique->nom = Auth::user()->email;
        $historique->save();

        return response()->json([
            "status" => 1,
            "message" => "Opération effectuée avec succès!"  
        ]);
    }

    //affichage du pourcentage
    public function listPource()
    {
        $listpour = Pourcentages::all();
        return response()->json([
            "status" => "1",
            "message" => "tout va bien",
            "data" => $listpour
        ]);
    }

    //Modification du pourcentage
    public function updatePource(Request $request, $id)
    {
        if (Pourcentages::where(['id' => $id])->exists()) {

            $message = "Modification du pourcentage en dollard et en cdf" . " " . $id;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = Auth::user()->email;
            $historique->save();

            $pourcentage = Pourcentages::where(['id' => $id])->first();
            $pourcentage->update([
                "p_use" => $request->p_use,
                "p_cdf" => $request->p_cdf
            ]);
            return response()->json([
                "status" => 1,
                "message" => "Modification effectuée avec succès",
                "data" => $pourcentage
            ],200);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Modification echouée veuillez recommancer s'il vous plaît!"
            ],403);
        }
    }
}
