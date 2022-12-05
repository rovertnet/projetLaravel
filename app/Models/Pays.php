<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Pays extends Model
{
    use HasFactory , HasApiTokens;
    protected $table = 'Pays';
    protected $fillable = [
        "nom",
        "code_pays"
    ];
}
