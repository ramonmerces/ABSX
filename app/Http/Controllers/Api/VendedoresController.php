<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use App\Models\Vendedor;
use Auth;

class VendedoresController extends Controller
{
    //use DisableAuthorization;
    
    protected $model = Vendedor::class; 
    public function resolveUser()
    {
        return Auth::guard('sanctum')->user();
    }
}