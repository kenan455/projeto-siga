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
        
    
        <div class="container">  

            <div class="py-3 text-center">
                <img class="d-block mx-auto mb-2" src="{{ url('assets/img/email.png') }}" alt="" width="72" height="72">
                <h2>Contate seu professor</h2>
            </div>

            <div class="row">
                <div class="col-md-12">
                
                    <div class="card-body font-weight-bold">
                        <form action="{{ route('alunos.enviar_email') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="para">Para</label>
                                <select name="para" type="text" class="form-control" id="para">
                                    @foreach($alunos as $aluno)
                                        <option name="para"  value="{{$aluno->email}}" >{{$aluno->email}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="assunto">Assunto</label>
                                <input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assundo do e-mail">
                            </div>

                            <div class="form-group">
                                <label for="mensagem">Mensagem</label>
                                <textarea name="mensagem" class="form-control" id="mensagem"></textarea>
                            </div>

                            <div class="d-flex justify-content-center pt-5">
                                <button class="btn btn-primary btn-lg">Enviar Mensagem</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
