@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm các quyền
            </header>
            <br>
            @if (Session::get('message'))
                <h4 align="center" style="color:red">{{ Session::get('message') }}</h4>
            @endif
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('permission.store') }}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputName">Tên quyền</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Tên vai trò" value="{{ old('name') }}">
                    </div>
                    <p style="color:blue">{{ $errors->first('name') }}</p>
                    <div class="form-group">
                        <label for="exampleInputDesc">Mô tả quyền</label>
                        <input type="text" name="display_name" class="form-control" id="exampleDisplay_name" placeholder="Mô tả vai trò" value="{{ old('display_name') }}">
                    </div>
                    <p style="color:blue">{{ $errors->first('display_name') }}</p>
                    
                    <button type="submit" name="add_permission" class="btn btn-info">Thêm</button>
                </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection