@extends('layout')
@section('content')
	<div class="col-md-12">
		<form action="{{route('users.change_password', Session::get('id'))}}" method="POST" role="form">
			@csrf
			<legend>Thay đổi mật khẩu</legend>
			@if (session()->has('message'))
				<p style="color: red">{{session()->get('message')}}</p>
			@endif
			<div class="form-group">
				<label for="">Nhập mật khẩu cũ</label><span style="color:red">(*)</span>
				<input type="password" name="old_password" class="form-control" id="" placeholder="Nhập mật khẩu cũ" value="{{old('old_password')}}">
			</div>
			<p style="color:red">{{$errors->first('old_password')}}</p>
			<div class="form-group">
				<label for="">Nhập mật khẩu mới</label><span style="color:red">(*)</span>
				<input type="password" name="new_password" class="form-control" id="" placeholder="Nhập mật khẩu mới" value="{{old('new_password')}}">
			</div>
			<p style="color:red">{{$errors->first('new_password')}}</p>
			<div class="form-group">
				<label for="">Nhập lại mật khẩu mới tạo</label><span style="color:red">(*)</span>
				<input type="password" name="password_confirmation" class="form-control" id="" placeholder="Nhập mật lại mật khẩu mới" value="{{old('password_confirmation')}}">
			</div>
			<p style="color:red">{{$errors->first('password_confirmation')}}</p>
		
			<button type="submit" class="btn btn-primary">Thay đổi</button>
		</form>
	</div>
@endsection

