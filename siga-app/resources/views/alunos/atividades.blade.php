@extends('alunos.layout.sistema')
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


<div class='card'>
    <div class='card-body'>
        @if(isset($errors) and count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                {{$error}}
                @endforeach
            </div>
        @endif
        
    @foreach($atividades as $atividade)

        
            <!-- Uploaded image area-->
                
                <div class="image-area mt-4">
                    <img width="300" height="300" id="imageResult" src="{{ asset($atividade->arquivo) }}" alt="" class="img-fluid rounded shadow-sm mx-auto d-flex">
                </div>

                <a class='d-flex justify-content-center pt-2' href="{{route('download.arquivo', $atividade )}}">
                    <span onclick="$('#form-download-{{ $atividade->arquivo }}').submit()" class="btn btn-primary btn-lg">
                        <i> Baixar </i>
                    </span>
                </a>





            <div class='form-row pt-2'>

                    <div class="form-group col-sm-4 mb-5 px-2 py-2">
                        <label for="" class="text-center">Ano e Turma</label>
                        <input disabled minlength="7" maxlength="10" required type="text" class="ano_turma form-control font-weight-bold"  name="ano_turma" id="ano_turma" placeholder="Digite o Ano e Turma" value="{{$atividade->ano_turma ?? ''}}">
                    </div>

                    <div class="form-group col-sm-4 mb-5 px-2 py-2">
                        <label for="" class="text-center ">Título</label>
                        <input disabled minlength="0" maxlength="50" required type="text" class="titulo form-control font-weight-bold"  name="titulo" id="titulo" placeholder="Digite o título" value="{{$atividade->titulo ?? ''}}">
                    </div>

                    <div class="form-group col-sm-4 mb-5 px-2 py-2">
                        <label for="" class="text-center">Descrição</label>
                        <input disabled required type="text" class="descricao form-control font-weight-bold"  name="descricao" id="descricao" placeholder="Digite o Ano e Turma" value="{{$atividade->descricao ?? ''}}">
                    </div>

            </div>
            <br>
            <br>
            <br>
            <br>
            <br>


     @endforeach 

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
                $("#imageResult").removeClass('d-none');
                $("#imageResult").addClass('d-block');

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
