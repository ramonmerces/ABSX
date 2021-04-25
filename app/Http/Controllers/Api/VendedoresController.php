<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Auth;

class VendedoresController extends Controller
{
    //use DisableAuthorization;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
       $input = $request->all();
       $vendedor = new Vendedor;
       $vendedor->nome = $input['nome'];
       $vendedor->email = $input['email'];
       $vendedor->telefone =  $input['telefone'];
       $vendedor->status = $input['status'];
       $vendedor->chamados_abertos = 0;
       $vendedor->chamados_em_atendimento = 0;
       $vendedor->chamados_resolvidos = 0;

       $vendedor->save();
       return view('cadastro-vendedor');
    }
    public function updateview(Request $request)
    {
       $input = $request->all();
       $vendedor = Vendedor::were('email',$input['email'] )->first();
       
       $vendedor->nome = $input['nome'];
       $vendedor->email = $input['email'];
       $vendedor->telefone =  $input['telefone'];
       $vendedor->status = $input['status'];
       $vendedor->chamados_abertos = 0;
       $vendedor->chamados_em_atendimento = 0;
       $vendedor->chamados_resolvidos = 0;

       $vendedor->save();
       return view('cadastro-vendedor');
    }

    public function deleteView(Request $request)
    {
        if(!empty($request)){
            $input = $request->all();
            $vendedor = Vendedor::find($input['id']);
            $vendedor->delete();
            
        }
        return view('cadastro-vendedor');
    }
    
    
    protected $model = Vendedor::class; 
    public function resolveUser()
    {
        return Auth::guard('sanctum')->user();
    }
}