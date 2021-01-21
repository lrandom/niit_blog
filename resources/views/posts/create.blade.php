@extends('layout.master')

@section('content')

		<!-- Button trigger modal -->
	@include('partials.modal-login')

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>Create new Post</h1>
				<form action="/posts" method="POST">
					@csrf
				  	<div class="form-group">
					    <label for="">Title</label>
					    <input name="title" type="text" class="form-control" id="" placeholder="Enter title">
				 	</div>

				  	<div class="form-group">
					    <label for="">Description</label>
					    <input name="description" type="text" class="form-control" id="" placeholder="Enter Description">
				 	</div>

				  	<div class="form-group">
					    <label for="">Content</label>
					    <textarea name="content" id="" cols="30" rows="5" class="form-control"></textarea>
				 	</div>

				  	<div class="form-group">
					    <label for="">Category</label>
					    <select name="category_id" id="" class="form-control">
					    	<option value="">Choose category</option>
					    	@foreach($categories as $category)
					    		<option value="{{ $category->id }}">{{ $category->name }}</option>
					    	@endforeach
					    </select>
				 	</div>


				  	<div class="form-group">
					    <label for="">Tag</label>
					    <select multiple name="tags_id[]" id="" class="form-control select2">
					    	@foreach($tags as $tag)
					    		<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					    	@endforeach
					    </select>
				 	</div>

				  	<button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>


	</div>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('.select2').select2();
		});
	</script>
@stop

@push('css')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush
