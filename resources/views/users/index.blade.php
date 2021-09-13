@extends('layouts.app')

@section('content')

<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Usuários</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{url('users/create')}}">
				<button class="btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i> Novo Usuário</button>
			</a>
		</div>
	</div>

	<form action="">
		<div class="row mb-2">
			<div class="col-md-7 offset-md-3">
				<div class="input-group">
					<input type="text" name="q" id="search" placeholder="Pesquisar usuários!" class="form-control">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-outline-primary"><i class="fa fa-search m-r-5"></i> Pesquisar</button>
					</span>
				</div>
			</div>
		</div>
	</form>

	@csrf
	<table class="table table-bordered table-hover table-sm m-t-10" width="100%">
		<thead>
			<tr>
				<th scope="col" width="30%">Nome</th>
				<th scope="col" width="15%">Emails</th>
				<th scope="col" width="10%">Tipo usuário</th>
				<th scope="col" width="20%">Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>@if($user->is_admin == "1")Administrador @else Comum @endif</td>
				<td class="text-center">
					<a class="btn btn-outline-primary" href="{{url("users/$user->id/edit")}}" title="Editar"> 
						<i class="fas fa-edit" aria-hidden="true"></i>
					</a>
					<a class="js-del btn btn-outline-danger" href="{{url("users/$user->id")}}">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-md-4 offset-md-4">
			{{$users->links()}}
		</div>
	</div>
</div>	
@endsection




