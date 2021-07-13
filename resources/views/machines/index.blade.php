@extends('layouts.app')

@section('content')

<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Maquinários</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{url('machines/create')}}">
				<button class="btn btn-sm btn-outline-secondary">Novo Maquinário</button>
			</a>
		</div>
	</div>

	@if(isset($errors) && count($errors)> 0)
	<div class="text-center mt-4 mb-4 p-2 alert-danger">
		@foreach($errors->all() as $erro)
		{{$erro}}<br>
		@endforeach
	</div>
	@endif

	@csrf
	<table class="table table-bordered table-hover table-sm" width="100%">
		<thead>
			<tr>
				<th scope="col" width="30%">Descrição</th>
				<th scope="col" width="15%">Nº Identificação</th>
				<th scope="col" width="10%">Status</th>
				<th scope="col" width="20%">Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach($machines as $machine)
			<tr>
				<td>{{$machine->description}}</td>
				<td>{{$machine->identification_number}}</td>
				<td>@if($machine->status == "1")Ativo @else Inativo @endif</td>
				<td>
					<a href="{{url("machines/$machine->id")}}"><button class="btn btn-dark">Visualizar</button></a>
					<a href="{{url("machines/$machine->id/edit")}}"><button class="btn btn-primary">Editar</button></a>

					<a class="js-del" href="{{url("machines/$machine->id")}}">
						<button class="btn btn-danger">Deletar</button>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$machines->links()}}
</div>
@endsection




