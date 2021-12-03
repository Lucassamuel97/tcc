@extends('layouts.app')

@section('content')

<div class="col-12 m-auto card-white">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Lançar número do hodômetro</h1>
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

	@if(session()->has('maintenance') && session('maintenance')[2] > 0)
        <div class="alert alert-danger">
			O maquinário <b>{{session('maintenance')[1]}}</b> possui <b>{{session('maintenance')[2]}}</b> manutenções pendentes. 
			<a href='{{url(session('maintenance')[0]."/maintenanceCheck/")}}' class="text-info">
				<i class="far fa-eye"></i> Vizualizar
			</a>
        </div>
    @endif

	<form action="">
		<div class="row mb-2">
			<div class="col-md-6 offset-md-6">
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
				<th scope="col">Hodômetro</th>
				<th scope="col">Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach($machines as $machine)
			<tr>
				<td>{{$machine->description}}</td>
				<td>{{$machine->identification_number}}</td>
				<td>{{$machine->hodometro}}h</td>
				<td class="text-center">
                    <button class="demo-delete-row btn btn-success btn-xs btn-icon" onclick="modal_hodometro({{$machine->id}},{{$machine->hodometro}},'{{$machine->description}}')" data-toggle="modal" data-target="#con-modal">
					    Selecionar
					</button>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$machines->links()}}
</div>
@endsection

<div id="con-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{url('updateHodometro')}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="machine_description"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hodometro" class="control-label">Hodômetro:</label>
                                <input type="number" name="hodometro" id="hodometro" class="form-control" onchange="confereHodometro()" min="" value="" required>
                                <input type="hidden" name="id" id="machine_id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light" >Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>


