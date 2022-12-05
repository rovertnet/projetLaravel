<?php

use App\Http\Controllers\API\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\controllerPays;
use App\Http\Controllers\API\controllerenvoi;
use App\Http\Controllers\API\Devise;
use App\Http\Controllers\API\Agence;
use App\Http\Controllers\API\compteurs;
use App\Http\Controllers\API\login_admin;
use App\Http\Controllers\API\retrait;
use App\Http\Controllers\pourcentage;
use App\Models\Pays;
use App\Http\Controllers\transactions;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [Agent::class, 'login']);
Route::post('/login_ad', [login_admin::class, 'login_ad']);

Route::group(['middleware' => ['auth:sanctum']],function(){
    // destory
    Route::get('/logout_ad', [login_admin::class, 'logout_ad']);
    //fin detory

    Route::get('/profile', [Agent::class, 'profile']);

    //Paramettre Agent agents
    Route::post('/createAgent', [Agent::class, 'createAgent']);
    Route::get('/listAgent', [Agent::class, 'listAgent']);
    Route::patch('/updateAgent/{id}', [Agent::class, 'updateAgent']);
    Route::delete('/deleteAgent/{id}', [Agent::class, 'delete']);
    Route::get('/logout', [Agent::class, 'logout']);
    Route::get('/un_agent/{id}', [Agent::class, 'un_agent']);
    //fin  agent

    //Paramettre d'agence
    Route::post('/ajoutAgence', [Agence::class, 'ajoutAgence']);
    Route::delete('/deleteAgence/{id}', [Agence::class, 'delete']);
    Route::patch('/update/{id}', [Agence::class, 'update']);
    Route::get('/listAgence', [Agence::class, 'listAgence']);
    //fin agence

    //fin agence
    Route::post('/createEnvoi', [controllerenvoi::class, 'createEnvoi']);

    //Paramettre Pays
    Route::post('/createPays', [controllerPays::class, 'createPays']);
    Route::delete('/deletePays/{id}', [controllerPays::class, 'delete']);
    //fin pays

    //Paramettre Devise
    Route::post('/ajoutDevise', [Devise::class, 'ajoutDevise']);
    Route::delete('/deleteDevise/{id}', [Devise::class, 'delete']);
    //fin devise

    Route::post('/retrait', [retrait::class, 'retrait']);

    //tous les compteurs
    Route::get('/nombreAgent',[Agent::class, 'nombreAgent']);
    Route::get('/nombresPays',[controllerPays::class, 'nombresPays']);
    Route::get('/transaction_envois', [transactions::class, 'nombres_transactions']);
    Route::get('/transaction_retraits', [transactions::class, 'nombres_transactions_retraits']);
    Route::get('/compteurEnvoi_jour', [transactions::class, 'compteurEnvoi_jour']);
    //fin compteurs

    //pourcentage route 
    Route::post('/ajoutPource', [pourcentage::class, 'ajoutPource']);
    Route::post('/listPource', [pourcentage::class, 'listPource']);
    Route::patch('/updatePource{id}', [pourcentage::class, 'updatePource']);
    //fin pourcentage
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});