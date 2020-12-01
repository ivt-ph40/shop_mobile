@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <br>
            @if (Session::get('message'))
                <h4 align="center" style="color:red">{{ Session::get('message') }}</h4>
            @endif
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputName">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Tên sản phẩm">
                    </div>
                    <p style="color:blue">{{ $errors->first('name') }}</p>
                    <div class="form-group">
                        <label for="">Category_id</label>
                        <select name="category_id" class="form-control m-bot15">
                            <option value="{{ null }}">Mặc định</option>
                            {{-- @foreach ($categories as $key => $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @if ($category->subcategory)
                                @foreach ($category->subcategory as $cat)
                                    <option value="{{ $cat->id }}">--{{ $cat->name }}</option>
                                @endforeach
                            @endif
                            @endforeach --}}
                            @php
                                showCategories($categories);
                            @endphp
                        </select>
                    </div>
                    <p style="color:blue">{{ $errors->first('category_id') }}</p>
                    <div class="form-group">
                        <label for="">Brand_id</label>
                        <select name="brand_id" class="form-control m-bot15">
                            @foreach ($list_brand as $key => $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p style="color:blue">{{ $errors->first('brand_id') }}</p>
                    <div class="form-group">
                        <label for="exampleInputDesc">Mô tả sản phẩm</label>
                        <textarea style="resize: none" rows="5" name="description"  class="form-control" id="ckeditor1" placeholder="Mô tả sản phẩm"></textarea>
                    </div>
                    <p style="color:blue">{{ $errors->first('description') }}</p>
                    <div class="form-group">
                        <label for="exampleInputDesc">Nội dung sản phẩm</label>
                        <textarea style="resize: none" rows="5" name="content"  class="form-control" id="ckeditor2" placeholder="Nội dung sản phẩm"></textarea>
                    </div>
                    <p style="color:blue">{{ $errors->first('content') }}</p>
                    <div class="form-group">
                        <label for="exampleInputQuantity">Số lượng sản phẩm</label>
                        <input type="number" name="quantity" class="form-control" id="exampleInputQuantity" placeholder="Số lượng sản phẩm">
                    </div>
                    <p style="color:blue">{{ $errors->first('quantity') }}</p>
                    
                    <div class="form-group">
                        <label for="exampleInputImage">Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInput">
                    </div>
                    <p style="color:blue">{{ $errors->first('image') }}</p>
                    <div class="form-group">
                        <label for="exampleInput">Price</label>
                        <input type="text" name="price" class="form-control" id="exampleInputPrice" placeholder="Giá sản phẩm">
                    </div>
                    <p style="color:blue">{{ $errors->first('price') }}</p>
                    <div class="form-group">
                        <label for="">Hiển thị</label>
                        <select name="status" class="form-control m-bot15">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                    </div>
                    <p style="color:blue">{{ $errors->first('status') }}</p>
                    <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection

@php
function showCategories($categories, $parent_id = null, $char = '')
    {
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id)
            {
                echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
                 
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item->id, $char.'--');
            }
        }
    }
@endphp