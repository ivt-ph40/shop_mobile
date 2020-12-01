@extends('layout')
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="signup-form"><!--sign up form-->
					<h2 id="tieu_de">ĐĂNG KÝ MỚI</h2>
					<form id="form_register" action="{{route('register')}}" method="post" enctype="multipart/form-data">
						@csrf
						<input type="text" name="name" placeholder="Họ và tên"/>
						<p>{{ $errors->first('name') }}</p>
						<select name="gender" id="select1" class="form-control">
							<option value="">--Chọn giới tính--</option>
							<option value="1">Nam</option>
							<option value="0">Nữ</option>
						</select>
						<p>{{ $errors->first('gender') }}</p>
						<input type="email" name="email" placeholder="Nhập email"/>
						<p>{{ $errors->first('email') }}</p>
						<input type="password" name="password" placeholder="Nhập mật khẩu"/>
						<p>{{ $errors->first('password') }}</p>
						<input type="date" name="birthday" placeholder="Nhập ngày sinh"/>
						<p>{{ $errors->first('birthday') }}</p>
						<input type="text" name="phone" placeholder="Nhập số điện thoại"/>
						<p>{{ $errors->first('phone') }}</p>
						<input type="text" name="street" placeholder="Nhập số nhà và tên đường"/>
						<p>{{ $errors->first('street') }}</p>
						<select name="province_id" id="inputProvince_id" class="form-control">
							<option value="">--Chọn tỉnh/thành phố--</option>
							@foreach ($provinces as $province)
								<option value="{{ $province->id }}">{{$province->name}}</option>
							@endforeach
						</select>
						<p>{{ $errors->first('province_id') }}</p>
						<select name="district_id" id="inputDistrict_id" class="form-control">
							<option value="">--Chọn huyện/quận--</option>
						</select>
						<p>{{ $errors->first('district_id') }}</p>
						<select name="ward_id" id="inputWard_id" class="form-control">
							<option value="">--Chọn xã/phường--</option>
						</select>
						<p>{{ $errors->first('ward_id') }}</p>
						<input type="file" name="image" class="form-control"/>

						<button type="submit" class="btn btn-default">Đăng ký</button>
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
						console.log(data)
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

