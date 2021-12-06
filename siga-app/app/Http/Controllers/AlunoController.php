<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Aluno;


use Illuminate\Http\Request;

class AlunoController extends Controller
{   
    private $objUser;
    private $objAluno;

    public function __construct()
    {
        $this->objUser = new User();
        $this->objAluno = new Aluno();
    }

    public function home()
    {   
        return view('alunos/dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = array(
            array('nome' => "Dashboard", "rota" => "professor.geral.home"), 
            array('nome' => "Alunos")
        );  

        $alunos = $this->objUser->where('nivel', 2)->paginate(10);




        return view('alunos_CRUD/index', compact('alunos', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisa(Request $req)
    {   
        $breadcrumbs = array(
            array('nome' => "Dashboard", "rota" => "professor.geral.home"), 
            array('nome' => "Alunos")
        );  

        $resposta = $this->objAluno->pesquisa($req);
        $alunos = $resposta['resposta'];
        $dataForm = $resposta['dataForm'];

        
        
        //dd($dataForm);
        return view('alunos_CRUD/index', compact('alunos', 'dataForm', 'breadcrumbs'));
    }


    public function create()
    {
        $breadcrumbs = array(
            array('nome' => "Dashboard", "rota" => "professor.geral.home"), 
            array('nome' => "Alunos", "rota" => "alunos.index"),
            array('nome' => "Cadastrar")
        );

        return view('alunos_CRUD/create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->objUser->rules(0), $this->objUser->messages());
        $dados = $request->except("_token");
        
        $dados['ativo'] = 1;
        $dados['nivel'] = 2;
        $dados['password'] = Hash::make($dados['password']);
        
        $user = User::create($dados);
        
        if ($user) {
            return redirect()->route('alunos.index')->with('status', 'Aluno cadastrado com sucesso.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = User::FindOrFail($id);
        
        return view('alunos_CRUD/edit', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $dados = $request->except(['_token', '_method']);
        

        $this->objUser->where(['id'=>$id])->update($dados);
        return redirect()->route('alunos.index')->with('status', 'Atividade atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::FindOrFail($id)->delete();

        return redirect()->route('alunos.index')->with('status', 'Aluno excluído com sucesso.');

    }

    public function login(){
        return view('alunos.login');
    }

    public function auth(Request $request)
    {   
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if ( Auth::user()->nivel == 1) {
                return view('dashboard');
            } else if ( Auth::user()->nivel == 2) { 
                if(Auth::user()->ativo){
                    return view('alunos.dashboard');
                } else {
                    return redirect()->back()->with('danger', 'Usuário inativo');        
                }
            }
        }else {
            return redirect()->back()->with('danger', 'E-mail ou senha inválida');
        }
    }

    public function contatoProfessor()
    {
        $alunos = $this->objUser->where('nivel', 1)->paginate(5);
        

        return view('alunos.contato_professor', compact('alunos'));
    }


    public function mudarSenha()
    {
        return view('alunos.senha');
    }

    public function atualizarSenha(Request $req){
        $dados = $req->all();
        if ($dados['password'] != $dados['confirmar-password']) {
            return redirect()->route('aluno.mudar_senha')->with('alert', 'Senhas não conferem.');
        }
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect()->route('aluno.mudar_senha')->with('status', 'Senha atualizada com sucesso.');
    }

    public function enviarEmail()
    {   
        return view('alunos.processa_envio');
    }


    
    
}
