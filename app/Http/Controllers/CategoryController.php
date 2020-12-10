<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Brand;
use Session;
session_start();
class CategoryController extends Controller
{
    public function index()
    {
        $list_category = Category::paginate(8);
        return view('category.list_category', compact('list_category'));
    }
    public function add_category()
    {
        $categories = Category::all();
        return view('category.add_category', compact('categories'));
    }
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->all();
        Category::create($data);
        return Redirect()->route('category.add_category')->with('message', 'Thêm category thành công!');
    }
    public function unactive($id){
        Category::where('id', $id)->update(['status' => 0]);
        return Redirect()->route('category.index')-> with('message', 'Ẩn danh mục Category thành công!');
    }
    public function active($id){
        Category::where('id', $id)->update(['status' => 1]);
        return Redirect()->route('category.index')-> with('message', 'Hiện danh mục Category thành công!');
    }
    public function delete($id){
        Category::where('id', $id)->delete();
        return Redirect()->route('category.index')-> with('thongbao', 'Xóa thành công!');
    }
    
    public function edit($id)
    {
        $categories = Category::all();
        $edit_category = Category::where('id', $id)->first();
        $parentId = Category::where('id', $id)->get()->pluck('parent_id');
        // dd($categories);
        return view('category.edit_category', compact('categories', 'edit_category', 'parentId'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $data =array();
        $data['name']   = $request ->name;
        $data['slug']   = $request ->slug;
        $data['description']   = $request ->description;
        $data['parent_id']   = $request ->parent_id;
        Category::where('id', $id)->update($data);
        return Redirect()->route('category.index')->with('thongbao1', 'Cập nhật thành công!');
    }

    public function showProductByCategory($id)
    {
        $category_by_id = Category::with('products')->where('id', $id)->first();
        // dd($category_by_id->toArray());
        return view('pages.show_category')->with('category_by_id', $category_by_id);
    }
    
}
