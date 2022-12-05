<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historique extends Model
{
    protected $table = 'historiques';
    protected $fillable = [
        "operations"
    ];
}
