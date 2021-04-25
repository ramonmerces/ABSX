<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use App\Models\Chamado;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Auth;

class ChamadosController extends Controller
{
   // use DisableAuthorization;
   public function store(Request $request){
        if(!empty($request)){
            $input = $request->all();
            $chamado = new Chamado;
            $chamado->assunto = $input['assunto'];
            $chamado->descricao = $input['descricao'];
            $chamado->status = 'Aberto';
            
            $vendedores = Vendedor::all();
            $Chamados_abertos = array();
            foreach ($vendedores as $vendedor){
               array_push($chamados_abertos, $chamados_abertos[$vendedor->id] = $vendedor->chamados_abertos);
            }
            asort($chamados_abertos);
            $chamado->vendedor_id = key($chamados_abertos);
            $vendedor = Vendedor::find($chamado->vendedor_id);
            $vendedor->chamados_abertos++; 
            $vendedor->save();
            $chamado->save();
        }
        return view('crud-chamado');
   }
   public function updateView(Request $request){
        if(!empty($request)){
            $input = $request->all();
            $chamado = Chamado::find($input['id']);
            $chamado->assunto = $input['assunto'];
            $chamado->descricao = $input['descricao'];
            $chamado->status = $input['status'];
            $chamado->created_at = $input['created_at'];
            $chamado->save();


        }
        return view('crud-chamado');
   }
   public function deleteView(Request $request){
        if(!empty($request)){
            $input = $request->all();
            $chamado = Chamado::find($input['id']);
            $chamado->delete();
            
        }
        return view('crud-chamado'); 
   }    


    protected $model = Chamado::class; 
    public function resolveUser()
    {
        return Auth::guard('sanctum')->user();
    }
}