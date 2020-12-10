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
    public function index()
    {
        $list_brand = Brand::paginate(8);

        return view('brand.list_brand')->with('list_brand', $list_brand);
    }

    public function add_brand()
    {
        return view('brand.add_brand');
    }

    public function store(Request $request)
    {
        $data =array();
        $data = $request->validate([
            'name' => 'required|unique:brands|min:3',
            'description' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        Brand::create($data);
        return Redirect()->route('brand.add_brand')->with('message', 'Thêm brand thành công!');
    }
    public function unactive($id){
        Brand::where('id', $id)->update(['status' => 0]);
        return Redirect()->route('brand.index')-> with('message', 'Ẩn danh mục Category thành công!');
    }
    public function active($id){
        Brand::where('id', $id)->update(['status' => 1]);
        return Redirect()->route('brand.index')-> with('message', 'Hiện danh mục Category thành công!');
    }
    public function delete($id){
        Brand::where('id', $id)->delete();
        return Redirect()->route('brand.index')-> with('thongbao', 'Xóa thành công!');
    }
    
    public function edit($id)
    {
        $edit_brand = Brand::where('id', $id)->first();

        return view('brand.edit_brand')->with('edit_brand', $edit_brand);
    }

    public function update(Request $request, $id)
    {
        $data =array();
        $data['name']   = $request ->name;
        $data['description']   = $request ->description;
        Brand::where('id', $id)->update($data);
        return Redirect()->route('brand.index')->with('thongbao1', 'Cập nhật thành công!');
    }
    public function showProductByBrand($id){
        $brand_by_id = Brand::with('products')->where('id', $id)->first();
        // dd($brand_by_id->toArray());
        return view('pages.show_brand')->with('brand_by_id', $brand_by_id);
    }
}
