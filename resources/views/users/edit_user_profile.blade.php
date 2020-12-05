@extends('layout')
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<style>
	
	.btn.btn-primary {
		margin-top: 0px;
    	margin-left: 105px;
    	background: blue;
	}
	#img_daidien{
		margin-bottom: 10px;
		/* border: 1px solid black;
		border-radius: 50%; */
	}
	#form_register1 {
		width: 75%;
	    margin: 0 auto;
	    border: 2px solid red;
	    border-radius: 10px;
	    box-shadow: 2px 4px 5px;
	    padding: 20px;
	    height: 1000px;
	}
</style>
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="signup-form"><!--sign up form-->
					<h2 id="tieu_de">CẬP NHẬT TRANG CÁ NHÂN</h2>
					@if (session()->has('message'))
						<h5 style="color:red" align="center">{{session()->get('message')}}</h5>
					@endif
					<form id="form_register1" action="{{route('users.update_profile', $user->id)}}" method="post" enctype="multipart/form-data">
						@csrf
						<img id="img_daidien" height="100px" src="{{URL::to('upload/users/'.$user->image)}}">
						<input type="hidden" name="old_image" class="form-control" value="{{$user->image}}" />
						<input type="file" name="image" class="form-control"/>
						<label for="">Họ tên</label>
						<input type="text" name="name" placeholder="Họ và tên" value="{{$user->name}}" />
						<p style="color: red">{{ $errors->first('name') }}</p>
						<label for="">Giới tính</label>
						<select name="gender" id="select1" class="form-control">
							<option value="">--Chọn giới tính--</option>
							@if ($user->gender == 1)
								<option selected="selected" value="1">Nam</option>
							<option value="0">Nữ</option>
							@else
							<option value="1">Nam</option>
							<option selected="selected" value="0">Nữ</option>
							@endif
						</select>
						<p style="color: red">{{ $errors->first('gender') }}</p>
						<label for="">Địa chỉ email</label>
						<input type="email" name="email" placeholder="Nhập email" value="{{$user->email}}" />
						<p style="color: red">{{ $errors->first('email') }}</p>
						{{-- <label for="">Mật khẩu</label>
						<input type="password" name="password" placeholder="Nhập mật khẩu" value="{{$user->password}}" /> --}}
						{{-- <p>{{ $errors->first('password') }}</p> --}}
						<label for="">Ngày sinh</label>
						<input type="date" name="birthday" placeholder="Nhập ngày sinh" value="{{$user->birthday}}" />
						<p style="color: red">{{ $errors->first('birthday') }}</p>
						<label for="">Số điện thoại</label>
						<input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{$user->phone}}" />
						<p style="color: red">{{ $errors->first('phone') }}</p>
						<label for="">Địa chỉ nhà</label>
						<input type="text" name="street" placeholder="Nhập số nhà và tên đường" value="{{$user->street}}" />
						<p style="color: red">{{ $errors->first('street') }}</p>
						<label for="">Tỉnh/thành phố</label>
						<select name="province_id" id="inputProvince_id" class="form-control">
							<option value="">--Chọn tỉnh/thành phố--</option>
							@foreach ($provinces as $province)
								<option
								@if ($user->province_id == $province->id)
									{{'selected'}}
								@endif
								 value="{{ $province->id }}">{{$province->name}}</option>
							@endforeach
						</select>
						<p style="color: red">{{ $errors->first('province_id') }}</p>
						<label for="">Quận/huyện</label>
						<select name="district_id" id="inputDistrict_id" class="form-control">
							<option value="">--Chọn huyện/quận--</option>
							@foreach ($districts as $district)
								<option
								@if ($user->district_id == $district->id)
									{{'selected'}}
								@endif
								 value="{{$district->id}}">{{$district->name}}</option>
							@endforeach
						</select>
						<p style="color: red">{{ $errors->first('district_id') }}</p>
						<label for="">Xã/phường</label>
						<select name="ward_id" id="inputWard_id" class="form-control">
							<option value="">--Chọn xã/phường--</option>
							@foreach ($wards as $ward)
								<option
								@if ($user->ward_id == $ward->id)
									{{'selected'}}
								@endif
								 value="{{$ward->id}}">{{$ward->name}}</option>
							@endforeach
						</select>
						<p style="color: red">{{ $errors->first('ward_id') }}</p>
						<div class="col-md-12">
							<div class="col-md-6">
								<button type="submit" class="btn btn-primary">Cập nhật</button>
							</div>
							<div class="col-md-6">
								<button class="btn btn-success"><a id="thoat" href="{{route('home.index')}}">Thoát</a></button>
							</div>
						</div>
						{{-- <div class="g-recaptcha" data-sitekey="6LegCu4ZAAAAAFJJ3Cc2Bkm1xk-7gFk9wCfzVE-9"></div>
						<br/>
						@if($errors->has('g-recaptcha-response'))
						<span class="invalid-feedback" style="display:block">
							<strong>{{$errors->first('g-recaptcha-response')}}</strong>
						</span>
						@endif --}}

					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function(){
		// $.ajaxSetup({
		//   headers: {
		//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		//   }
		// });
		var url = "{{url('/showDistrict')}}";
		$("select[name='province_id']").change(function(){
			var province_id = $(this).val();
			// alert(province_id);
			var token = $("input[name='_token']").val();
			$.ajax({
				url: url,
				dataType: 'json',
				type: 'post',
				data: {
					province_id: province_id,
					_token: token
				},
				success: function(data) {
					// console.log(data)
	                $("select[name='district_id']").html('');
	                $.each(data, function(key, value){
	                    $("select[name='district_id']").append(
	                        "<option value=" + value.id + ">" + value.name + "</option>"
	                    );
                });
            }
			});

			$("#inputDistrict_id").change(function(){
				var district_id = $('#inputDistrict_id').val();
				var province_id = $('#inputProvince_id').val();
				// alert (district_id);
				var token = $("input[name='_token']").val();
				// alert(token)
				$.ajax({
					url : '/showWard',
					dataType : 'json',
					type : 'post',
					data : {
						district_id : district_id,
						province_id : province_id,
						_token: token
					},
					success: function(data) {
						// console.log(data)
						$('#inputWard_id').html('');
						$.each(data, function(key, value){
							$('#inputWard_id').append(
								"<option value=" + value.id + ">" + value.name + "</option>"
								);
						});

					}
				});
			});
		});
	});
	</script>
	{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
@endsection

