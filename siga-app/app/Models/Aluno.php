<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Aluno extends Model
{
    use HasFactory;

    protected $table = "alunos";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */

    private $porPagina = 10;

    public function getPorPagina(){
        return $this->porPagina;
    }

    public function pesquisa($req){
        $dados = $req->all();

        if (isset($dados['pesquisa']) && $dados['pesquisa'] != null ) {

            $resposta = User::where(function($query) use ($dados){
                $query->Where('name', 'like', $dados['pesquisa']."%")
                ->orWhere('id', '=', intval($dados['pesquisa']));
            })
            ->paginate($this->getPorPagina());
            
        } else {
            
            $resposta = User::where(function($query) use ($dados){
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
