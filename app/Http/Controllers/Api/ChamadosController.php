<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use App\Models\Chamado;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Auth;
use Redirect;

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
            $chamados_abertos = array();
            foreach ($vendedores as $vendedor){
               $chamados_abertos2["id".$vendedor->id] = $vendedor->chamados_abertos;
               $farray = array_merge($chamados_abertos, $chamados_abertos2 );
               
            }
            asort($farray);
            $chamado->vendedor_id = substr(key($farray), 2);
            $vendedor = Vendedor::find($chamado->vendedor_id);
            $vendedor->chamados_abertos++; 
            $vendedor->save();
            $chamado->save();
            
        }
        return Redirect::to('/crud-chamado');
   }
   public function updateView(Request $request){
        if(!empty($request)){
            $input = $request->all();
            $chamado = Chamado::find($input['id']);
            if(!empty($input['assunto'])){
                $chamado->assunto = $input['assunto'];
            }
            if(!empty($input['descricao'])){
                $chamado->descricao = $input['descricao'];
            }
            if(!empty($input['status'])){
            
                $vendedor = Vendedor::find($chamado->vendedor_id);
                if(!empty($vendedor)){
                    switch ($chamado->status) {
                        case "Aberto":
                            $vendedor->chamados_abertos--;
                            break;
                        case "Atrasado":
                            $vendedor->chamados_abertos--;
                            break;
                        case "Atendimento":
                            $vendedor->chamados_em_atendimento--;
                            break;
                        case "Resolvido":
                            $vendedor->chamados_resolvidos--;
                            break;    
                    }
                    switch ($input['status']) {
                        case "Aberto":
                            $vendedor->chamados_abertos++;
                            break;
                        case "Atrasado":
                            $vendedor->chamados_abertos++;
                            break;
                        case "Atendimento":
                            $vendedor->chamados_em_atendimento++;
                            break;
                        case "Resolvido":
                            $vendedor->chamados_resolvidos++;
                            break;    
                    }
                    $chamado->status = $input['status'];
                    $vendedor->save();
                }
                
            }
            if(!empty($input['created_at'])){
            $chamado->created_at = $input['created_at'];
            }
            $chamado->save();


        }
        return Redirect::to('/crud-chamado');
   }
   public function deleteView(Request $request){
        if(!empty($request)){
            $input = $request->all();
            $chamado = Chamado::find($input['id']);
            $vendedor = Vendedor::find($chamado->vendedor_id);
            if(!empty($vendedor)){
                switch ($chamado->status) {
                    case "Aberto":
                        $vendedor->chamados_abertos--;
                        break;
                    case "Atrasado":
                        $vendedor->chamados_abertos--;
                        break;
                    case "Em andamento":
                        $vendedor->chamados_em_atendimento--;
                        break;
                    case "Resolvido":
                        $vendedor->chamados_resolvidos--;
                        break;    
                }
                $vendedor->save();
            }
            $chamado->delete();
            
        }
        return Redirect::to('/crud-chamado'); 
   }    
   public function atrasados(){
    $d1 = new \DateTime();
    $d1->sub(new \DateInterval('P1D'));
    $chamados = Chamado::where('status', 'Aberto')
                   ->where('created_at', '<' ,date_format($d1, 'Y-m-d'))
                   ->get();
               var_dump($chamados);     
    
            foreach ($chamados as $chamado){
                $chamado->status = "Atrasado";
                $chamado->save();
        }
    
   }
   public function meusChamados($id){
      
       return view('meus-chamados')->with(['id' => $id]);

   }

    protected $model = Chamado::class; 
    public function resolveUser()
    {
        return Auth::guard('sanctum')->user();
    }
}