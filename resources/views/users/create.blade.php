@extends('layouts.app')

@section('content')
<div class="col-12 m-auto card-white">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
        <h1 class="h4">Usuário > @if(isset($user))Editar @else Cadastrar @endif</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{url('users')}}">
                <button class="btn btn-sm btn-outline-secondary">Voltar</button>
            </a>
        </div>
    </div>

    @if(isset($user))
    <form name="formEdit" id="formEdit" method="POST" action="{{url("users/$user->id")}}">
        @method('PUT')  
        @else
        <form name="formCad" id="formCad" method="POST" action="{{url('users')}}">
            @endif
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <p class="text-muted m-b-30 font-13">
                        Todos os campos com <code 1class="highlighter-rouge">*</code> são obrigatorios.
                    </p>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="is_admin" class="col-form-label">Tipo Usuário:</label>
                            <select  class="form-control" name="is_admin" id="is_admin">
                                <option value="0">Comum</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="name" class="col-md-4 col-form-label">Nome:</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name ?? old('name')}}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="col-md-4 col-form-label">Email:</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email ?? old('email')}}"  required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="col-md-4 col-form-label">Senha:</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password-confirm" class="col-md-4 col-form-label">Confirmar senha:</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-success" style="width: 130px" id="botao">Gravar</button>
                    <button type="reset" class="btn btn-danger ml-4">Limpar</button>
                </div>
            </div>
        </form>
        
    </div>
    @endsection
