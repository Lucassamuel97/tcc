@extends('layouts.app')

@section('content')

<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-1 border-bottom">
		<h1 class="h5">Manutenções <small>> checagem</small></h1>
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

    @include('machines.machineDetails')

	<form action="" id="filters">
		<div class="row mb-2">
			<div class="col-md-4 offset-md-4">
      			<div class="input-group mb-2">
        			<div class="input-group-prepend">
          				<div class="input-group-text">Ordenar por:</div>
        			</div>
					<select class="js-filtro form-control" name="order" id="order">
						<option value="1">N° Hodômetro:</option>
						<option value="2"  @if(@$order == "2") selected @endif >Data</option>
						<option value="3"  @if(@$order == "3") selected @endif >Descrição</option>
					</select>
      			</div>
    		</div>
			<div class="col-md-4">
				<div class="input-group">
					<input type="text" name="q" id="search" placeholder="Pesquisar manutenções!" class="form-control" value="{{$search}}">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-outline-primary"><i class="fa fa-search m-r-5"></i></button>
					</span>
				</div>
			</div>
		</div>
	</form>

	@csrf
	<table class="table table-bordered table-hover table-sm mb-2" width="100%" >
		<thead>
			<tr>
				<th scope="col">Descrição</th>
				<th scope="col">N° Hodômetro previsto para realização: </th>
				<th scope="col">Data prevista para realizar: </th>
				<th scope="col" width="15%">Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach($maintenances as $maintenance)
			<tr>
				<td><a target="_blanck" href="{{url("maintenance/$maintenance->id/historic")}}" title="Historico">{{$maintenance->description}}</a></td>
	
				<td class="{{ $maintenance->hodometro_balance <  50 ? $maintenance->hodometro_balance <= 0 ? 'fd-danger':'fd-warning' : ''  }}">
					Realizar em: <b>{{$maintenance->limit_hodometro}} h</b> <br> 
					{{ $maintenance->hodometro_balance <= 0 ? 'Atrasada em:' : 'Horas restantes:'}}
					 <b>{{abs($maintenance->hodometro_balance)}} h</b> </td>
				</td>
				<td class="{{ $maintenance->days <=  30 ? $maintenance->days <= 0 ? 'fd-danger':'fd-warning' : ''  }}">
					Data prevista: <b>{{date('d/m/Y', strtotime($maintenance->limit_date))}}</b><br>
					{{ $maintenance->days <= 0 ? 'Atrasada em:' : 'Dias restantes:'}}
					 <b>{{abs($maintenance->days)}} Dias</b> </td>
				</td>		
				<td class="text-center">
					<button class="demo-delete-row btn btn-success btn-xs btn-icon" onclick="accomplish({{$maintenance->id}},'{{$maintenance->description}}')" data-toggle="modal" data-target="#con-accomplish-modal">
						<i class="far fa-thumbs-up"></i> Realizar
					</button>
					<button class="demo-delete-row btn btn-danger btn-xs btn-icon" onclick="postpone({{$maintenance->id}},'{{$maintenance->description}}')" data-toggle="modal" data-target="#con-postpone-modal">
						<i class="far fa-window-close"></i> Adiar
					</button>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $maintenances->withQueryString()->links() }}
</div>

@include('maintenanceCheck.modalAccomplish')
@include('maintenanceCheck.modalPostpones')

@endsection

