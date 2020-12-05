@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm Mobile-Shop</h2>
    @foreach ($category_by_id->products as $product)
    <a href="{{ route('product.detail', $product->id) }}">
        <div class="col-sm-4">
            <div class="product-image-wrapper"> 
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('upload/product/'.$product->image)}}" height="230px" alt="" />
                            <h2>${{ $product->price }}</h2>
                            <p>{{ $product->name }}</p>
                            <p>Số lượng: {{ $product->quantity }}</p>
                            <a href="{{ route('product.detail', $product->id) }}" class="btn btn-default add-to-cart">Xem chi tiết</a>
                        </div>
                </div>
                {{-- <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </a>
    @endforeach 
</div><!--features_items-->
@endsection