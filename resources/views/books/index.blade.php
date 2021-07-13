@extends('layouts.app')

@section('content')

<div class="col-12 m-auto">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Livros</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{url('books/create')}}">
				<button class="btn btn-sm btn-outline-secondary">Novo Livro</button>
			</a>
		</div>
	</div>
	@csrf
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Titulo</th>
				<th scope="col">Autor</th>
				<th scope="col">Preço</th>
				<th scope="col">Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach($books as $book)
			@php
			$user=$book->find($book->id)->relUsers; 
			@endphp
			<tr>
				<th scope="row">{{$book->id}}</th>
				<td>{{$book->title}}</td>
				<td>{{$user->name}}</td>
				<td>{{$book->price}}</td>
				<td>
					<a href="{{url("books/$book->id")}}"><button class="btn btn-dark">Visualizar</button></a>
					<a href="{{url("books/$book->id/edit")}}"><button class="btn btn-primary">Editar</button></a>

					<a class="js-del" href="{{url("books/$book->id")}}">
						<button class="btn btn-danger">Deletar</button>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$books->links()}}
</div>
@endsection




