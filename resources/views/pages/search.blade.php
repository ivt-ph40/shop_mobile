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
    h2.title {
        color: #054b02;
    }
</style>
<div class="features_items"><!--features_items-->
        <h2 class="title text-center">Kết quả được tìm thấy</h2>
    
    @foreach ($listSearchs as $products)
    <a href="{{ route('product.detail', $products->id) }}">
        <div class="col-sm-4" id="tag_product">
            <div class="product-image-wrapper"> 
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('upload/product/'.$products->image)}}" height="230px" alt="" />
                        @if ($products->discount == 0)
                            <h2>
                            <span>${{ number_format($products->price) }}</span>
                            </h2>
                        @else
                            <h2>
                            <span id="sale"><del>${{ number_format($products->price) }}</del></span>
                            <span>${{ number_format($products->price*(100 - $products->discount)/100) }}</span>
                            </h2>
                            <img id="hot" src="{{asset('frontend/images/hot.gif')}}" alt="">
                        @endif
                        <p>{{ $products->name }}</p>
                        <p>Số lượng: {{ $products->quantity }}</p>
                        <a href="{{ route('product.detail', $products->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endforeach 
</div><!--features_items-->
{{-- {{$listSearchs->links()}} --}}
@endsection