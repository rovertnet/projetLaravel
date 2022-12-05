<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectations extends Model
{
    protected $table = 'Affectation';
    protected $fillable = [
        "id_agent",
        "id_agence",
        "date_affecte",
        "status"
    ];
}
