<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class admin extends Model
{
   use HasFactory, HasApiTokens; 
   protected $table = 'admins';
   protected $fillable = [
        'nom',
        'email',
        'password'
   ];
}
