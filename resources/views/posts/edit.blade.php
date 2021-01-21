<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>Update Post</h1>
				<form action="{{ route('posts.update', $post->id) }}" method="POST">
					@csrf
					@method('put')
				  	<div class="form-group">
					    <label for="">Title</label>
					    <input name="title" type="text" class="form-control" id="" placeholder="Enter title" value="{{ $post->title }}">
				 	</div>

				  	<div class="form-group">
					    <label for="">Description</label>
					    <input name="description" type="text" class="form-control" id="" placeholder="Enter Description" value="{{ $post->description }}">
				 	</div>

				  	<div class="form-group">
					    <label for="">Content</label>
					    <textarea name="content" id="" cols="30" rows="5" class="form-control">{{ $post->content }}</textarea>
				 	</div>

				  	<div class="form-group">
					    <label for="">Category</label>
					    <select name="category_id" id="" class="form-control">
					    	<option value="">Choose category</option>
					    	@foreach($categories as $category)
					    		<option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
					    	@endforeach
					    </select>
				 	</div>

				 	@php
				 		$tagsIds = $post->tags->pluck('id')->toArray();
				 	@endphp
				  	<div class="form-group">
					    <label for="">Tag</label>
					    <select multiple name="tags_id[]" id="" class="form-control select2">
					    	@foreach($tags as $tag)
					    		<option {{ in_array($tag->id, $tagsIds) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
					    	@endforeach
					    </select>
				 	</div>

				  	<button type="submit" class="btn btn-primary">Update</button>
				</form>
			</div>
		</div>


	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('.select2').select2();
		});
	</script>
</body>
</html>