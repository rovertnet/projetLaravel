<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Retraits;
use App\Models\historique;
use Illuminate\Support\Facades\Auth;

class retrait extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function retrait(Request $request)
    {
        $request->validate([
            "expediteur" => "required",
            "phone" => "required",
            "beneficiaire" => "required",
            "code" => "required",
            "id_pays" => "required",
            "id_agence" => "required"
        ]);
        $devise = new Retraits();
        $devise->expediteur = $request->expediteur;
        $devise->phone = $request->phone;
        $devise->beneficiaire = $request->beneficiaire;
        $devise->code = $request->code;
        $devise->id_pays = $request->id_pays;
        $devise->id_agence = $request->id_agence;
        $devise->save();

        $message = "vous avez effectué un retrait" . " " . $request->expediteur. " ". $request->phone." ". $request->beneficiaire." ".$request->code." ". $request->id_pays." ". $request->id_agences;
        $historique = new historique();
        $historique->operations = $message;
        $historique->nom = Auth::user()->email;
        $historique->save();

        return response()->json([
            "status" => "1",
            "message" => "Ajout effectué avec succès"
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
