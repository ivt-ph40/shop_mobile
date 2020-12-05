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
						<label for="">Họ và tên</label><span style="color:red">(* Bắt buộc nhập)</span>
						<input type="text" name="name" placeholder="Họ và tên"/>
						<p style="color:red">{{ $errors->first('name') }}</p>
						<label for="">Giới tính</label><span style="color:red">(*)</span>
						<div class="col-md-12">
						<select name="gender" id="select1" class="form-control">
							<option value="">--Chọn giới tính--</option>
							<option value="1">Nam</option>
							<option value="0">Nữ</option>
						</select>
						</div>
						<p style="color:red">{{ $errors->first('gender') }}</p>
						<label for="">Địa chỉ email</label><span style="color:red">(*)</span>
						<input type="email" name="email" placeholder="Nhập email"/>
						<p style="color:red">{{ $errors->first('email') }}</p>
						<label for="">Mật khẩu</label><span style="color:red">(*)</span>
						<input type="password" name="password" placeholder="Nhập mật khẩu"/>
						<p style="color:red">{{ $errors->first('password') }}</p>
						<label for="">Ngày sinh</label><span style="color:red">(*)</span>
						<input type="date" name="birthday" placeholder="Nhập ngày sinh"/>
						<p style="color:red">{{ $errors->first('birthday') }}</p>
						<label for="">Số điện thoại</label><span style="color:red">(*)</span>
						<input type="text" name="phone" placeholder="Nhập số điện thoại"/>
						<p style="color:red">{{ $errors->first('phone') }}</p>
						<label for="">Địa chỉ nhà</label><span style="color:red">(*)</span>
						<input type="text" name="street" placeholder="Nhập số nhà và tên đường"/>
						<p style="color:red">{{ $errors->first('street') }}</p>
						<div class="col-md-12">
							<div class="col-md-4">
								<label for="">Tỉnh/thành phố</label><span style="color:red">(*)</span>
								<select name="province_id" id="inputProvince_id" class="form-control">
									<option value="">--Chọn tỉnh/thành phố--</option>
									@foreach ($provinces as $province)
										<option value="{{ $province->id }}">{{$province->name}}</option>
									@endforeach
								</select>
								<p style="color:red">{{ $errors->first('province_id') }}</p>
							</div>
							<div class="col-md-4">
								<label for="">Huyện/quận</label><span style="color:red">(*)</span>
								<select name="district_id" id="inputDistrict_id" class="form-control">
									<option value="">--Chọn huyện/quận--</option>
								</select>
								<p style="color:red">{{ $errors->first('district_id') }}</p>
							</div>
							<div class="col-md-4">
								<label for="">Xã/phường</label><span style="color:red">(*)</span>
								<select name="ward_id" id="inputWard_id" class="form-control">
									<option value="">--Chọn xã/phường--</option>
								</select>
								<p style="color:red">{{ $errors->first('ward_id') }}</p>
							</div>
						</div>
						<label for="">Hình ảnh</label><span style="color:red">(*)</span>
						<input type="file" name="image" class="form-control"/>

						<button type="submit" class="btn btn-default">Đăng ký</button>

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

