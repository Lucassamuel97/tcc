@extends('layouts.app')

@section('content')

<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Usuários</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{url('users/create')}}">
				<button class="btn btn-sm btn-outline-secondary">Novo Usuário</button>
			</a>
		</div>
	</div>

	@csrf
	<table class="table table-bordered table-hover table-sm" width="100%">
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
				<td>
					<a href="{{url("users/$user->id/edit")}}"><button class="btn btn-primary">Editar</button></a>

					<a class="js-del" href="{{url("users/$user->id")}}">
						<button class="btn btn-danger">Deletar</button>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$users->links()}}
</div>
@endsection




