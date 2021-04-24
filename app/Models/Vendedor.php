<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\hasApiTokens;

class Vendedor extends Model
{
    use hasApiTokens, HasFactory;
    protected $guarded = []; 
}
