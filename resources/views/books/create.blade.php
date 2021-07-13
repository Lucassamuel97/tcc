@extends('layouts.app')

@section('content')
<div class="col-10 m-auto">

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Livro > @if(isset($book))Editar @else Cadastrar @endif</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{url('books')}}">
				<button class="btn btn-sm btn-outline-secondary">Voltar</button>
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


	@if(isset($book))
	<form name="formEdit" id="formEdit" method="POST" action="{{url("books/$book->id")}}">
		@method('PUT')	
		@else
		<form name="formCad" id="formCad" method="POST" action="{{url('books')}}">
			@endif
			@csrf

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="descricao" class="col-form-label">Titulo <code class="highlighter-rouge">*</code></label>
					<input class="form-control" type="text" name="title" id="title" placeholder="Titulo:" required value="{{$book->title ?? ''}}">
				</div>
				<div class="form-group col-md-6">
					<label for="descricao" class="col-form-label">Titulo <code class="highlighter-rouge">*</code></label>

					<select name="id_user" id="id_user" class="form-control" required>
						<option value="{{$book->relUsers->id ?? ''}}">{{$book->relUsers->name ?? ''}}</option>
						@foreach($users as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="descricao" class="col-form-label">Paginas: <code class="highlighter-rouge">*</code></label>
					<input class="form-control" type="text" name="pages" id="pages" placeholder="Paginas:" required value="{{$book->pages ?? ''}}">
				</div>
				<div class="form-group col-md-6">
					<label for="descricao" class="col-form-label">Preço: <code class="highlighter-rouge">*</code></label>
					<input class="form-control" type="text" name="price" id="price" placeholder="Preço:" required value="{{$book->price ?? ''}}">
				</div>
			</div>
			<input class="btn btn-primary" type="submit" name="Cadastrar">
		</form>
	</div>
	@endsection