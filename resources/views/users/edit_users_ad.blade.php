@extends('admin_layout')
@section('admin_content')
<style>
    .add_user{
        margin-bottom: 10px;
    }
    form{
        margin-left: 150px;
    }
    .address_str{
        margin-bottom: 10px;
    }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="signup-form"><!--sign up form-->
                    
                    <form id="form_register" action="{{route('users.update', $users->id)}}" method="post" enctype="multipart/form-data">
                        <legend align="center">Sửa người dùng</legend>
                        @if (session()->has('message'))
                            <p style="color:red" align="center">{{session()->get('message')}}</p>
                        @endif
                        @csrf
                        <label for="">Họ tên</label><span style="color: red"> (* Bắt buộc nhập)</span>
                        <input type="text" name="name" placeholder="Họ và tên" class="form-control add_user" value="{{$users->name}}" />
                        <p style="color: red">{{ $errors->first('name') }}</p>
                        <label for="">Giới tính</label><span style="color: red"> (*)</span>
                        <select name="gender" id="select1" class="form-control add_user">
                            <option value="">--Chọn giới tính--</option>
                            @if ($users->gender == 1)
                                <option selected="selected" value="1">Nam</option>
                                <option value="0">Nữ</option>
                            @else
                                <option value="1">Nam</option>
                                <option selected="selected" value="0">Nữ</option>
                            @endif
                        </select>
                        <p>{{ $errors->first('gender') }}</p>
                        <label for="">Email</label><span style="color: red"> (*)</span>
                        <input type="email" name="email" placeholder="Nhập email" class="form-control add_user" value="{{$users->email}}"/>
                        <p style="color: red">{{ $errors->first('email') }}</p>
                        <label for="">Mật khẩu</label><span style="color: red"> (*)</span>
                        <input type="password" name="password" placeholder="Nhập mật khẩu" class="form-control add_user" value="{{$users->password}}"/>
                        <p style="color: red">{{ $errors->first('password') }}</p>
                        <label for="">Ngày sinh</label><span style="color: red"> (*)</span>
                        <input type="date" name="birthday" placeholder="Nhập ngày sinh" class="form-control add_user" value="{{$users->birthday}}"/>
                        <p style="color: red">{{ $errors->first('birthday') }}</p>
                        <label for="">Số điện thoại</label><span style="color: red"> (*)</span>
                        <input type="text" name="phone" placeholder="Nhập số điện thoại" class="form-control add_user" value="{{$users->phone}}"/>
                        <p style="color: red">{{ $errors->first('phone') }}</p>
                        <label for="">Số nhà</label><span style="color: red"> (*)</span>
                        <input type="text" name="street" placeholder="Nhập số nhà và tên đường" class="form-control add_user" value="{{$users->street}}"/>
                        <p style="color: red">{{ $errors->first('street') }}</p>
                        <div class="col-md-12 address_str">
                            <div class="col-md-4">
                                <label for="">Tỉnh/thành phố</label><span style="color: red"> (*)</span>
                                <select name="province_id" id="inputProvince_id" class="address">
                                    <option value="">--Chọn tỉnh/thành phố--</option>
                                    @foreach ($provinces as $province)
                                        <option
                                        @if ($users->province_id == $province->id)
                                            {{'selected'}}
                                        @endif
                                         value="{{ $province->id }}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                                <p style="color: red">{{ $errors->first('province_id') }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Quận/huyện</label><span style="color: red"> (*)</span>
                                <select name="district_id" id="inputDistrict_id" class="address">
                                    <option value="">--Chọn huyện/quận--</option>
                                    @foreach ($districts as $district)
                                        <option
                                        @if ($users->district_id == $district->id)
                                            {{'selected'}}
                                        @endif
                                         value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                </select>
                                <p style="color: red">{{ $errors->first('district_id') }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Xã/phường</label><span style="color: red"> (*)</span>
                                <select name="ward_id" id="inputWard_id" class="address">
                                    <option value="">--Chọn xã/phường--</option>
                                    @foreach ($wards as $ward)
                                        <option
                                        @if ($users->ward_id == $ward->id)
                                            {{'selected'}}
                                        @endif
                                         value="{{$ward->id}}">{{$ward->name}}</option>
                                    @endforeach
                                </select>
                                <p style="color: red">{{ $errors->first('ward_id') }}</p>
                            </div>
                        </div>
                        <label for="">Hình ảnh</label>
                        <input type="hidden" name="old_image" class="form-control add_user" value="{{$users->image}}"/>
                        <input type="file" name="image" class="form-control add_user" value="{{old('image')}}"/>
                        <div class="col-md-12">
                        <img src="{{ URL::to('upload/users/'.$users->image) }}" alt="" width="40px" height="50px">
                        </div>
                        <label for="">Chọn quyền</label>
                        <select name="role_ids[]" id="inputRole_ids[]" class="form-control" multiple="multiple">
                            @foreach ($roles as $role)
                                <option
                                @if ($listRoleUser->contains($role->id))
                                    {{'selected'}}
                                @endif
                                 value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary">Thêm</button>

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
@endsection