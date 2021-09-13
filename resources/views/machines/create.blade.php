@extends('layouts.app')

@section('content')
<div class="col-12 m-auto card-white">

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Maquinário > @if(isset($machine))Editar @else Cadastrar @endif</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<button type="button" class="btn btn-danger waves-effect w-md waves-light" onclick="window.history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
		</div>
	</div>


	@if(isset($errors) && count($errors)> 0)
	<div class="text-center mt-4 mb-4 p-2 alert-danger">
		@foreach($errors->all() as $erro)
		{{$erro}}<br>
		@endforeach
	</div>
	@endif

	@if(isset($machine))
	<form name="formEdit" id="formEdit" method="POST" action="{{url("machines/$machine->id")}}">
		@method('PUT')
		@else
		<form name="formCad" id="formCad" method="POST" action="{{url('machines')}}">
			@endif
			@csrf
			<div class="row">
				<div class="col-md-12">
					<p class="text-muted m-b-30 font-13">
						Todos os campos com <code 1class="highlighter-rouge">*</code> são obrigatorios.
					</p>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="status" class="col-form-label">Status:</label>
							<select  class="form-control" name="status" id="status">
								<option value="1" @if(@$machine->status === 1) selected @endif>Ativo</option>
								<option value="0" @if(@$machine->status === 0) selected @endif>Inativo</option>
							</select>
						</div>

						<div class="form-group col-md-8">
							<label for="description" class="col-form-label">Descrição ou apelido: <code class="highlighter-rouge">*</code></label>
							<input type="text" class="form-control" id="description" name="description" required value="{{ $machine->description ?? old('description')}}">
						</div>


						<div class="form-group col-md-3">
							<label for="hodometro" class="col-form-label">Nº Hodometrô: <code class="highlighter-rouge">*</code></label>
							<input type="text" class="form-control" id="hodometro" name="hodometro" required value="{{$machine->hodometro ?? old('hodometro')}}">
						</div>

						<div class="form-group col-md-3">
							<label for="identification_number" class="col-form-label">Nº de Identificação: <code class="highlighter-rouge">*</code></label>
							<input type="text" class="form-control" id="identification_number" required name="identification_number" value="{{$machine->identification_number ?? old('identification_number')}}">
						</div>

						<div class="form-group col-md-3">
							<label for="serial_number" class="col-form-label">Nº de série:</label>
							<input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ $machine->serial_number ?? old('serial_number')}}">
						</div>

						<div class="form-group col-md-3">
							<label for="manufacturer" class="col-form-label">Fabricante:</label>
							<input type="text" class="form-control" id="manufacturer" name="manufacturer" value="{{$machine->manufacturer ?? old('manufacturer')}}">
						</div>

						<div class="form-group col-md-3">
							<label for="model" class="col-form-label">Modelo:</label>
							<input type="text" class="form-control" id="model" name="model" value="{{$machine->model ?? old('model')}}">
						</div>
						<div class="form-group col-md-3">
							<label for="engine_number" class="col-form-label">Nº do Motor:</label>
							<input type="text" class="form-control" id="engine_number" name="engine_number" value="{{$machine->engine_number ?? old('engine_number')}}">
						</div>
						<div class="form-group col-md-3">
							<label for="year_manufacture" class="col-form-label">Ano fabricação:</label>
							<input type="text" class="form-control" id="year_manufacture" name="year_manufacture" value="{{$machine->year_manufacture ?? old('year_manufacture')}}">
						</div>
						<div class="form-group col-md-3">
							<label for="mounting_number" class="col-form-label">Nº da Montagem:</label>
							<input type="text" class="form-control" id="mounting_number" name="mounting_number" value="{{$machine->mounting_number ?? old('mounting_number')}}">
						</div>
					</div>


					<button type="submit" class="btn btn-success" style="width: 130px" id="botao">Gravar</button>
					<button type="reset" class="btn btn-danger ml-4">Limpar</button>
				</div>
			</div>
		</form>

	</div>
	@endsection
