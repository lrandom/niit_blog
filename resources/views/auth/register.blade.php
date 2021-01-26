@extends('layout.master')
@section('content')
	<div id="register">
		<div class="container">
			<div class="col-md-6">
				<form method="POST" action="{{ route('register.submit') }}">
					@csrf
				  <div class="form-group">
				    <label for="exampleInputEmail1">Name</label>
				    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="" placeholder="Quyet Tran">
				    @error('name')
				    	<p class="text-danger">{{ $message }}</p>
				    @enderror
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Address</label>
				    <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="" placeholder="Ha Noi">
				    @error('address')
				    	<p class="text-danger">{{ $message }}</p>
				    @enderror
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Bio</label>
				    <textarea class="form-control" name="bio" id="" cols="30" rows="10">{{ old('bio') }}</textarea>
				     @error('bio')
				    	<p class="text-danger">{{ $message }}</p>
				    @enderror
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
				     @error('email')
				    	<p class="text-danger">{{ $message }}</p>
				    @enderror
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Gender</label>
				    <div class="form-check">
					  <input class="form-check-input" type="radio" name="gender" {{ old('gender') == 1 ? 'checked' : '' }} value="1" id="exampleRadios1" value="1" checked>
					  <label class="form-check-label" for="exampleRadios1">
					    Male
					  </label>
					</div>
				    <div class="form-check">
					  <input class="form-check-input" type="radio" name="gender" {{ old('gender') == 2 ? 'checked' : '' }} value="2" id="exampleRadios1" value="2" checked>
					  <label class="form-check-label" for="exampleRadios1">
					    Female
					  </label>

					   @error('gender')
					    	<p class="text-danger">{{ $message }}</p>
					    @enderror
					</div>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputPassword1" placeholder="Password">
				     @error('password')
				    	<p class="text-danger">{{ $message }}</p>
				    @enderror
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Re-type Password</label>
				    <input type="password" name="repassword" value="{{ old('repassword') }}" class="form-control" id="exampleInputPassword1" placeholder="Password">
				     @error('repassword')
				    	<p class="text-danger">{{ $message }}</p>
				    @enderror
				  </div>

				  <button type="submit" class="btn btn-primary">Register</button>
				</form>
			</div>
		</div>
	</div>
@stop