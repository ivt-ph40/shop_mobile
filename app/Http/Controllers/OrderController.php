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
use App\User;
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
        //update order status
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->status_id = $data['order_status'];
        $order->save();

        if ($order->status_id == 2) {
            foreach ($data['order_product_id'] as $key1 => $product_id) {
                $product = Product::find($product_id);
                $product_qty_processing = $product->qty_processing;
                $product_sold = $product->sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key1 == $key2) {
                        $product_processing_remain = $product_qty_processing - $qty;
                        $product->qty_processing = $product_processing_remain;
                        $product->sold = $product_sold + $qty;
                        $product->save();
                    }
                }
            }
        }
        elseif ($order->status_id != 2 && $order->status_id != 3 && $order->status_id != 1) {
        // elseif ($order->status_id == 4) {
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
    public function create()
    {
        // $content = Cart::content();
        // dd(count($content));
        $cart = Session::get('cart');
        $userId = Session::get('userId');
        $users = User::where('id', $userId)->first();
        // $provinceId = $users->province_id;
        $districts = District::all();
        $wards = Ward::all();
        // dd($provinceId);
        if ($cart == null) {
            return Redirect()->back()->with('message', 'Vui lòng mua hàng trước khi thanh toán!');
        // }
        } else{
            $listOrderStatus = Order_status::all();
            $provinces = Province::all();
            return view('orders.order', compact('listOrderStatus', 'provinces', 'users', 'districts', 'wards', 'cart'));
        }
        

    }
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
        //update quantity in table products
        $data = array();
        $data['order_product_id'] = $request->order_product_id_pr;
        $data['quantity'] = $request->product_qty_pr;
        // dd($data['quantity']);
        foreach ($data['order_product_id'] as $key1 => $product_id) {
            $product = Product::find($product_id);
            $product_qty = $product->quantity;
            $product_qty_processing = $product->qty_processing;
            foreach ($data['quantity'] as $key2 => $qty) {
                if ($key1 == $key2) {
                    $product_remain = $product_qty - $qty;
                    $product->quantity = $product_remain;
                    $product->qty_processing = $product_qty_processing + $qty;
                    $product->save();
                }
            }
        }

        Mail::to($orders->email)->send(new ShoppingMail($orders, $orderdetails));
        // Cart::destroy();
        Session::forget('cart');
        return Redirect()->route('cart.giohang')->with('message', 'Bạn đã đặt hàng thành công!');
    }
    public function show(Order $order)
    {
        //
    }
    public function edit(Order $order)
    {
        //
    }
    public function update(Request $request, Order $order)
    {
        //
    }
    public function destroy(Order $order)
    {
        //
    }
}
