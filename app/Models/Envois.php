<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Envois extends Model
{
   use HasFactory, HasApiTokens;
   protected $table = 'Envois';
   protected $timestamps = false;
   protected $fillable = [
        "num_envois",
        "montant_envoi",
        "id_devise",
        "expediteur",
        "beneficiaire",
        "phone_exp",
        "id_agence",
        "id_pays"
   ];
}
