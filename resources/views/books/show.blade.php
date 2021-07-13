@extends('layouts.app')

@section('content')
<div class="col-10 m-auto">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 mt-4 border-bottom">
		<h1 class="h4">Livro > Visualizar</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{url('books')}}">
			<button class="btn btn-sm btn-outline-secondary">Voltar</button>
			</a>
		</div>
	</div>

	@php
	$user = $book->find($book->id)->relUsers
	@endphp

	Titulo: {{$book->title}}<br>
	Paginas: {{$book->pages}}<br>
	Preço: R$ {{$book->price}}<br>
	User: R$ {{$user->name}}<br>
	Email: R$ {{$user->email}}<br>
</div>
@endsection