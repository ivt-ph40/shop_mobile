@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục brand
            </header>
            <br>
            @if (Session::get('message'))
                <h4 align="center" style="color:red">{{ Session::get('message') }}</h4>
            @endif
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('brand.store') }}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputName">Tên thương hiệu sản phẩm</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Tên thương hiệu sản phẩm" value="{{ old('name') }}">
                    </div>
                    <p style="color:blue">{{ $errors->first('name') }}</p>
                    <div class="form-group">
                        <label for="exampleInputDesc">Mô tả thương hiệu</label>
                        <textarea style="resize: none" rows="10" name="description"  class="form-control" id="exampleInputDesc" placeholder="Mô tả thương hiệu">{{ old('description') }}</textarea>
                    </div>
                    <p style="color:blue">{{ $errors->first('description') }}</p>
                    <div class="form-group">
                        <label for="">Hiển thị</label>
                        <select name="status" class="form-control m-bot15">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="add_brand" class="btn btn-info">Thêm</button>
                </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection