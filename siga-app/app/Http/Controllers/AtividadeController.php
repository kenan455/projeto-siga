<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    private $objAtividade;

    public function __construct()
    {
        $this->objAtividade = new Atividade();
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
            array('nome' => "Atividades")
        );  

        $atividades = $this->objAtividade->paginate(10);


        return view('atividade/index', compact('atividades', 'breadcrumbs'));
        
        
        /*dd($this->objAtividade->find($turma->turma_id)->relTurmas->ano_turma);*/    
    }

    public function pesquisa(Request $req)
    {   
        $breadcrumbs = array(
            array('nome' => "Dashboard", "rota" => "professor.geral.home"), 
            array('nome' => "Atividades")
        );  
        
        $resposta = $this->objAtividade->pesquisa($req);
        $atividades = $resposta['resposta'];
        $dataForm = $resposta['dataForm'];
        
        
        //dd($dataForm);
        return view('atividade/index', compact('atividades', 'dataForm', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $breadcrumbs = array(
            array('nome' => "Dashboard", "rota" => "professor.geral.home"), 
            array('nome' => "Atividades", "rota" => "atividades.index"),
            array('nome' => "Cadastrar")
        );

        
        return view('atividade/create', compact('breadcrumbs'));
    }

    public function inserirAnexo($anexo, $pasta){
        $num = rand(1111, 9999);
        $dir = "arquivos/$pasta";
        $type = "arquivos/$pasta";
        $ex = $anexo->guessClientExtension();
        $nomeAnexo = time().random_int(100, 999) .'.' . $ex;
        public_path($dir.''.$type.'/'.$nomeAnexo.'/');
        $anexo->move($dir, $nomeAnexo);
        return $dir."/".$nomeAnexo;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dados = $request->all();
        
        $dados['ativo'] = 1;

        
        if(isset($request->arquivo)){
            $dados['arquivo'] = $this->inserirAnexo($request->arquivo, 'arquivos');
        }
        

        $cad = $this->objAtividade->create($dados);
        
        
        if ($cad) {
            return redirect()->route('atividades.index')->with('status', 'Atividade cadastrada com sucesso.');
        }
        
    }


    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atividade = Atividade::FindOrFail($id);
        // dd($supermercado);
        return view('atividade/edit', compact('atividade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->except(['_token', '_method']);
        
        if(isset($request->arquivo)){
            $dados['arquivo'] = $this->inserirAnexo($request->arquivo, 'arquivos');
        } else {
            $dados['arquivo'] = Atividade::find($id)->arquivo;
        }

        $this->objAtividade->where(['id'=>$id])->update($dados);
        return redirect()->route('atividades.index')->with('status', 'Atividade atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {   
        Atividade::FindOrFail($id)->delete();

        
               
        return redirect()->route('atividades.index')->with('status', 'Atividade excluído com sucesso.');
    }


    public function atividades(){
        $atividades = $this->objAtividade->paginate(10);
        return view('alunos.atividades', compact('atividades'));
    }


    public function downloadArquivo($id)
    {   
        $arquivo = Atividade::find($id)->arquivo;
        


        return response()->download(public_path() . '/' . $arquivo);
        
    }

}
