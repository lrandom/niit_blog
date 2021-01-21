<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Posts</h1>


				<a href="{{ route('posts.create') }}" class="btn btn-primary">New Post</a>
				<br>
				<br>
				<form action="">
					<div class="row">
						<div class="col-md-6">
							<input placeholder="Nhập nội dung cần tìm kiếm" type="text" name="keyword" value="{{ request()->input('keyword') }}" class="form-control">
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

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
</body>
</html>