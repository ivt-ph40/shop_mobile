@extends('layout')
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<style>
	
	.btn.btn-primary {
		margin-top: 0px;
    	margin-left: 105px;
    	background: blue;
	}
	#img_daidien1{
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
					<h2 id="tieu_de">TRANG THÔNG TIN CÁ NHÂN</h2>
					<form id="form_register2" action="" method="post">
						<div class="col-md-12">
						<img id="img_daidien1" height="100px" src="{{URL::to('upload/users/'.$user->image)}}" alt="Hình đại diện" title="Hình đại diện">
						</div>
						<label for="">Họ tên</label>
						<input type="text" name="name" placeholder="Họ và tên" value="{{$user->name}}" disabled="" />
						<label for="">Giới tính</label>
						<select name="gender" id="select1" class="form-control" disabled="">
							<option value="">--Chọn giới tính--</option>
							@if ($user->gender == 1)
								<option selected="selected" value="1">Nam</option>
							<option value="0">Nữ</option>
							@else
							<option value="1">Nam</option>
							<option selected="selected" value="0">Nữ</option>
							@endif
						</select>
						<label for="">Địa chỉ email</label>
						<input type="email" name="email" placeholder="Nhập email" value="{{$user->email}}" disabled="" />
						<label for="">Ngày sinh</label>
						<input type="text" name="birthday" placeholder="Nhập ngày sinh" value="{{$user->birthday}}" disabled="" />
						<label for="">Số điện thoại</label>
						<input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{$user->phone}}" disabled="" />
						<label for="">Địa chỉ nhà</label>
						<input type="text" name="street" placeholder="Nhập số nhà và tên đường" value="{{$user->street}} - {{$user->ward->name}} - {{$user->district->name}} - {{$user->province->name}}" disabled="" />
						
						<button class="btn btn-success"><a id="thoat" href="{{route('home.index')}}">Thoát</a></button>

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

