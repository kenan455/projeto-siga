@extends('alunos.layout.sistema')
@section('titulo', 'SIGA')

@section('conteudo')

<div class='card'>
    <div class='card-body'>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div><br>
        @endif
        @if (session('alert'))
            <div class="alert alert-danger">
                {{ session('alert') }}
            </div><br>
        @endif
        
    
        <form method="post" action="{{ route('aluno.atualizar_senha') }}">
        @csrf
        <div class="mx-auto">
            <div class='form-row'>
                <div class="form-group col-sm-6 mb-5 px-2 py-2">
                    <label for="">Nova Senha</label>
                    <input minlength="6" maxlength="100" required type="password" class="form-control" name="password" id="password" placeholder="Digite a nova Senha" value="">
                </div> 
                <div class="form-group col-sm-6 mb-5 px-2 py-2">
                    <label for="">Confirmar Nova Senha</label>
                    <input minlength="6" maxlength="100" required type="password" class="form-control" name="confirmar-password" id="confirmar-password" placeholder="Digite a nova Senha Novamente" value="">
                </div> 
            </div>
            <input class="form-control btn btn-primary" type="submit" value="Salvar">
        </div>
        </form>
    </div>
</div>

@endsection
