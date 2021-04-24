<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use App\Models\Chamado;
use Auth;

class ChamadosController extends Controller
{
   // use DisableAuthorization;
    protected $model = Chamado::class; 
    public function resolveUser()
    {
        return Auth::guard('sanctum')->user();
    }
}