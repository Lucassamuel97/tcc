@extends('layouts.app')

@section('content')

<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Maquinários</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{url('machines/create')}}">
				<button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Novo Maquinário</button>
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
				<td class="text-center">
					<a class="btn btn-outline-primary" href="{{url("machines/$machine->id/edit")}}" title="Editar"> 
						<i class="fas fa-edit" aria-hidden="true"></i>
					</a>
					<a class="btn btn-outline-secondary" href="{{url("machines/$machine->id")}}" title="Visualizar"> 
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
					<a class="btn btn-outline-primary" target="_blank" href="{{url("/machines/$machine->id/qrcode/print")}}" title="Imprimir QRCODE"> 
						<i class="fas fa-qrcode"></i>
					</a>

					@auth
		            <?php if (Auth::user()->is_admin): ?>
						<a class="js-del btn btn-outline-danger" title="Deletar" href="{{url("machines/$machine->id")}}">
							<i class="fas fa-trash-alt"></i>
						</a>
		            <?php endif ?>
		            @endauth
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$machines->links()}}
</div>
@endsection




