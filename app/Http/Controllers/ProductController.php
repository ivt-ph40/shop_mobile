<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use DB;
use App\Brand;
use App\Image;
use App\Category;
use Session;
use App\Comment;
use Cart;
use File;
use App\Rating;
session_start();

class ProductController extends Controller
{
    public function index()
    {
        $list_product = Product::paginate(6);

        return view('product.list_product')->with('list_product', $list_product);
    }

    public function add_product()
    {
        $categories = Category::all();
        $list_brand = Brand::all();
        return view('product.add_product')->with('categories', $categories)->with('list_brand', $list_brand);
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        $get_image = $request->file('image');
        //them moi
        $path_product = 'upload/product/';
        $path_image = 'upload/images/';
        //them moi
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image-> move($path_product, $new_image);
            //them moi
            File::copy($path_product.$new_image, $path_image.$new_image);
            //them moi
            $data['image'] = $new_image;
            /*Product::create($data);
            return Redirect()->route('product.add_product')->with('message', 'Thêm product thành công!');*/
        } 
        /*else{
            $data['image'] = '';
            Product::create($data);
            return Redirect()->route('product.add_product')->with('message', 'Thêm product thành công!');
        }*/
        //them moi
        // $product_id = DB::table('products')->insertGetId($data);
        $products = Product::create($data);
        $data_img['name'] = $new_image;
        $data_img['path'] = $new_image;
        $data_img['product_id'] = $products->id;
        Image::create($data_img);
        return Redirect()->route('product.add_product')->with('message', 'Thêm product thành công!');
        //them moi
    }
    public function unactive($id){
        Product::where('id', $id)->update(['status' => 0]);
        return Redirect()->route('product.index')-> with('message', 'Ẩn danh mục Product thành công!');
    }
    public function active($id){
        Product::where('id', $id)->update(['status' => 1]);
        return Redirect()->route('product.index')-> with('message', 'Hiện danh mục Product thành công!');
    }
    public function delete($id){
        Product::where('id', $id)->delete();
        return Redirect()->route('product.index')-> with('message', 'Xóa thành công!');
    }
    
    public function edit($id)
    {
        $edit_product = Product::where('id', $id)->first();
        $list_category = Category::all();
        $list_brand = Brand::all();
        return view('product.edit_product')->with('edit_product', $edit_product)->with('list_category', $list_category)->with('list_brand', $list_brand);
    }

    public function update(Request $request, $id)
    {
        $data =array();
        $data['name']   = $request ->name;
        $data['category_id']   = $request ->category_id;
        $data['brand_id']   = $request ->brand_id;
        $data['description']   = $request ->description;
        $data['content']   = $request ->content;
        $data['quantity']   = $request ->quantity;
        $data['price']   = $request ->price;
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/product', $new_image);
            $data['image'] = $new_image;
            Product::where('id', $id)->update($data);
            return Redirect()->route('product.index')->with('message', 'Cập nhật thành công!');
        } else{
            $data['image'] = $request->old_product_image;
            Product::where('id', $id)->update($data);
            return Redirect()->route('product.index')->with('message', 'Cập nhật thành công!');
        }
    }
    public function detail(Request $request, $id)
    {
        $user_id = Session::get('userId');
        // dd($user_id);
        $listProductDetail = Product::with('brand', 'category')->where('id', $id)->first();
        // dd($listProductDetail->toArray());
        //lay images

        $images = Image::where('product_id', $id)->get();
        $category_id = $listProductDetail['category']['id'];

        $relate = DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->where('products.category_id', $category_id)->whereNotIn('products.id', [$id])->select('products.*')->get();
        // dd($relate->toArray());
        $rating_count = Rating::where('product_id', $listProductDetail->id)->get();
        $countRT = count($rating_count);
        // dd($countRT);
        $rating = Rating::where('product_id', $listProductDetail->id)->avg('rating');
        $rating = round($rating);
        // dd($rating);
        /*$quantity = $request->qty;
        $product_info = Product::where('id', $id)->first();
        $cart = Cart::content();
        $quantity_kho = $listProductDetail->quantity;
        $data['id'] = $id;
        $data['qty'] = $request->qty;
        if ($cart) {
            foreach ($cart as $key => $cat) {
                if ($cat->id == $data['id']) {
                    $total_qty = $cat->qty + $data['qty'];
                }
            }
        }*/

        return view('product.product_detail')->with('listProductDetail', $listProductDetail)->with('relate', $relate)->with('images', $images)->with('user_id', $user_id)->with('rating', $rating)->with('countRT', $countRT);
    }
    public function load_comment(Request $request)
    {
        $output = '';
        $product_id = $request->product_id;
        $comments = Comment::where('product_id', $product_id)->get();
        // dd($comments);
        foreach ($comments as $key => $comm) {
            $output .= '<div class="col-md-12 comment">
                            <div class="col-md-2">
                                <img style="width: 60px" src="'.url('frontend/images/icon_person.png').'" class="img-responsive img-thumbnail" alt="">
                            </div>
                            <div class="col-md-10">
                                <p style="color:blue">@'.$comm->fullname.'</p>
                                <p>'.$comm->content.'</p>

                                
                                
                            </div>

                        </div>';
        }
        echo $output;

    }
    public function reply_comment(Request $request)
    {
        $user_id = Session::get('userId');
        $user_name = Session::get('name');
        if ($user_id) {
            $data['user_id'] = $user_id;
            $data['product_id'] = $request->product_id;
            $data['fullname'] = $user_name;
            $data['content'] = $request->comment_content;
            $data['parent_id'] = $request->parent_comment_id;
            Comment::create($data);
        } else{
            $data['user_id'] = null;
            $data['product_id'] = $request->product_id;
            $data['fullname'] = $request->comment_name;
            $data['content'] = $request->comment_content;
            $data['parent_id'] = $request->parent_comment_id;
            Comment::create($data);
        }
    }

    public function add_comment(Request $request)
    {
        $user_id = Session::get('userId');
        $user_name = Session::get('name');
        if ($user_id) {
            $data['user_id'] = $user_id;
            $data['product_id'] = $request->product_id;
            $data['fullname'] = $user_name;
            $data['content'] = $request->comment_content;
            Comment::create($data);
        } else{
            $data['user_id'] = null;
            $data['product_id'] = $request->product_id;
            $data['fullname'] = $request->comment_name;
            $data['content'] = $request->comment_content;
            Comment::create($data);
        }
    }
    public function add_rating(Request $request)
    {
        $data['product_id'] = $request->product_id;
        $data['rating'] = $request->index;
        Rating::create($data);
        echo "done";

    }
}
