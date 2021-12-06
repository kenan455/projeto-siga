<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Atividade extends Model
{
    use HasFactory;

    protected $table = "atividades";

    protected $fillable = ['arquivo', 'titulo', 'descricao', 'ano_turma', 'ativo'];
    
	
    private $porPagina = 10;

    public function getPorPagina(){
        return $this->porPagina;
    }

    
    public function pesquisa($req){
        $dados = $req->all();

        if (isset($dados['id_titulo']) && $dados['id_titulo'] != null ) {

            $resposta = Atividade::where(function($query) use ($dados){
                $query->Where('titulo', 'like', $dados['id_titulo']."%")
                ->orWhere('id', '=', intval($dados['id_titulo']));
            })
            ->paginate($this->getPorPagina());
            
        } else {
            
            $resposta = Atividade::where(function($query) use ($dados){
                $query->Where('ano_turma', 'like', $dados['ano_turma']."%");
            })
            ->paginate($this->getPorPagina());
 
        }

        $dataForm = $req->except('_token');
        $retornar['resposta'] = $resposta;
        $retornar['dataForm'] = $dataForm;
        
        return $retornar;

    }
}
