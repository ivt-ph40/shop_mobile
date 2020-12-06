@extends('layout')
@section('content')
<style>
    h2.title {
        color: #3f0ffe;
    }
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
    <div class="fb-share-button" data-href="http://mobileshop.com/" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmobileshop.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
    <div class="fb-like" data-href="http://mobileshop.com/" data-width="" data-layout="standard" data-action="like" data-size="large" data-share="false"></div>
    <h2 class="title text-center">Sản phẩm Mobile-Shop</h2>
    <div class="col-md-12" style="margin-bottom: 20px">
        <div class="col-md-4">
        <label for="">Sắp xếp theo</label>
            <form action="" method="post">
                @csrf
                <select name="sort" id="sort" class="form-control">
                    <option
                    @if (isset($sort_by) && $sort_by == 'none')
                        {{'selected'}}
                    @endif
                    value="{{Request::url()}}?sort-by=none">--Lọc--</option>
                    <option
                    @if (isset($sort_by) && $sort_by == 'san-pham-giam-gia')
                        {{'selected'}}
                    @endif
                    value="{{Request::url()}}?sort-by=san-pham-giam-gia">Sản phẩm giảm giá</option>
                    <option
                    @if (isset($sort_by) && $sort_by == 'san-pham-moi-nhat')
                        {{'selected'}}
                    @endif
                    value="{{Request::url()}}?sort-by=san-pham-moi-nhat">Sản phẩm mới nhất</option>
                    <option
                    @if (isset($sort_by) && $sort_by == 'tang-dan')
                         {{'selected'}}
                     @endif
                     value="{{Request::url()}}?sort-by=tang-dan">Giá tăng dần</option>
                    <option
                    @if (isset($sort_by) && $sort_by == 'giam-dan')
                         {{'selected'}}
                     @endif
                     value="{{Request::url()}}?sort-by=giam-dan">Giá giảm dần</option>
                    <option
                    @if (isset($sort_by) && $sort_by == 'kytu-tu-az')
                         {{'selected'}}
                     @endif
                    value="{{Request::url()}}?sort-by=kytu-tu-az">Tên từ A đến Z</option>
                    <option
                    @if (isset($sort_by) && $sort_by == 'kytu-tu-za')
                         {{'selected'}}
                     @endif
                    value="{{Request::url()}}?sort-by=kytu-tu-za">Tên từ Z đến A</option>
            </select>
            </form>
        </div>
    </div>
    @foreach ($listProduct as $products)
        <div class="col-sm-4" id="tag_product">

            <div class="product-image-wrapper"> 
                <a href="{{ URL::to('product_detail/'.$products->id) }}">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form action="" method="post">
                            @csrf
                            {{-- <input type="hidden" name="" id="input" class="cart_product_id_{{$products->id}}" value="{{$products->id}}">
                            <input type="hidden" name="" id="input" class="cart_product_name_{{$products->id}}" value="{{$products->name}}">
                            <input type="hidden" name="" id="input" class="cart_product_price_{{$products->id}}" value="{{$products->price}}">
                            <input type="hidden" name="" id="input" class="cart_product_quantity_{{$products->id}}" value="{{$products->quantity}}">
                            <input type="hidden" name="" id="input" class="cart_product_image_{{$products->id}}" value="{{$products->image}}"> --}}

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
                            
                            <button type="button" data-id="{{$products->id}}" class="btn btn-primary add-to-cart" name="add-to-cart">Xem chi tiết</button>
                        </form>
                    </div>
                </div>
                </a>
            </div>
        </div>
    @endforeach 
</div><!--features_items-->
{{$listProduct->links()}}
@endsection
