<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;

use App\Models\historique;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//lien de l'api http://127.0.0.1:8000/API/
class Agent extends Controller
{
    //creation d'un agent //lien de l'api http://127.0.0.1:8000/api/createAgent
    public function createAgent(Request $request)
    {
        $request->validate([
            "matricule" => "required",
            "nom" => "required",
            "prenom" => "required",
            "sexe" => "required",
            "phone" => "required",
            "email" => "required|email|unique:Agents",
            "mdp" => "required"
        ]);
        
        $agent = new Agents();
        $agent->matricule = $request->matricule;
        $agent->nom = $request->nom;
        $agent->prenom = $request->prenom;
        $agent->sexe = $request->sexe;
        $agent->phone = isset($request->phone);
        $agent->email = $request->email;
        $agent->mdp = $request->mdp;
        $agent->save();

        $message = "creation d'un agent" . " " . $request->nom." ". $request->email;
        $historique = new historique();
        $historique->operations = $message;
        $historique->nom = Auth::user()->email;
        $historique->save();

        return response()->json([
            "status" => 1,
            "message" => "Opération effectuée avec succès!"
        ],200);
    }

    //URL : http://127.0.0.1:82/api/login
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        //verification de l'agent s'il existe 
        $agent = Agents::whereEmail($request->email)->wherePassword($request->password)->first();

        if($agent == true){
             //création de jeton/Tokens
            $token = $agent->createToken('auth_token')->plainTextToken;

            $message = "Vous etes connecté" . " " . $request->email;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = $request->email;
            $historique->save();

            return response()->json([
                "status" => 1,
                "message" => "Connexion réussie!",
                "access_token" =>$token
            ],200); 
            
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Cet agent n'existe pas!"
            ], 403);
        }
    }

    //URL : http://127.0.0.1:82/listAgent
    public function listAgent()
    {
        $listAgent = Agents::all();
        return response()->json([
            "status" => "1",
            "message" => "required",
            "data" => $listAgent
        ],405);
    }

    //mise à jour des information de l'agent //lien de l'api URL : http://127.0.0.1:8000/api/updateAgent
    public function updateAgent(Request $request, $id)
    {
        if (Agents::where(['id' => $id])->exists()) {

            $message = "Modification d'un agent" . " " . $id;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = Auth::user()->email;
            $historique->save();

            $agent = Agents::where(['id' => $id])->first();
            $agent->update([
                "matricule" => $request->matricule,
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "sexe" => $request->sexe,
                "phone" => $request->phone,
                "email" => $request->email
            ]);
            return response()->json([
                "status" => 1,
                "message" => "Modification effectuée avec succès",
                "data" => $agent 
            ],200);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Modification echouée veuillez recommancer s'il vous plaît!"
            ],403);
        }
    }
    //suppression des informations de l'agent URL : http://127.0.0.1:82/api/delete
    public function delete($id)
    {
        if (Agents::where(['id' => $id])->exists()) {

            $message = "suppresion d'un agent" . " " . $id;
            $historique = new historique();
            $historique->operations = $message;
            $historique->nom = Auth::user()->email;
            $historique->save();

            $agence_delete = Agents::whereId($id)->first();
            $agence_delete->delete();

            return response()->json([
                "status" => "1",
                "message" => "Suppression est fait avec success !"
            ],200);
        } else {
            return response()->json([
                "status" => "1",
                "message" => "agent non trouvé !"
            ],403);
        }
    }
    
    //les informations de profile de l'agent URL : http://127.0.0.1:82/api/profile
    public function profile(){
        
        return response()->json([
            "status" => "1",
            "message" => "required",
            "email" => auth::user()->email,
            "datas" => auth::user()->mdp,
            "dataa" => auth::user()->nom
        ],200);
        
    }

    //compteur pour les agents URl : http://127.0.0.1:82/api/nombreAgent
    public function nombreAgent()
    {
        $compteur = DB::select('select count(*) as compteur from Agents');
        foreach($compteur as $compteurs) :
        $robert = $compteurs->compteur;
        endforeach;
        return response()->json([
            "Status" => 1,
            "message" => "tout va bien!",
            "compteur" => $robert
        ],200);
    }
    //déconnexion de l'agent URL : http://127.0.0.1:82/api/logout
    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            "status" => 1,
            "message" => "Vous êtes déconnectés"
        ],200);
    }
    public function un_agent($id){
        $select = Agents::where(['id' => $id])->exists();
        return response()->json([
            "status" => 1,
            "message" => "ok",
            "data" => $select
        ], 200);
    }
}
