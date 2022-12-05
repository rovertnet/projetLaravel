<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retraits extends Model
{
    protected $table = 'Retraits';
    protected $timestamps = false;
    protected $fillable = [
        "expediteur",
        "phone",
        "beneficiaire",
        "code",
        "id_pays",
        "id_agence"
    ];
}
