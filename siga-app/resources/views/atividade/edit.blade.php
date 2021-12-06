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
        
    
        <form name="formEdit" id="formEdit" method="post" action="{{ route('atividades.update', $atividade->id) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="mx-auto">

            <!-- Upload image input-->
            <div class="form-group text-center">
                <label for="" class="text-center">Arquivo</label>
                <div class="input-group px-2 py-2 rounded-pill bg-white shadow-sm">

                    <input required id="upload" type="file" onchange="readURL(this);" class="form-control border-0" name="arquivo" id="arquivo">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Escolha o arquivo</label>
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-primary text-white m-0 rounded-pill px-4"> 
                            <i class="fa fa-cloud-upload mr-2 text-muted"></i>
                            <small class="text-uppercase font-weight-bold ">Escolha o arquivo</small>
                        </label>
                    </div>
                </div>

                <div class="image-area mt-4">
                    <img width="300" height="300" id="imageResult" src="{{ asset($atividade->arquivo) }}" alt="" class="img-fluid rounded shadow-sm mx-auto d-flex">
                </div>

            </div>
            </div>

            <div class='form-row'>
                <div class="form-group col-sm-4 mb-5 px-2 py-2">
                    <label for="" class="text-center">Ano e Turma</label>
                    <input minlength="7" maxlength="10" required type="text" class="ano_turma form-control"  name="ano_turma" id="ano_turma" placeholder="Digite o Ano e Turma" value="{{$atividade->ano_turma ?? ''}}">
                </div>

                <div class="form-group col-sm-4 mb-5 px-2 py-2">
                    <label for="" class="text-center">Título</label>
                    <input minlength="0" maxlength="50" required type="text" class="titulo form-control"  name="titulo" id="titulo" placeholder="Digite o título" value="{{$atividade->titulo ?? ''}}">
                </div>

                <div class="form-group col-sm-4 mb-5 px-2 py-2">
                    <label for="" class="text-center">Descrição</label>
                    <input required type="text" class="descricao form-control"  name="descricao" id="descricao" placeholder="Digite o Ano e Turma" value="{{$atividade->descricao ?? ''}}">
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
