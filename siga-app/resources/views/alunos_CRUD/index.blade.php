@extends('layout.sistema')
@section('titulo', 'Alunos')

@section('conteudo')


<div>

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

        <div class='table-responsive'>
            <a href="{{ route('alunos.create')}}">
                <button class="btn btn-dark">Cadastrar</button>
            </a><br><br>

            <form id='form-pesquisa' class="pl-2" action="{{ route('alunos.pesquisar') }}" method="post">
                @csrf
                <div class="form-row">
                  <input type="text" class='form-control col-sm-4 ' name="pesquisa" value="" placeholder="Nome">

                  <input type="text" class='form-control col-sm-4 ' name="ano_turma" value="" placeholder="Ano e Turma">

        
                  <input style='margin-left: 2px;' type="submit" class='form-control col-sm-1' name="" value="Buscar">
                  
                </div><br>

            </form>
            
            @if(isset($dataForm)) 
                {{$alunos->appends($dataForm)->links()}}
            @else
                {{$alunos->links()}}
            @endif
              
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Ano e Turma</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>

                @foreach($alunos as $aluno)
                    <tr>
                        <th scope="row">{{ $aluno->id }}</th>
                        <td>{{ $aluno->email }}</td>
                        <td>{{ $aluno->name }}</td>
                        <td>{{ $aluno->ano_turma }}</td>
                        <td class='row'>
                            <a class='mr-1' href="{{ route('alunos.edit', $aluno) }}">
                                <span onclick="$('#form-edit-{{ $aluno->id }}').submit()" class="btn btn-primary">
                                    <i class="fa fa-pen"></i>
                                </span>
                            </a>

                            
                               
                            <form method="post" id="form-del-{{ $aluno->id }}" action="{{ route('alunos.destroy', $aluno) }}">
                                @csrf
                                <input type="hidden" name='_method' value="DELETE">
                            </form>  
                                  
                            <span onclick="$('#form-del-{{ $aluno->id }}').submit()" class="btn btn-danger">
                                <i class="fa fa-ban"></i>
                            </span>        
                                
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>




@endsection
