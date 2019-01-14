@extends('layouts.app')

@section('content')
	
	<h2>create Post</h2>

	@include('posts._form' , ['post' => $post])

@endsection