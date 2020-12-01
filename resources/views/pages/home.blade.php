@extends('layout')
@section('content')
<style>
    h2.title {
        color: #3f0ffe;
    }
</style>
<div class="features_items"><!--features_items-->
    <div class="fb-share-button" data-href="http://mobileshop.com/" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmobileshop.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
    <div class="fb-like" data-href="http://mobileshop.com/" data-width="" data-layout="standard" data-action="like" data-size="large" data-share="false"></div>
    <h2 class="title text-center">Sản phẩm Mobile-Shop</h2>
    @foreach ($listProduct as $products)
        <div class="col-sm-4">
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
                                <h2>${{ number_format($products->price) }}</h2>
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

{{-- <div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">   
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('frontend/images/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('frontend/images/recommend2.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('frontend/images/recommend3.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">  
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('frontend/images/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('frontend/images/recommend2.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('frontend/images/recommend3.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>          
    </div>
    <div class="fb-comments" data-href="http://mobileshop.com/" data-numposts="20" data-width=""></div>
    <div class="fb-page" 
    data-href="https://www.facebook.com/hau.phamvan.18/"
    data-width="380" 
    data-hide-cover="false"
    data-show-facepile="false"></div>
</div><!--/recommended_items--> --}}
{{$listProduct->links()}}
@endsection
