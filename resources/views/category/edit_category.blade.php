@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa danh mục category
            </header>
            <br>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('category/update/'.$edit_category->id) }}" method="POST">
                       
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputName">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Tên danh mục" value="{{ $edit_category->name }}">
                    </div>
                    @if ($errors->has('name'))
                        <p style="color:blue">{{ $errors->first('name') }}</p>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputSlug">Tên danh mục</label>
                        <input type="text" name="slug" class="form-control" id="exampleInputSlug" placeholder="Tên slug" value="{{ $edit_category->slug }}">
                    </div>
                    @if ($errors->has('slug'))
                        <p style="color:blue">{{ $errors->first('name') }}</p>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputDesc">Mô tả danh mục</label>
                        <textarea style="resize: none" rows="10" name="description"  class="form-control" id="exampleInputDesc" placeholder="Mô tả danh mục" value="{{ $edit_category->description }}">{{ $edit_category->description }}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <p style="color:blue">{{ $errors->first('description') }}</p>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputDate">Parent_id</label>
                        <select name="parent_id" id="inputParent_id" class="form-control">
                            <option value="{{null}}">Mặc định</option>
                            @foreach ($categories as $category)
                                <option
                                @if ($parentId->contains($category->id))
                                    {{'selected'}}
                                @endif
                                 value="{{ $category->id }}">{{ $category->name }}</option>
                                 @if ($category->subcategory)
                                    @foreach ($category->subcategory as $cat)
                                        <option
                                        @if ($parentId->contains($cat->id))
                                            {{'selected'}}
                                        @endif
                                         value="{{ $cat->id }}">--{{ $cat->name }}</option>
                                    @endforeach
                                 @endif
                            @endforeach
                            {{-- @php
                                showCategories($categories, null, '--', $parentId);
                            @endphp --}}
                        </select>
                    </div>
                    <button type="submit" name="update_category" class="btn btn-info">Update</button>
                </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection

{{-- @php
function showCategories($categories, $parent_id = null, $char = '--', $select = 0)
    {
        foreach ($categories as $key => $item)
        {
            $id = $item->id;
            $name = $item->name;
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id)
            {
                if ($select !=0 && $id == $select){
                    echo "<option value='$id' selected='selected'>$char $name</option>";
                } else{
                    echo "<option value='$id'>$char $name</option>";
                }
                 
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $id, $char.'--');
            }
        }
    }
@endphp
 --}}
