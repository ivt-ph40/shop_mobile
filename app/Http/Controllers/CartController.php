<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use Session;
use Cart;
session_start();

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $cart = Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // dd($cart);
        
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        $content = Cart::content();
        $totalPayment = $this->subtotal($content);
        return view('cart.show_cart', compact('listCategory', 'listBrand', 'totalPayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request->product_id_hidden;
        $quantity = $request->qty;
        $product_info = Product::where('id', $product_id)->first();
        // dd($data);
        
        // $qty = $cart->qty;
        // dd($cart->toarray());
        $quantity_kho = $request->quantity_kho;
        $data['id'] = $product_info->id;
        // dd($quantity_kho);
        $data['qty'] = $quantity;
        $data['name'] = $product_info->name;
        $data['price'] = $product_info->price;
        $data['weight'] = $quantity_kho;
        $data['options']['image'] = $product_info->image;
        $cart = Cart::content();
        // dd($cart->toarray());
        // if (count($cart)) {
        //     foreach ($cart as $key => $cat) {
        //         if ($cat->id == $data['id']) {
        //             $total_qty = $data['qty']+$cat->qty;
        //             if ($total_qty > $quantity_kho || $quantity < 0 || $total_qty >10 || !is_numeric($quantity)) {
        //                 return Redirect()->back()->with('message', 'Số lượng hàng còn trong kho không đủ!');
        //             }
        //             else{
        //                 $carts = Cart::add($data);
        //                 return Redirect()->route('cart.index');
        //             }  
        //         }elseif ($quantity > $quantity_kho || $quantity < 0 || $quantity >10 || !is_numeric($quantity)) {
        //             $carts = Cart::add($data);
        //                 return Redirect()->route('cart.index');
        //         }
                
        //     }
        // }else{
            if ($quantity < 0 || $quantity >10 || !is_numeric($quantity) || $quantity > $quantity_kho) {
                return Redirect()->back()->with('message', 'Số lượng hàng còn trong kho không đủ!');
            } else{
                $carts = Cart::add($data);
                // dd($carts);
                return Redirect()->route('cart.index');
                // Cart::destroy();
            }
        // }
    }
    public function subtotal($cart)
    {
        $subtotal = 0;
        foreach ($cart as $key => $cat) {
            $subtotal += $cat['quantity']*$cat['price'];
        }
        return $subtotal;
    }
    public function update(Request $request)
    {

        $rowId = $request->rowId;
        $quantity = $request->qty;
        
        Cart::update($rowId, $quantity);
        // return Redirect()->route('cart.index');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteByRowId($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect()->route('cart.index')->with('message', 'Xóa thành công!');
    }
    public function deleteAll()
    {
        $cart = Session::get('cart');
        if ($cart) {
            Session::forget('cart');
            return Redirect()->back()->with('message', 'Xóa giỏ hàng thành công!');
        } else{
            return Redirect()->back();
        }
    }
    public function add_by_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26),5);
        // print_r($session_id);
        $cart = Session::get('cart');
        // dd($cart);
        if ($cart == true) {
            $count = 0;
            foreach ($cart as $key => $value) {

                if ($value['product_id'] == $data['product_id']) {
                    // $value['quantity'] ++;
                    // dd($value['quantity']);
                    $count++;
                }
            }
            if ($count == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['product_id'],
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'quantity' => $data['quantity'],
                    'quantity_kho' => $data['quantity_kho'],
                    'image' => $data['image'],
                );
                Session::put('cart', $cart);
            }
        } else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['product_id'],
                'name' => $data['name'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'quantity_kho' => $data['quantity_kho'],
                'image' => $data['image'],
            );
            Session::put('cart', $cart);
        }
        Session::save();
    }
    public function giohang()
    {
        $cart = Session::get('cart');
        // dd($cart);
        if ($cart) {
            $totalPayment = $this->subtotal($cart);
            // dd($totalPayment);
        }else{
            $totalPayment = 0;
        }
        // dd($totalPayment);
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        // $totalPayment = $this->subtotal($content);
        return view('cart.cart_ajax', compact('listCategory', 'listBrand', 'totalPayment'));
    }
    public function delete_ajax($session_id)
    {
        $carts = Session::get('cart');
        if ($carts) {
            foreach ($carts as $key => $cart) {
                if ($cart['session_id'] == $session_id) {
                    unset($carts[$key]);
                }
            }
            Session::put('cart', $carts);
            return Redirect()->back()->with('message', 'Xóa sản phẩm thành công!');
        }
    }
    public function update_cart_ajax(Request $request)
    {
        $message = '';
        $quantitys = $request->cart_qty;
        // dd($quantitys);
        $cart = Session::get('cart');
        // dd($cart);
        if ($cart) {
            foreach ($quantitys as $key1 => $qty) {
                $i =0;
                foreach ($cart as $key2 => $val) {
                    $i++;
                    if ($val['session_id'] == $key1 && $qty < $cart[$key2]['quantity_kho'] && $qty <= 10) 
                    {
                        if ($qty <= 0) {
                            unset($cart[$key2]);
                            $message = '<p style="color:green">Cập nhật số lượng: '.$cart[$key2]['name'].' thành công!</p>';
                        }else{
                            $cart[$key2]['quantity'] = $qty;
                            $message = '<p style="color:green">Cập nhật số lượng: '.$cart[$key2]['name'].' thành công!</p>';
                        }
                    } elseif (($val['session_id'] == $key1 && $qty > $cart[$key2]['quantity_kho']) || ($val['session_id'] == $key1 && $qty > 10)) {
                        $message = '<p style="color:red">Cập nhật số lượng: '.$cart[$key2]['name'].' thất bại do lớn hơn số lượng trong kho hoặc lớn hơn số lượng cho phép là 10 hoặc lớn hơn số lượng hiện có!</p>';
                    }
                    // elseif ($val['session_id'] == $key1 && $qty > $cart[$key2]['quantity_kho']) {
                    //     $message = '<p style="color:red">Cập nhật số lượng: '.$cart[$key2]['name'].' thất bại do vượt quá số lượng trong kho!</p>';
                    // }
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', $message);
        } else{
            return Redirect()->back()->with('message', 'Không có hàng trong giỏ!');
        }
    }
    public function delete_all_ajax()
    {
        $cart = Session::get('cart');
        if ($cart) {
            Session::forget('cart');
            return Redirect()->back()->with('message', 'Xóa tất cả thành công!');
        }
        return Redirect()->back()->with('message', 'Không có hàng trong giỏ!');
    }
}
