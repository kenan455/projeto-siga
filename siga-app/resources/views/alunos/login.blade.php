<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>SIGA- Login</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ url('assets/img/favicon.jpg') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ url('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ url('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ url('assets/css/argon.css?v=1.2.0') }}" type="text/css">
</head>

<body class="bg-default">
  <div class="main-content" style=''>
    <!-- Header -->
    {{-- bg-gradient-primary  --}}
    <div style="background: #f7f7f7" class="header py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <img width="250" src="{{ asset('assets/img/logo_sem_sub.jpg') }}" alt="">
              <h1 class="pt-5 text-blue">Sistema Integrado de Gestão Administrativa</h1>
              <p class="text-lead text-white"></p>
            </div>
          </div>
        </div>
      </div>

      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    
    <div class="container mt--8 pb-5">
      
      <div class="row justify-content-center">

        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-white mb-4">
                <small>Faça o Login</small>
              </div>
              <form role="form" method="post" action="{{route('auth.aluno')}}">
                @csrf 
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input required class="form-control" minlength="6" maxlength="191" type="email" name="email" value="" placeholder="Seu email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input required class="form-control" minlength="6" maxlength="191" type="password" name="password" value="" placeholder="Sua Senha">
                  </div>
                </div>
                @if(session('danger'))
                    <div class="alert alert-danger">
                      {{ session('danger') }}
                    </div>
                  @endif
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Entrar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="#" class="text-light"><small></small></a>
            </div>
            <!--
            <div class="col-6 text-right">
              <a href="#" class="text-light"><small>Criar nova conta</small></a>
            </div>
            -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main" style="">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2021 <a href="#" class="font-weight-bold ml-1">SIGA</a>
          </div>
        </div>
        <div class="col-xl-6">
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ url('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ url('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ url('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ url('assets/js/argon.js?v=1.2.0') }}"></script>
</body>

</html>