@extends('layout')
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="{{asset('frontend/js/sweetalert.min.js')}}"></script>
	<div class="container">
		<div class="col-md-9">
			<form action="{{ route('order.store') }}" method="POST" role="form">
				@csrf
				<legend>Vui lòng điền đầy đủ thông tin để được mua hàng</legend>
			
				<div class="form-group">
					<label for="">Họ tên</label>
					<input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control" id="" placeholder="Nhập họ tên">
				</div>
				<p style="color:red">{{ $errors->first('fullname') }}</p>
				<div class="form-group">
					<label for="">Địa chỉ email</label>
					<input type="email" name="email" value="{{ old('email') }}" class="form-control" id="" placeholder="Nhập email">
				</div>
				<p style="color:red">{{ $errors->first('email') }}</p>
				<div class="form-group">
					<label for="">Số nhà</label>
					<input type="text" name="street" class="form-control" id="" placeholder="Nhập số nhà và tên đường">
				</div>
				<p style="color:red">{{ $errors->first('street') }}</p>
				<label for="">Tỉnh/Thành phố</label>
				<select name="province_id" id="inputProvince_id" class="form-control">
					<option value="">--Chọn tỉnh/thành phố--</option>
					@foreach ($provinces as $province)
						<option value="{{ $province->id }}">{{$province->name}}</option>
					@endforeach
				</select>
				<p style="color:red">{{ $errors->first('province_id') }}</p>
				<label for="">Huyện/Quận</label>
				<select name="district_id" id="inputDistrict_id" class="form-control">
					<option value="">--Chọn huyện/quận--</option>
				</select>
				<p style="color:red">{{ $errors->first('district_id') }}</p>
				<label for="">Xã/phường</label>
				<select name="ward_id" id="inputWard_id" class="form-control">
					<option value="">--Chọn xã/phường--</option>
				</select>
				<p style="color:red">{{ $errors->first('ward_id') }}</p>

				{{-- <div class="form-group">
					<select name="status_id" id="inputStatus_id" class="form-control">
						<option value="">--Chọn trạng thái--</option>
						@foreach ($listOrderStatus as $orderStatus)
							<option value="{{ $orderStatus->id }}">{{ $orderStatus->name }}</option>
						@endforeach
					</select>
				</div> --}}
				<p style="color:red">{{ $errors->first('status_id') }}</p>
				<div class="form-group">
					<label for="">Số điện thoại</label>
					<input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="" placeholder="Nhập số điện thoại">
				</div>
				<p style="color:red">{{ $errors->first('phone') }}</p>
			
				<button type="submit" class="btn btn-success order_cart" onclick="return confirm('Bạn có chắc muốn đặt hàng?');">Đặt hàng</button>
			</form>
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
@endsection
