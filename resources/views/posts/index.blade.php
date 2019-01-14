@extends('layouts.app')

@section('content')

	@foreach($posts as $post)

		<div class="row">

			<div class="col-md-12">

				<h2>

					<a href=" {{Route('post_path' , ['post' => $post->id])}} "> {{ $post->title }}</a> 

					<small class="pull-right">


					@if($post->wasCreatedBy(Auth::user()))
 
						<a href=" {{ route('edit_post_path' , ['post' => $post->id]) }} " class="btn btn-info">Edit</a>
										
						<form action=" {{ route('delete_post_path', ['post' => $post->id]) }}  " method="POST">
							{{ csrf_field() }}

							{{ method_field('DELETE') }}
							
							<button type="submit" class="btn btn-danger">Delete</button>
							
				
						</form>

					@endif
					</small>


				</h2>

				<p>posted {{$post->created_at->diffForHumans()}} by <b> {{$post->user->name}} </b> </p> 

			</div>

		</div>

		<hr>

	@endforeach

	{{ $posts->render() }}

@endsection
