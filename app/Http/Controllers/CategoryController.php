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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // $list_category = DB::table('categories')->get();
        $list_category = Category::paginate(8);
        return view('category.list_category', compact('list_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_category()
    {
        // $this->AuthLogin();
        // $categories = Category::where('parent_id', null)->get();
        $categories = Category::all();
        // $detal = $this->showCategories($categories);
        // $category = Category::with('subcategory')->get();
        // dd($categories->toArray());
        return view('category.add_category', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // $this->AuthLogin();
        $data = $request->all();
        Category::create($data);
        return Redirect()->route('category.add_category')->with('message', 'Thêm category thành công!');
    }
    public function unactive($id){
        // $this->AuthLogin();
        Category::where('id', $id)->update(['status' => 0]);
        return Redirect()->route('category.index')-> with('message', 'Ẩn danh mục Category thành công!');
    }
    public function active($id){
        // $this->AuthLogin();
        Category::where('id', $id)->update(['status' => 1]);
        return Redirect()->route('category.index')-> with('message', 'Hiện danh mục Category thành công!');
    }
    public function delete($id){
        // $this->AuthLogin();
        Category::where('id', $id)->delete();
        return Redirect()->route('category.index')-> with('thongbao', 'Xóa thành công!');
    }
    
    public function edit($id)
    {
        // $this->AuthLogin();
        // $categories = Category::where('parent_id', null)->get();
        $categories = Category::all();
        $edit_category = Category::where('id', $id)->first();
        $parentId = Category::where('id', $id)->get()->pluck('parent_id');
        // dd($categories);
        return view('category.edit_category', compact('categories', 'edit_category', 'parentId'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        // $this->AuthLogin();
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
        
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        $category_by_id = Category::with('products')->where('id', $id)->first();
        // dd($category_by_id->toArray());
        // $aa = Category::with('subcategory')->where('id', $id)->first();
        // dd($category_by_id->toArray());
        return view('pages.show_category')->with('listCategory', $listCategory)->with('listBrand', $listBrand)->with('category_by_id', $category_by_id);
    }
    
}
