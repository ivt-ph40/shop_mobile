<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\Http\Requests\RegisterUserRequest;
use App\Province;
use App\District;
use App\Ward;
use DB;
use App\Order_status;
use App\OrderDetail;
use App\Http\Requests\CreateOrderRequest;
use Session;
use Cart;
use Mail;
use App\Mail\ShoppingMail;
session_start();

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderby('created_at', 'desc')->paginate(4);
        return view('orders.list_order', compact('orders'));

    }
    public function view_order($id)
    {
        $orders = Order::with('user', 'ward', 'district','province')->find($id);
        $order_status = Order_status::all();
        $orderDetail = DB::table('order_details')
                     ->join('orders', 'order_details.order_id', '=', 'orders.id')
                     ->join('products', 'order_details.product_id', '=', 'products.id')
                     ->where('order_details.order_id', $id)->select('order_details.id', 'order_details.quantity', 'order_details.price', 'order_details.order_id', 'products.name', 'order_details.product_id', 'products.quantity as product_qty')
                     ->get();
        $statusId = Order::where('id', $id)->pluck('status_id');
        // dd($orderDetail->toArray());
        
        return view('orders.edit_order', compact('orders', 'orderDetail', 'statusId', 'order_status'));
    }
    public function subtotal($content)
    {
        $subtotal = 0;
        foreach ($content as $key => $cart) {
            $subtotal += $cart->qty*$cart->price;
        }
        return $subtotal;
    }
    public function update_order_quantity(Request $request)
    {
        //update order
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->status_id = $data['order_status'];
        $order->save();

        if ($order->status_id == 2) {
            foreach ($data['order_product_id'] as $key1 => $product_id) {
                $product = Product::find($product_id);
                $product_qty = $product->quantity;
                $product_sold = $product->sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key1 == $key2) {
                        $product_remain = $product_qty - $qty;
                        $product->quantity = $product_remain;
                        $product->sold = $product_sold + $qty;
                        $product->save();
                    }
                }
            }
        } elseif ($order->status_id != 2 && $order->status_id != 3 && $order->status_id != 4) {
            foreach ($data['order_product_id'] as $key1 => $product_id) {
                $product = Product::find($product_id);
                $product_qty = $product->quantity;
                $product_sold = $product->sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key1 == $key2) {
                        $product_remain = $product_qty + $qty;
                        $product->quantity = $product_remain;
                        $product->sold = $product_sold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $content = Cart::content();
        // dd(count($content));
        $cart = Session::get('cart');
        if (count($cart) == 0) {
            return Redirect()->back()->with('message', 'Vui lòng mua hàng trước khi thanh toán!');
        // }
        } else{
            $listCategory = Category::where('status', 1)->get();
            $listBrand = Brand::where('status', 1)->get();
            $listOrderStatus = Order_status::all();
            $provinces = Province::all();
            return view('orders.order', compact('listCategory', 'listBrand', 'listOrderStatus', 'provinces'));
        }
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {
        // $content = Cart::content();
        $cart = Session::get('cart');
        // dd($cart);
        $data_order_d = array();
        $data_order =array();
        if (Session::get('userId') != null) {
            $data_order['user_id'] = Session::get('userId');
            $data_order['fullname'] = $request->fullname;
            $data_order['email'] = $request->email;
            $data_order['street'] = $request->street;
            $data_order['province_id'] = $request->province_id;
            $data_order['district_id'] = $request->district_id;
            $data_order['ward_id'] = $request->ward_id;
            $data_order['phone'] = $request->phone;
            $orders = Order::create($data_order);
            // dd($orders->toArray());
            Session::put('orderId', $orders->id); 
        } else{
            $data_order['user_id'] = null;
            $data_order['fullname'] = $request->fullname;
            $data_order['email'] = $request->email;
            $data_order['street'] = $request->street;
            $data_order['province_id'] = $request->province_id;
            $data_order['district_id'] = $request->district_id;
            $data_order['ward_id'] = $request->ward_id;
            $data_order['phone'] = $request->phone;
            $orders = Order::create($data_order);
            // dd($orders->toArray());
            Session::put('orderId', $orders->id);
        }
        //insert order_detail
        $orderdetails = [];
        foreach ($cart as $key => $value) {
            $data_order_d['order_id'] = Session::get('orderId');
            $data_order_d['product_id'] = $value['product_id'];
            $data_order_d['quantity'] = $value['quantity'];
            $data_order_d['price'] = $value['price'];
            $orderdetails[$key] = OrderDetail::create($data_order_d);
        }
        Mail::to($orders->email)->send(new ShoppingMail($orders, $orderdetails));
        // Cart::destroy();
        Session::forget('cart');
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        // return view('orders.end_order', compact('listCategory', 'listBrand'));
        return Redirect()->route('cart.giohang')->with('message', 'Bạn đã đặt hàng thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
