
@if( $post->exists )

	<form action="{{route('update_post_path', ['post' => $post->id])}}" method="post">

	{{ method_field('PUT')}}
	
@else

	<form action="{{route('store_post_path')}} " method="POST">

@endif

{{ csrf_field() }}

		
	<!-- Tittle Field -->

	<div class="form-group">

		<label for="title">Titulo:</label>
	
		<input type="text" name="title" class="form-control" value=" {{ $post->title or old('title')}} ">
	
	</div>

	<!-- Description Input -->

	<div class="form-group">

		<label for="title">Descripcion:</label>
		
		<textarea name="description" id="" cols="5"  class="form-control"> {{ $post->description or old('description')}} </textarea>
	
	</div>

	<!-- Url Field -->

	<div class="form-group">

		<label for="title">Url:</label>
	
		<input type="text" name="url" class="form-control" value=" {{ $post->url or old('url') }} ">
	
	</div>
	
	<!-- Button -->
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary">save Post</button>		
	</div>
</form>