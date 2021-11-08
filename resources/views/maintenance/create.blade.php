@extends('layouts.app')

@section('content')
<div class="col-12 m-auto card-white">

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Cadastro de Manutenções</h1>
		<div class="btn-toolbar mb-2 mb-md-0">

			<a href='{{url("maintenance/$machine->id/")}}'>
				<button class="btn btn-info"><i class="fa fa-search m-r-5"></i> Listar Manutenções</button>
			</a>

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

    <div class="mt-2 mb-2 p-1 alert-info">
    	<p class="text-muted font-13">
			<h6>Maquinário selecionado: <b>{{ $machine->description }}</b></h6>
			N° Identificação: <b>{{ $machine->identification_number }} </b>
    		Ano: <b>{{$machine->year_manufacture}} </b>
		</p>
    </div>

	@if(isset($maintenance))
	<form name="formEdit" id="formEdit" method="POST" action="{{url("maintenance/$maintenance->id")}}">
		@method('PUT')
		@else
		<form name="formCad" id="formCad" method="POST" action="{{url('maintenance')}}">
			@endif
			@csrf
			<div class="row">
				<div class="col-md-12">
					<p class="text-muted m-b-30 font-13">
						Todos os campos com <code 1class="highlighter-rouge">*</code> são obrigatorios.
					</p>
					<div class="form-row">
						<input type="hidden" id="machine_id" name="machine_id" value="{{$machine->id}}">

						<div class="form-group col-md-12">
							<label for="description" class="col-form-label">Descrição: <code class="highlighter-rouge">*</code></label>
							<input type="text" class="form-control" id="description" name="description" required value="{{ $maintenance->description ?? old('description')}}">
						</div>

						<div class="form-group col-md-6">
							<label for="range_hodometro" class="col-form-label">Realizar manutenção a cada tanta horas: <code class="highlighter-rouge">*</code></label>
							<input type="number" class="form-control" id="range_hodometro" name="range_hodometro" required value="{{$maintenance->range_hodometro ?? old('range_hodometro')}}">
						</div>

                        <div class="form-group col-md-6">
							<label for="range_months" class="col-form-label">Realizar manutenção a cada tantos Meses: <code class="highlighter-rouge">*</code></label>
							<input type="number" class="form-control" id="range_months" name="range_months" required value="{{$maintenance->range_months ?? old('range_months')}}">
						</div>

                        <div class="form-group col-md-6">
							<label for="last_hodometro" class="col-form-label">Hodômetro da última manutenção: <code class="highlighter-rouge">*</code></label>
							<input type="number" class="form-control" id="last_hodometro" name="last_hodometro" required value="{{$maintenance->last_hodometro ?? old('last_hodometro')}}">
						</div>

                        <div class="form-group col-md-6">
							<label for="last_months" class="col-form-label">Data da última manutenção: <code class="highlighter-rouge">*</code></label>
							<input type="date" class="form-control" id="last_months" name="last_months" required value="{{$maintenance->last_months ?? old('last_months')}}">
						</div>
					</div>

					<button type="submit" class="btn btn-success" style="width: 130px" id="botao">Gravar</button>
					<button type="reset" class="btn btn-danger ml-4">Limpar</button>
				</div>
			</div>
		</form>

	</div>
	@endsection
