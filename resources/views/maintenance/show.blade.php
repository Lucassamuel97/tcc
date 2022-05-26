@extends('layouts.app')

@section('content')
<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Manutenção > Histórico geral</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<button type="button" class="btn btn-danger waves-effect w-md waves-light" onclick="window.history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
		</div>
	</div>

    @include('machines.machineDetails')

	Descrição: {{$maintenance->description}}<br>
	Realizar manutenção a cada tanta horas: {{$maintenance->range_hodometro}}h<br>
	Realizar manutenção a cada tantos Meses: {{$maintenance->range_months}}<br>
	Hodômetro da última manutenção: {{$maintenance->last_hodometro}}<br>
	
	<div class="mt-2 mb-2 p-2 {{ $maintenance->hodometro_balance <  50 ? $maintenance->hodometro_balance <= 0 ? 'fd-danger':'fd-warning' : 'alert-success'}}">
		Hodometro próxima realização: {{$maintenance->limit_hodometro}}h<br>
	</div>
	<div class="mt-2 mb-2 p-2 {{ $maintenance->days <=  30 ? $maintenance->days <= 0 ? 'fd-danger':'fd-warning' : 'alert-success'  }}">
		Data para próxima realização: {{date('d/m/Y', strtotime($maintenance->limit_date))}}<br>
	</div>

	<table class="table table-bordered table-hover table-sm mt-3" width="100%">
		<thead>
			<tr>
				<th scope="col" width="10%">Operação</th>
				<th scope="col" width="20%">Data</th>
				<th scope="col" width="20%">Responsável</th>
				<th scope="col" width="40%">Detalhes</th>
			</tr>
		</thead>
		<tbody>
			@foreach($maintenances as $key => $row)
			<tr>
				<td><b>{{$row->operation}}</b></td>
				<td>{{date('d/m/Y H:i:s', strtotime($row->data))}}</td>
				<td>{{$row->user}}</td>
				<td>
				@if($row->operation == "Adiamento")
					Hodometro adiado em: {{$row->hodometro}}h<br>
					Meses adiados em: {{$row->mes}} Meses<br>
					Observação: {{$row->note}}
				@else
					Realizada em: {{$row->hodometro}}h<br>
					Preço: R$ {{$row->price}}<br>
					Observação: {{$row->note}}
				@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection