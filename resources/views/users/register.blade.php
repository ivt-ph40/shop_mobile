@extends('layout')
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="signup-form"><!--sign up form-->
					<h2 id="tieu_de">ĐĂNG KÝ MỚI</h2>
					<form id="form_register" action="#" method="" enctype="multipart/form-data">
						@csrf
						<input type="text" name="name" placeholder="Họ và tên"/>
						<select name="gender" id="select1" class="form-control" required="required">
							<option value="">--Chọn giới tính--</option>
							<option value="1">Nam</option>
							<option value="0">Nữ</option>
						</select>
						<input type="email" name="email" placeholder="Nhập email"/>
						<input type="password" name="password" placeholder="Nhập mật khẩu"/>
						<input type="date" name="birthday" placeholder="Nhập ngày sinh"/>
						<input type="text" name="phone" placeholder="Nhập số điện thoại"/>
						<input type="text" name="street" placeholder="Nhập số nhà và tên đường"/>
						
							<select name="province_id" id="inputProvince_id" class="form-control" required="required">
								<option value="">--Chọn tỉnh/thành phố--</option>
								@foreach ($provinces as $province)
									<option value="{{ $province->id }}" data-id="{{ $province->id }}">{{$province->name}}</option>
								@endforeach
							</select>
							<select name="district_id" id="inputDistrict_id" class="form-control">
								{{-- <option value="">--Chưa chọn huyện/quận--</option> --}}
								
							</select>
							<select name="ward_id" id="inputWard_id" class="form-control">
								<option value="">--Chọn xã/phường--</option>
							</select>
						<input type="file" name="image" class="form-control"/>
						<button type="submit" class="btn btn-default">Đăng ký</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){

		var url = "{{url('/showDistrict')}}";
		$("select[name='province_id']").change(function(){
			var province_id = $(this).val();
			// alert(province_id);
			var token = $("input[name='_token']").val();
			$.ajax({
				url: url,
				method: 'POST',
				data: {
					province_id: province_id,
					_token: token
				},
				success: function(data) {
                $("select[name='district_id']").html('');
                $.each(data, function(key, value){
                    $("select[name='district_id']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
			});
		});
	});
	</script>
@endsection

