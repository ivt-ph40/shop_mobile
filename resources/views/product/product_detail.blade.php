@extends('layout')
@section('content')
{{-- @foreach ($listProductDetail as $productDetail) --}}
	<div class="product-details"><!--product-details-->
		<div class="col-sm-5">
			{{-- <div class="view-product">
				<img src="{{URL::to('upload/product/'.$listProductDetail->image)}}" alt="" />
			</div> --}}
			<ul id="imageGallery">
			@foreach ($images as $img)
			  <li data-thumb="{{asset('upload/images/'.$img->path)}}" data-src="{{asset('upload/images/'.$img->path)}}" />
			  		<img width="100%" src="{{asset('upload/images/'.$img->path)}}" />
			  </li>
			@endforeach  
			</ul>
			
		</div>
		<div class="col-sm-7">
			@if (session()->has('message'))
				<div class="alert alert-danger" role="alert">
				  <h4>{{session()->get('message')}}</h4>
				</div>
			@endif
			<div class="product-information"><!--/product-information-->
				<img src="images/product-details/new.jpg" class="newarrival" alt="" />
				<h2>{{$listProductDetail->name}}</h2>
				<p>ID: {{$listProductDetail->id}}</p>
				<img src="images/product-details/rating.png" alt="" />
				<form action="" method="post">
					@csrf
					<span>
						<span>${{number_format($listProductDetail->price)}}</span>
						<label>Quantity:</label>
						<input type="hidden" name="product_id_hidden" class="product_id" value="{{$listProductDetail->id}}">
						<input type="hidden" name="product_name" class="product_name" value="{{$listProductDetail->name}}">
						<input type="hidden" name="product_price" class="product_price" value="{{$listProductDetail->price}}">
						<input type="hidden" name="quantity_kho" class="quantity_kho" value="{{$listProductDetail->quantity}}">
						<input type="text" name="product_qty" class="product_qty" value="1" />
						<input type="hidden" name="product_image" class="product_image" value="{{$listProductDetail->image}}">
						<button type="button" name="add-to-cart" class="btn btn-fefault add-to-cart" data-id = "{{$listProductDetail->id}}">
							<i class="fa fa-shopping-cart"></i>
							Add to cart
						</button>
					</span>
				</form>
				<p><b>Số lượng trong kho :</b> {{$listProductDetail->quantity}}</p>
				<p><b>Category:</b> {{$listProductDetail->category['name']}}</p>
				{{-- @foreach ($listProductDetail->brand as $key => $value) --}}
				
				<p><b>Thương hiệu:</b> {{$listProductDetail->brand['name']}}</p>
				{{-- @endforeach --}}
				<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->
{{-- @endforeach --}}

	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li  class="active"><a href="#details" data-toggle="tab">Thông tin chi tiết</a></li>
				<li><a href="#companyprofile" data-toggle="tab">Mô tả</a></li>
				<li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="details" >
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<p>{{$listProductDetail->content}}</p>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="tab-pane fade" id="companyprofile" >
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/gallery1.jpg" alt="" />
								<p>{{$listProductDetail->description}}</p>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="tab-pane fade " id="reviews" >
				<div class="col-sm-12">
					<ul>
						<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
						<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
						<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
					<p><b>Write Your Review</b></p>
					
					<form action="#">
						<span>
							<input type="text" placeholder="Your Name"/>
							<input type="email" placeholder="Email Address"/>
						</span>
						<textarea name="" ></textarea>
						<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
						<button type="button" class="btn btn-default pull-right">
							Submit
						</button>
					</form>
				</div>
			</div>
			
		</div>
	</div><!--/category-tab-->

	<div class="recommended_items"><!--recommended_items-->
		<h2 class="title text-center">Sản phẩm liên quan</h2>
		
		<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">
					@foreach ($relate as $product)
						<a href="{{ route('product.detail', $product->id) }}">
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('upload/product/'.$product->image)}}" alt="" height="250px" />
											<h2>${{number_format($product->price)}}</h2>
											<p>{{$product->name}}</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</button>
										</div>
									</div>
								</div>
							</div>
						</a>
					@endforeach
				</div>
			</div>
			 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			  </a>
			  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			  </a>			
		</div>
	</div><!--/recommended_items-->
@endsection
