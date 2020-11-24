@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa thương hiệu sản phẩm
            </header>
            <br>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('brand/update/'.$edit_brand->id) }}" method="POST">
                       
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputName">Tên thương hiệu</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Tên danh mục" value="{{ $edit_brand->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDesc">Mô tả danh mục</label>
                        <textarea style="resize: none" rows="10" name="description"  class="form-control" id="exampleInputDesc" placeholder="Mô tả danh mục" value="{{ $edit_brand->description }}">{{ $edit_brand->description }}</textarea>
                    </div>
                    <button type="submit" name="update_brand" class="btn btn-info">Update</button>
                </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection