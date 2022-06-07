<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{url('assets/img/favicon.png')}}">
    
    <title>Manutenções Preventivas</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{url('assets/vendor/font-awesome/5.14.0/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">

</head>
<body class="bg-gradient-primary login-page">
    <div id="app">
        <section>
            <div class="container p-5">
                <div class="row">
                    <div class="m-auto card-white">
                        <div class="wrapper-page">
                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">
                                        <a class="login-logo mb-4 sidebar-brand d-flex align-items-center justify-content-center" href="#">
                                            <div class="sidebar-brand-icon rotate-n-15">
                                                <i class="fas fa-tractor"></i>
                                            </div>
                                            <div class="sidebar-brand-text mx-3">Manutenções Preventivas</div>
                                        </a>
                                        <h5 class="text-uppercase font-bold m-b-5 m-t-15">Acesso ao Sistema</h5>
                                    </div>
                                    <div class="account-content">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group row">
                                             <div class="col-md-12">
                                                <label for="email">Endereço de e-mail: </label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="password">Senha:</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Lembrar Senha') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" name="button" class="botao_padrao" id="button" value="Confirma">Entrar</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="{{url('assets/js/javascript.js')}}"> </script>
</body>
</html>



