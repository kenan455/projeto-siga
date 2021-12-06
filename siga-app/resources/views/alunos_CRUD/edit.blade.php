@extends('layout.sistema')
@section('titulo', 'SIGA')

@section('conteudo')

<style type="text/css">
        #upload {
            opacity: 0;
        }

        #upload-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

        .image-area {
            border: 2px dashed rgba(255, 255, 255, 0.7);
            padding: 1rem;
            position: relative;
        }

        .image-area::before {
            content: 'Uploaded image result';
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
            z-index: 1;
        }

        .image-area img {
            z-index: 2;
            position: relative;
        }
    </style>
<div class="col-lg-6 col-7">
    <!-- <h6 class="h2 text-white d-inline-block mb-0">Default</h6> -->
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Alunos   </a></li>
        <li class="breadcrumb-item"><a href="#">Editar   </a></li>
        <!-- <li class="breadcrumb-item active" aria-current="page">Default</li> -->
    </ol>
    </nav>
</div>

<div>

<div class='card'>
    <div class='card-body'>
        @if(isset($errors) and count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                {{$error}}
                @endforeach
            </div>
        @endif
        
    
        <form name="formCad" id="formCad" method="post" action="{{ route('alunos.update', $aluno->id) }}">
        @csrf
        <input type="hidden" name="_method" value="PUT">
            <div class='form-row'>

                <div class="form-group col-sm-4 mb-5 px-2 py-2">
                    <label for="" class="text-center">Nome</label>
                    <input required type="text" class="form-control"  name="name" id="name" placeholder="Digite o Nome" value="{{$aluno->name ?? ''}}">
                </div>

                <div class="form-group col-sm-4 mb-5 px-2 py-2">
                    <label for="" class="text-center">E-mail</label>
                    <input required type="email" class="form-control"  name="email" id="email" placeholder="Digite o E-mail" value="{{$aluno->email ?? ''}}">
                </div>

                <div class="form-group col-sm-4 mb-5 px-2 py-2">
                    <label for="" class="text-center">Senha</label>
                    <input minlength="6" maxlength="100" required type="password" class="form-control"  name="password" id="password" placeholder="Digite a Senha" value="{{$aluno->password ?? ''}}">
                </div>

                <div class="form-group col-sm-4 mb-5 px-2 py-2">
                    <label for="" class="text-center">Ano e Turma</label>
                    <input minlength="7" maxlength="10" required type="text" class="ano_turma form-control"  name="ano_turma" id="ano_turma" placeholder="Digite o Ano e Turma" value="{{$aluno->ano_turma ?? ''}}">
                </div>
                
            </div>

        

            

            <input class="form-control btn btn-primary" type="submit" value="Salvar">
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        /*  ==========================================
            SHOW UPLOADED IMAGE
        * ========================================== */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                     $('#imageResult')
                        .attr('src', e.target.result);
                    };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $('#upload').on('change', function () {
                readURL(input);
            });
        });

        /*  ==========================================
            SHOW UPLOADED IMAGE NAME
        * ========================================== */
        var input = document.getElementById( 'upload' );
        var infoArea = document.getElementById( 'upload-label' );

        input.addEventListener( 'change', showFileName );
        function showFileName( event ) {
          var input = event.srcElement;
          var fileName = input.files[0].name;
          infoArea.textContent = 'Nome do arquivo: ' + fileName;
        }
    </script>


@endsection
