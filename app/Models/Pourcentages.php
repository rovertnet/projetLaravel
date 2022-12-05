<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Pourcentages extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'Pourcentages';
    protected $fillable = [
        "p_use",
        "p_cdf"
    ];
}
