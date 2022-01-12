@extends('layouts.app')

@section('content')
<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Lançamentos Hodômetro > Histórico</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<button type="button" class="btn btn-danger waves-effect w-md waves-light" onclick="window.history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
		</div>
	</div>

    @include('machines.machineDetails')

	<table class="table table-bordered table-hover table-sm mt-3" width="100%">
		<thead>
			<tr>
				<th scope="col" width="20%">Data</th>
				<th scope="col" width="40%">Hodometro</th>
				<th scope="col" width="40%">Responsável</th>
			</tr>
		</thead>
		<tbody>
			@foreach($historic as $row)
			<tr>
				<td>{{$row->created_at}}</td>
				<td>{{$row->hodometro}}</td>
				<td>{{$row->relUser()->first()->name}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection