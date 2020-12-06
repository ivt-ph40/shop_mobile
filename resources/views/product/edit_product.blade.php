@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa sản phẩm
            </header>
            <br>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('product/update/'.$edit_product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputName">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Tên sản phẩm" value="{{ $edit_product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="">Category_id</label>
                        <select name="category_id" class="form-control m-bot15">
                            @foreach ($list_category as $key => $category)
                            <option 
                                @if ($edit_product->category_id == $category->id)
                                    {{ 'selected' }}
                                @endif 
                                value="{{ $category->id }}">{{ $category->name }}
                            </option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Brand_id</label>
                        <select name="brand_id" class="form-control m-bot15">
                            @foreach ($list_brand as $key => $brand)
                            <option
                                @if ($edit_product->brand_id == $brand->id)
                                    {{ 'selected' }}
                                @endif
                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDesc">Mô tả sản phẩm</label>
                        <textarea style="resize: none" rows="5" name="description"  class="form-control" id="exampleInputDesc" placeholder="Mô tả sản phẩm" value="">{{ $edit_product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDesc">Nội dung sản phẩm</label>
                        <textarea style="resize: none" rows="5" name="content"  class="form-control" id="exampleInputDesc" placeholder="Nội dung sản phẩm" value="">{{ $edit_product->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputQuantity">Số lượng sản phẩm</label>
                        <input type="text" name="quantity" class="form-control" id="exampleInputName" placeholder="Số lượng sản phẩm" value="{{ $edit_product->quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDiscount">Giảm giá(%)</label>
                        <input type="float" name="discount" class="form-control" id="exampleInputDiscount" placeholder="Số lượng sản phẩm" value="{{ $edit_product->discount }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInput">Price</label>
                        <input type="text" name="price" class="form-control" id="exampleInputPrice" placeholder="Giá sản phẩm" value="{{ $edit_product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputImage">Image</label>
                        <input type="hidden" name="old_product_image" class="form-control" id="exampleInput" value="{{ $edit_product->image }}">
                        <input type="file" name="image" class="form-control" id="exampleInput">
                        <img src="{{ URL::to('upload/product/'.$edit_product->image) }}" alt="" width="70px" height="70px">
                    </div>
                    <button type="submit" name="update_product" class="btn btn-info">Update</button>
                </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection

