@extends('layouts.app')

@section('content')

<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Manutenções <small>> Listagem</small></h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href='{{url("maintenance/$machine->id/create")}}'>
				<button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nova Manutenção</button>
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

    <div class="mt-2 mb-2 p-1 alert-info">
    	<p class="text-muted font-13">
			<h6>Maquinário selecionado: <b>{{ $machine->description }}</b></h6>
			N° Identificação: <b>{{ $machine->identification_number }} </b>
    		Ano: <b>{{$machine->year_manufacture}} </b>
		</p>
    </div>

	<form action="">
		<div class="row mb-2">
			<div class="col-md-7 offset-md-3">
				<div class="input-group">
					<input type="text" name="q" id="search" placeholder="Pesquisar manutenções!" class="form-control" value="{{$search}}">
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
				<th scope="col">Hodômetro última Manutenção</th>
				<th scope="col">Data da última manutenção</th>
				<th scope="col" width="20%">Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach($maintenances as $maintenance)
			<tr>
				<td>{{$maintenance->description}}</td>
				<td>{{$maintenance->last_hodometro}}</td>
				<td>{{date('d/m/Y', strtotime($maintenance->last_months))}}</td>				
				<td class="text-center">
					<a class="btn btn-outline-primary" href="{{url("maintenance/$maintenance->id/edit")}}" title="Editar"> 
						<i class="fas fa-edit" aria-hidden="true"></i>
					</a>
					<a class="js-del btn btn-outline-danger" title="Deletar" href="{{url("maintenance/$maintenance->id")}}">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$maintenances->links()}}
</div>
@endsection




