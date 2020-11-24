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
        $data['id'] = $product_info->id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->name;
        $data['price'] = $product_info->price;
        $data['weight'] = $product_info->price;
        $data['options']['image'] = $product_info->image;
        // $data['total'] = $data['qty']*$data['price'];
        $carts = Cart::add($data);
        
        // dd($totalPayment);
        return Redirect()->route('cart.index');
    }
    public function subtotal($content)
    {
        $subtotal = 0;
        foreach ($content as $key => $cart) {
            $subtotal += $cart->qty*$cart->price;
        }
        return $subtotal;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
