<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Category;
use Session;
session_start();
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect()->route('admin.show_dashboard');
        } else{
            return Redirect()->route('admin.index')->send();
        }
    }
    public function index()
    {
        $this->AuthLogin();
        // $list_product = DB::table('products')->get();
        $list_product = Product::all();

        return view('product.list_product')->with('list_product', $list_product);
    }

    public function add_product()
    {
        $this->AuthLogin();
        $categories = Category::all();
        $list_brand = Brand::all();
        return view('product.add_product')->with('categories', $categories)->with('list_brand', $list_brand);
    }

    public function store(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate([
            'name' => 'required|min:3',
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required',
            'content' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image-> move('upload/product', $new_image);
            $data['image'] = $new_image;
            // DB::table('products')->insert($data);
            Product::create($data);
            return Redirect()->route('product.add_product')->with('message', 'Thêm product thành công!');
        } else{
            $data['image'] = '';
            // DB::table('products')->insert($data);
            Product::create($data);
            return Redirect()->route('product.add_product')->with('message', 'Thêm product thành công!');
        }
        
    }
    public function unactive($id){
        $this->AuthLogin();
        // DB::table('products')->where('id', $id)->update(['status' => 0]);
        Product::where('id', $id)->update(['status' => 0]);
        return Redirect()->route('product.index')-> with('message', 'Ẩn danh mục Product thành công!');
    }
    public function active($id){
        $this->AuthLogin();
        // DB::table('products')->where('id', $id)->update(['status' => 1]);
        Product::where('id', $id)->update(['status' => 1]);
        return Redirect()->route('product.index')-> with('message', 'Hiện danh mục Product thành công!');
    }
    public function delete($id){
        $this->AuthLogin();
        // DB::table('products')->where('id', $id)->delete();
        Product::where('id', $id)->delete();
        return Redirect()->route('product.index')-> with('message', 'Xóa thành công!');
    }
    
    public function edit($id)
    {
        $this->AuthLogin();
        $edit_product = Product::where('id', $id)->first();
        $list_category = Category::all();
        $list_brand = Brand::all();
        return view('product.edit_product')->with('edit_product', $edit_product)->with('list_category', $list_category)->with('list_brand', $list_brand);
    }

    public function update(Request $request, $id)
    {
        $this->AuthLogin();
        $data =array();
        $data['name']   = $request ->name;
        $data['category_id']   = $request ->category_id;
        $data['brand_id']   = $request ->brand_id;
        $data['description']   = $request ->description;
        $data['content']   = $request ->content;
        $data['quantity']   = $request ->quantity;
        $data['price']   = $request ->price;
        // $data = $request->except('_token', '_method');
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/product', $new_image);
            $data['image'] = $new_image;
            // DB::table('products')->where('id', $id)->update($data);
            Product::where('id', $id)->update($data);
            return Redirect()->route('product.index')->with('message', 'Cập nhật thành công!');
        } else{
            $data['image'] = $request->old_product_image;
            // DB::table('products')->where('id', $id)->update($data);
            Product::where('id', $id)->update($data);
            return Redirect()->route('product.index')->with('message', 'Cập nhật thành công!');
        }
    }
    public function detail($id)
    {
        // $listCategory = DB::table('categories')->where('status', 1)->orderBy('id', 'asc')->get();
        $listCategory = Category::where('status', 1)->get();
        // $listBrand = DB::table('branches')->where('status', 1)->orderBy('id', 'asc')->get();
        $listBrand = Brand::where('status', 1)->get();
        // $listProductDetail = DB::table('products')->where('status', 1)->where('id', $id)->orderBy('price', 'asc')->first();
        $listProductDetail = Product::with('brand', 'category')->where('id', $id)->first();
        $category_id = $listProductDetail->category['id'];

        // dd($category_id);
        // dd($listProductDetail->toArray());
        // $relate = Category::with('products')->where('id', $category_id)->first();
        $relate = DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->where('categories.id', $category_id)->whereNotIn('products.id', [$id])->get();
        // dd($relate->toArray());
        return view('product.product_detail')->with('listCategory', $listCategory)->with('listBrand', $listBrand)->with('listProductDetail', $listProductDetail)->with('relate', $relate);
    }
}
