@extends('layout')
@section('content')
	<div class="col-md-12">
		<div class="col-md-6">
			@if (Session::get('id'))
				<h3><i class="fas fa-user-edit"></i>&ensp;<a href="{{route('users.manage_profile', Session::get('id'))}}">Cập nhật thông tin cá nhân</a></h3>
			@endif
		</div>
		<div class="col-md-6">
			@if (Session::get('id'))
				<h3><i class="fas fa-key"></i>&ensp;<a href="{{route('users.form_change_password', Session::get('id'))}}">Thay đổi mật khẩu</a></h3>
			@endif
		</div>
	</div>
@endsection

