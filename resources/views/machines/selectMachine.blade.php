@extends('layouts.app')

@section('content')

<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Manutenções > Selecionar maquinário</h1>
		<div class="btn-toolbar mb-2 mb-md-0">

		</div>
	</div>

	@if(isset($errors) && count($errors)> 0)
	<div class="text-center mt-4 mb-4 p-2 alert-danger">
		@foreach($errors->all() as $erro)
		{{$erro}}<br>
		@endforeach
	</div>
	@endif
	
	<form action="">
		<div class="row mb-2">
			<div class="col-md-7 offset-md-3">
				<div class="input-group">
					<input type="text" name="q" id="search" placeholder="Pesquisar maquinários!" class="form-control" value="{{$search}}">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-outline-primary"><i class="fa fa-search m-r-5"></i> Pesquisar</button>
					</span>
				</div>
			</div>
		</div>
	</form>

	@csrf
	<table class="table table-bordered table-hover table-sm" width="100%">
		<thead>
			<tr>
				<th scope="col">Descrição</th>
				<th scope="col">Nº Identificação</th>
				<th scope="col">Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach($machines as $machine)
			<tr>
				<td>{{$machine->description}}</td>
				<td>{{$machine->identification_number}}</td>
				<td class="text-center">

                    <a class="btn btn-outline-success" href="{{url("maintenance/$machine->id/create")}}" title="Cadastrar Manutenção"> 
                        <i class="fas fa-plus"></i> CADASTRAR MANUTENÇÃO
					</a>
                    <a class="btn btn-outline-info" href="{{url("$machine->id/maintenanceCheck/")}}" title="Checagem de Manutenção"> 
                        <i class="far fa-check-square"></i> CHECAGEM DE MANUTENÇÕES
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$machines->links()}}
</div>
@endsection




