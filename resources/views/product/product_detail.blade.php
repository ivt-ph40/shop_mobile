@extends('layout')
@section('content')
<style>
	#reviews form span input:last-child {
	    margin-left: 0%;
	    border: 1px solid #428bca;
	    border-radius: 10px;
	    color: #000000;
	}
	#reviews textarea {
	    background: #F0F0E9;
	    border: 1px solid #428bca;
	    border-radius: 10px;
	    color: #000000;
	    height: 100px;
	    margin-bottom: 25px;
	    margin-top: 15px;
	    outline: medium none;
	    padding-left: 10px;
	    padding-top: 15px;
	    resize: none;
	    width: 99.5%;
	}
	.add-to-cart {
		background:#ff6666;
		margin-bottom: 6px;
	}
	h2.title {
		color: #3f0ffe;
	}
</style>
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
							Thêm vào giỏ
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
				<li><a href="#details" data-toggle="tab">Thông tin chi tiết</a></li>
				<li><a href="#companyprofile" data-toggle="tab">Mô tả</a></li>
				<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane " id="details" >
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
			<div class="tab-pane fade fade active in" id="reviews" >
				<div class="col-sm-12">
					<ul>
						<li><a href=""><i class="fa fa-user"></i>haupham</a></li>
						<li><a href=""><i class="fa fa-clock-o"></i>16:09 PM</a></li>
						<li><a href=""><i class="fa fa-calendar-o"></i>19 SEP 1993</a></li>
					</ul>
					<form action="" method="post">
						@csrf
						<input type="hidden" name="com_product_id" id="inputProduct_id" class="com_product_id" value="{{$listProductDetail->id}}">
						<div id="show_comment"></div>
						{{-- <div class="comment">
							<div class="col-md-2">
								<img style="width: 60px" src="{{asset('frontend/images/icon_person.png')}}" class="img-responsive img-thumbnail" alt="">
							</div>

							<div class="col-md-10">
								<p style="color:blue">@haupham</p>
								<p>Video này mình hướng dẫn các bạn comment bằng ajax nhé .Nhớ subs kênh để theo dõi video hướng dẫn lập trình website nhé.</p>
							</div>
						</div><p></p> --}}
					</form>
					
					<p><b>Viết đánh giá</b></p>
					
					<form action="#" method="post">
						@csrf
						<div class="notify"></div>
						<span>
							<input type="text" placeholder="Nhập tên" class="comment_name" />
							{{-- <input type="email" placeholder="Email Address"/> --}}
						</span>
						<textarea name="comment_content" class="comment_content" placeholder="Nội dung bình luận"></textarea>

						<b>Đánh giá: </b> <img src="images/product-details/rating.png" alt="" />
						<button type="button" class="btn btn-default pull-right add_comment">
							Gửi
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
