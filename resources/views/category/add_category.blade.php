@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục category
            </header>
            <br>
            @if (Session::get('message'))
                <h4 align="center" style="color:red">{{ Session::get('message') }}</h4>
            @endif
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('category.store') }}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputName">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Tên danh mục" value="{{ old('name') }}">
                    </div>
                    <p style="color:blue">{{ $errors->first('name') }}</p>
                    <div class="form-group">
                        <label for="exampleInputDesc">Mô tả danh mục</label>
                        <textarea style="resize: none" rows="10" name="description"  class="form-control" id="exampleInputDesc" placeholder="Mô tả danh mục">{{ old('description') }}</textarea>
                    </div>
                    <p style="color:blue">{{ $errors->first('description') }}</p>
                    <div class="form-group">
                        <label for="">Hiển thị</label>
                        <select name="status" class="form-control m-bot15">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDate">Parent_id</label>
                        <select name="parent_id" id="inputParent_id" class="form-control">
                            <option value="{{null}}">Mặc định</option>
                            {{-- @foreach ($categories as $category)
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
                    <button type="submit" name="add_category" class="btn btn-info">Thêm</button>
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
