<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Agents extends Model
{
    use HasFactory, HasApiTokens; 
    protected $table = 'Agents';
    protected $fillable = [
        "matricule",
        "nom",
        "prenom",
        "sexe",
        "phone",
        "email",
        "mdp"
    ];
}
