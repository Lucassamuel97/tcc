@extends('layouts.app')

@section('content')
<div class="col-12 m-auto card-white">

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Relatório de Gastos com Manutenções</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			
			<button type="button" class="btn btn-danger waves-effect w-md waves-light ml-2" onclick="window.history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
		</div>
	</div>

	@if(isset($errors) && count($errors)> 0)
	<div class="text-center mt-4 mb-4 p-2 alert-danger">
		@foreach($errors->all() as $erro)
		{{$erro}}<br>
		@endforeach
	</div>
	@endif

	<form name="formCad" id="formCad" method="GET" action="{{url('/report/maintenances/expenses/pdf')}}" target="_blank">
		<div class="row">
			<div class="col-md-12">
				<div class="form-row">

					@auth
            		<?php if (Auth::user()->is_admin): ?>

					<div class="form-group col-md-6">
						<label for="user" class="col-form-label">Usuário Responsável: </label>
						<select class="form-control" name="user" id="user">
							<option value="">Todos</option>
							@if(isset($users) && count($users)> 0)	
							@foreach($users->all() as $user)
							<option value="{{$user->id}}">{{$user->name}}</option>
							@endforeach
							@endif
						</select>
					</div>
					<?php endif ?>
            		@endauth

					<div class="form-group col-md-6">
						<label for="machine" class="col-form-label">Maquinario: </label>
						<select class="form-control" name="machine" id="machine">
							<option value="">Todos</option>
							@if(isset($machines) && count($machines)> 0)	
							@foreach($machines->all() as $machine)
							<option value="{{$machine->id}}">{{$machine->description}}</option>
							@endforeach
							@endif
						</select>
					</div>


					<div class="form-group col-md-6">
						<label for="initial_date" class="col-form-label">Data Inicial: </label>
						<input type="date" class="form-control" id="initial_date" name="initial_date">
					</div>

					<div class="form-group col-md-6">
						<label for="final_date" class="col-form-label">Data Final: </label>
						<input type="date" class="form-control" id="final_date" name="final_date">
					</div>

				</div>

				<button type="submit" class="btn btn-success" style="width: 130px" id="botao">Gerar relatório</button>
				<button type="reset" class="btn btn-danger ml-4">Limpar</button>
			</div>
		</div>
	</form>
</div>
@endsection