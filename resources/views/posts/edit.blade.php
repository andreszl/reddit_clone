@extends('layouts.app')

@section('content')

	<h2>editing Post</h2>

	@include('posts._form' , ['post' => $post])	

@endsection