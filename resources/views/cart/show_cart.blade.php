@extends('layout')
@section('content')
	<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			@if (session()->has('message'))
				<div class="alert alert-danger" role="alert">
				  <h4 align="center" style="color:red">{{ session()->get('message') }}</h4>
				</div>
			@endif
			<div class="table-responsive cart_info">
				@php
					$content = Cart::content();
				@endphp
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="id">id</td>
							<td class="name">Product Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="image">Image</td>
							<td class="total">Total</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($content as $cart)
						<tr>
							<td class="cart_id">{{ $cart->id }}</td>
							<td class="cart_product_name">{{ $cart->name }}</td>
							
							<td class="cart_price">
								<p>${{ number_format($cart->price) }}</p>
							</td>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">

									<input class="cart_quantity_input" type="number" value="{{$cart->qty}}" autocomplete="off" size="2" onchange="updateCart(this.value, '{{$cart->rowId}}')" min="0", max="10">
								</div>
							</td>
							<td class="cart_product">
								<a href=""><img src="{{ URL::to('/upload/product/'.$cart->options->image) }}" width="50" alt=""></a>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									@php
										$subtotal = $cart->qty*$cart->price;
									@endphp
									{{number_format($subtotal, 0, '.',',')}}
									{{-- {{ $cart->total }} --}}
								</p>
							</td>
							<td>
								<a class="cart_quantity_delete" href="{{ route('cart.deleteByRowId', $cart->rowId) }}"><button class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?');"><i class="fas fa-trash-alt"></i></button></a>
							</td>
						</tr>
						
						@endforeach
						<tr class="">
							<th class="totalPayment_bar" colspan="5">Total Payment</th>
							<th class="totalPayment_money">
								{{number_format($totalPayment, 0)}}
							</th>
							<th><a href="{{route('cart.deleteAll')}}"><button type="submit" class="btn btn-danger delete_all" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa tất cả</button></a></th>
						</tr>
						
					</tbody>
				</table>
			</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng<span>${{ number_format($totalPayment, 2) }}</span></li>
							<li>Thuế<span>${{ Cart::Tax() }}</span></li>
							<li>Phí vận chuyển <span>Miễn phí</span></li>
							<li>Thành tiền <span>${{ Cart::total() }}</span></li>
						</ul>
							{{-- <a class="btn btn-default update" href="">Update</a> --}}
							<a class="btn btn-default check_out" href="
							{{ route('order.create') }}">Thanh toán</a>
					</div>
				</div>
			</div>
	</section><!--/#do_action-->
	<script>
		function updateCart(qty, rowId)
		{

			$.get(
				'{{asset('cart/update')}}',
				{qty:qty, rowId:rowId}, 
				function(){
					location.reload();
				}
				);
		}
	</script>
@endsection