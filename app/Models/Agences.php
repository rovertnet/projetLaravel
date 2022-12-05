<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Agences extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'Agences';
    protected $fillable = [
        "nom_agence",
        "adresse_agence",
        "phone_service",
        "id_pays"
    ];
}
