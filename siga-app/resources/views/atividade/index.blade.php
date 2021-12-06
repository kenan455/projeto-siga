@extends('layout.sistema')
@section('titulo', 'Atividades')

@section('conteudo')
<div>


<div class='card'>
    <div class='container'> 

    </div>
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
            <a href="{{ route('atividades.create')}}">
                <button class="btn btn-dark">Cadastrar</button>
            </a><br><br>

        <form id='form-pesquisa' class="pl-2" action="{{ route('atividades.pesquisar') }}" method="post">
                @csrf
                <div class="form-row">
                  <input type="text" class='form-control col-sm-4 ' name="id_titulo" value="" placeholder="ID ou titulo">

                  <input type="text" class='form-control col-sm-4 ' name="ano_turma" value="" placeholder="Ano e Turma">

        
                  <input style='margin-left: 2px;' type="submit" class='form-control col-sm-1' name="" value="Buscar">
                  
                </div><br>

        </form>
        @if(isset($dataForm)) 
            {{$atividades->appends($dataForm)->links()}}
        @else
            {{$atividades->links()}}
        @endif


        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Arquivo</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ano/Turma</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($atividades as $atividade)
                    @php
                        
                    @endphp
                    <tr>
                        <th scope="row">{{ $atividade->id }}</th>
                        <td>{{ $atividade->arquivo }}</td>
                        <td>{{ $atividade->titulo }}</td>
                        <td>{{ $atividade->descricao }}</td>
                        <td>{{ $atividade->ano_turma  }}</td>
                        
                        <td class='row'>
                            <a class='mr-1' href="{{ route('atividades.edit', $atividade) }}">
                                <span onclick="$('#form-edit-{{ $atividade->id }}').submit()" class="btn btn-primary">
                                    <i class="fa fa-pen"></i>
                                </span>
                            </a>

                            
                               
                            <form method="post" id="form-del-{{ $atividade->id }}" action="{{ route('atividades.destroy', $atividade) }}">
                                @csrf
                                <input type="hidden" name='_method' value="DELETE">
                            </form>  
                                  
                            <span onclick="$('#form-del-{{ $atividade->id }}').submit()" class="btn btn-danger">
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
