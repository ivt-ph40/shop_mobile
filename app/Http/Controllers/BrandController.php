<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use DB;
use App\Category;
use Session;
session_start();

class BrandController extends Controller
{
    // public function AuthLogin(){
    //     $admin_id = Session::get('admin_id');
    //     if ($admin_id) {
    //         return Redirect()->route('admin.show_dashboard');
    //     } else{
    //         return Redirect()->route('users.showLoginForm')->send();
    //     }
    // }
    public function index()
    {
        // $this->AuthLogin();
        // $list_brand = DB::table('brands')->get();
        $list_brand = Brand::paginate(8);

        return view('brand.list_brand')->with('list_brand', $list_brand);
    }

    public function add_brand()
    {
        // $this->AuthLogin();
        return view('brand.add_brand');
    }

    public function store(Request $request)
    {
        // $this->AuthLogin();
        // $data =array();
        $data = $request->validate([
            'name' => 'required|unique:brands|min:3',
            'description' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        // DB::table('brands')->insert($data);
        Brand::create($data);
        return Redirect()->route('brand.add_brand')->with('message', 'Thêm brand thành công!');
    }
    public function unactive($id){
        // $this->AuthLogin();
        // DB::table('brands')->where('id', $id)->update(['status' => 0]);
        Brand::where('id', $id)->update(['status' => 0]);
        return Redirect()->route('brand.index')-> with('message', 'Ẩn danh mục Category thành công!');
    }
    public function active($id){
        // $this->AuthLogin();
        // DB::table('brands')->where('id', $id)->update(['status' => 1]);
        Brand::where('id', $id)->update(['status' => 1]);
        return Redirect()->route('brand.index')-> with('message', 'Hiện danh mục Category thành công!');
    }
    public function delete($id){
        // $this->AuthLogin();
        // DB::table('brands')->where('id', $id)->delete();
        Brand::where('id', $id)->delete();
        return Redirect()->route('brand.index')-> with('thongbao', 'Xóa thành công!');
    }
    
    public function edit($id)
    {
        // $this->AuthLogin();
        // $edit_brand = DB::table('brands')->where('id', $id)->first();
        $edit_brand = Brand::where('id', $id)->first();

        return view('brand.edit_brand')->with('edit_brand', $edit_brand);
    }

    public function update(Request $request, $id)
    {
        // $this->AuthLogin();
        $data =array();
        $data['name']   = $request ->name;
        $data['description']   = $request ->description;
        
        // DB::table('brands')->where('id', $id)->update($data);
        Brand::where('id', $id)->update($data);
        return Redirect()->route('brand.index')->with('thongbao1', 'Cập nhật thành công!');
    }
    public function showProductByBrand($id){
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        $brand_by_id = Brand::with('products')->where('id', $id)->first();
        // $DB = $brand_by_id[0];
        // dd($brand_by_id->toArray());
        return view('pages.show_brand')->with('listCategory', $listCategory)->with('listBrand', $listBrand)->with('brand_by_id', $brand_by_id);
    }
}
