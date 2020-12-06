@extends('layout')
@section('content')
<style>
    #hot{
        width: 80px;
        height: 80px;
        margin-top: -500px;
        margin-left: 175px;
    }
    #sale{
        color: #999966;
        margin-right: 10px;
    }
    #tag_product{
        height: 430px;
    }
</style>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm Mobile-Shop</h2>
    @foreach ($category_by_id->products as $product)
    <a href="{{ route('product.detail', $product->id) }}">
        <div class="col-sm-4" id="tag_product">
            <div class="product-image-wrapper"> 
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('upload/product/'.$product->image)}}" height="230px" alt="" />
                            @if ($product->discount == 0)
                                <h2>
                                <span>${{ number_format($product->price) }}</span>
                                </h2>
                            @else
                                <h2>
                                <span id="sale"><del>${{ number_format($product->price) }}</del></span>
                                <span>${{ number_format($product->price*(100 - $product->discount)/100) }}</span>
                                </h2>
                                <img id="hot" src="{{asset('frontend/images/hot.gif')}}" alt="">
                            @endif
                            {{-- <h2>${{ $product->price }}</h2> --}}
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