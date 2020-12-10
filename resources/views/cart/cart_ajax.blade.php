@extends('layout')
@section('content')
	<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			@if(session()->has('message'))
                <div class="alert alert-success">
                    {!! session()->get('message') !!}
                </div>
            @elseif(session()->has('error'))
                 <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
			<div class="table-responsive cart_info">
				{{-- @php
					echo "<pre/>";
					print_r(Session::get('cart'));
				@endphp --}}
				<form action="{{route('cart.update_cart_ajax')}}" method="post">
					@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="id">Id</td>
							<td class="name">Tên sản phẩm</td>
							<td class="price">Giá sản phẩm</td>
							<td class="quantity">Số lượng</td>
							<td class="image">Hình ảnh</td>
							<td class="total">Thành tiền</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
					@if (Session::get('cart'))
						
						@foreach (Session::get('cart') as $cart)
						<tr>
							<td class="cart_id">{{$cart['product_id']}}</td>
							<td class="cart_product_name">{{$cart['name']}}</td>
							
							<td class="cart_price">
								{{number_format($cart['price'])}}
							</td>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">

									<input class="cart_quantity_input" type="number" value="{{$cart['quantity']}}" name="cart_qty[{{$cart['session_id']}}]" autocomplete="off" size="2" min="", max="">
								</div>
							</td>
							<td class="cart_product">
								<a href=""><img src="{{ asset('upload/product/'.$cart['image']) }}" width="50" alt=""></a>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									@php
										$subtotal = $cart['quantity']*$cart['price'];
									@endphp
									{{number_format($subtotal, 0, '.',',')}}
									{{-- {{ $cart->total }} --}}
								</p>
							</td>
							<td>
								<a style="color:red" class="cart_quantity_delete" href="{{route('cart.delete_ajax', $cart['session_id'])}}" onclick="return confirm('Are you sure you want to Remove?');"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
						@endforeach
					@endif
						<td>
						@if (Session::get('cart') == null)
								{{''}}
						@else
						<button type="submit" class="btn btn-success updat_cart">Cập nhật</button>
						@endif
						</td>
						<tr class="">
							<th class="totalPayment_bar" colspan="5">Total Payment</th>
							<th class="totalPayment_money">
								{{number_format($totalPayment, 0)}}
							</th>
							<th><a href="{{route('cart.delete_all_ajax')}}" onclick="return confirm('Are you sure you want to Remove?');">
								@if (Session::get('cart') == null)
									{{''}}
								@else
								Xóa tất cả
								@endif
							</a></th>
						</tr>
					</tbody>
				</table>
				</form>
			</div>
	</section> <!--/#cart_items-->
	@if (Session::get('cart') == null)
			{{''}}
	@else
	<section id="do_action">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng<span>{{number_format($totalPayment, 0)}}</span></li>
							<li>Thuế<span>Miễn thuế</span></li>
							<li>Phí vận chuyển <span>Miễn phí</span></li>
							<li>Thành tiền <span>{{number_format($totalPayment, 0)}}</span></li>
						</ul>
							{{-- <a class="btn btn-default update" href="">Update</a> --}}
							<a class="btn btn-default check_out" href="
							{{ route('order.create') }}">Thanh toán</a>
					</div>
				</div>
			</div>
	</section><!--/#do_action-->
	@endif
	{{-- <script>
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
	</script> --}}
@endsection