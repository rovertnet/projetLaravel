<?php

namespace App\Http\Controllers;

use App\Models\Envois;
use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class transactions extends Controller
{
    public function nombres_transactions(){
        $compteur = DB::select('select count(*) as compteur from envois');
        foreach ($compteur as $compteurs) :
            $robert = $compteurs->compteur;
        endforeach;
        return response()->json([
            "Status" => 1,
            "message" => "tout va bien!",
            "compteur" => $robert
        ],200);

    }

    public function nombres_transactions_retraits()
    {
        $compteur = DB::select('select count(*) as compteur from retraits');
        foreach ($compteur as $compteurs) :
            $robert = $compteurs->compteur;
        endforeach;
        return response()->json([
            "Status" => 1,
            "message" => "tout va bien!",
            "compteur" => $robert
        ],200);
    }
    //URL : http://127.0.0.1:82/api/compteurEnvoi_jour
    public function compteurEnvoi_jour(){
        
    }
}