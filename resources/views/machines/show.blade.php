@extends('layouts.app')

@section('content')
<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Maquinário > Visualizar</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<button type="button" class="btn btn-danger waves-effect w-md waves-light" onclick="window.history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
		</div>
	</div>
	Descrição: {{$machine->description}}<br>
	Status: {{$machine->status}}<br>
	Fabricante: {{$machine->manufacturer}}<br>
	Nº de Identificação: {{$machine->identification_number}}<br>
	Nº do Motor: {{$machine->engine_number}}<br>
	Nº de série: {{$machine->serial_number}}<br>
	Nº da Montagem: {{$machine->mounting_number}}<br>
	Ano fabricação: {{$machine->year_manufacture}}<br>
	Modelo: {{$machine->model}}<br>
	Nº Hodometrô: {{$machine->hodometro}}<br>
	
	@include('machines.qrcode')
	
</div>
@endsection