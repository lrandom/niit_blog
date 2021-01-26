@extends('layout.master')
@section('css')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('partials.modal-login')
				<h1>Posts</h1>


				<a href="{{ route('posts.create') }}" class="btn btn-primary">New Post</a>


				<br>
				<br>
				<form action="">
					<div class="row">
						<div class="col-md-3">
							<input placeholder="Nhập nội dung cần tìm kiếm" type="text" name="keyword" value="{{ request()->input('keyword') }}" class="form-control">
						</div>
						<div class="col-md-3">
							<select name="category_id" id="" class="form-control">
								<option value="">Chọn category</option>
								@foreach($categories as $category)
									<option {{ request()->input('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3">
							<select name="tag_ids[]" id="" class="form-control select2" multiple="">
								@foreach($tags as $tag)
									<option {{ in_array($tag->id, request()->input('tag_ids', [])) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6">
							<button class="btn btn-primary" type="submit">Tìm kiếm</button>
						</div>
					</div>
				</form>

				<br>
				<table class="table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Title</th>
				      <th scope="col">Category</th>
				      <th scope="col">Tag</th>
				      <th scope="col">Created At</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($posts as $post)
					    <tr>
					      <th scope="row">{{ $post->id }}</th>
					      <td>{{ $post->title }}</td>
					      <td>
					      	@if ($post->category)
					      		{{ $post->category->name }}
					      	@endif
					      </td>
					      <td>
					      	@if ($post->tags()->count())
					      		<ul>
						      		@foreach($post->tags as $tag)
						      			<li>{{ $tag->name }}</li>
						      		@endforeach
					      		</ul>
					      	@endif
					      </td>
					      <td>{{ $post->created_at }}</td>
					      <td>
					      	<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
					      	<form class="frm-delete" action="{{ route('posts.destroy', $post->id) }}" method="POST">
					      		@method('delete')
					      		@csrf
					      		<button class="btn btn-danger btn-delete" type="button">Delete</button>
					      	</form>
					      </td>
					    </tr>
					@endforeach
				  </tbody>
				</table>

				{{ $posts->appends(request()->all()) }}
			</div>
		</div>


	</div>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('.select2').select2();
		});
	</script>
	<script>
		$(document).ready(function () {
			$('.btn-delete').click(function () {
				let isDelete = confirm('Bạn có muốn xóa bản ghi này hay không?');
				if (isDelete) {
					$(this).parents('form').submit();
				}
			});
		})
	</script>
{{-- @stop --}}
@endsection

@push('css')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('meta')
	<title>Danh sách bài viết</title>
@endpush

