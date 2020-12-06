<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Brand;
use App\Product;
use Session;
session_start();

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(/*Request $request*/)
    {
        // $meta_des = "Hàng 100% chính hãng được phân phối bởi hệ thống bán lẻ kỹ thuật số FPTShop cùng với nhiều khuyến mãi hấp dẫn, bảo hành chính hãng. Mua trực tuyến giá rẻ hơn.";
        // $meta_keywords = "điện thoại di dộng, máy tính bảng, dien thoai chinh hang, may tinh xach tay, laptop chinh hang, phu kien laptop, điện thoại, dien thoai di dong,may tinh bang";
        // $meta_title = "Mobileshop.com | Điện thoại, Laptop, Tablet, Phụ kiện chính hãng giá tốt nhất";
        // $meta_canonical = $request->url();
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        if (isset($_GET['sort-by'])) {
            $sort_by = $_GET['sort-by'];
            if ($sort_by == 'tang-dan') {
                $listProduct = Product::where('status', 1)->orderby('price', 'ASC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listCategory', 'listBrand', 'listProduct', 'sort_by'));
            } elseif ($sort_by == 'giam-dan') {
                $listProduct = Product::where('status', 1)->orderby('price', 'DESC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listCategory', 'listBrand', 'listProduct', 'sort_by'));
            } elseif ($sort_by == 'san-pham-moi-nhat') {
                $listProduct = Product::where('status', 1)->orderby('created_at', 'DESC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listCategory', 'listBrand', 'listProduct', 'sort_by'));
                    
            }elseif ($sort_by == 'kytu-tu-az') {
                $listProduct = Product::where('status', 1)->orderby('name', 'ASC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listCategory', 'listBrand', 'listProduct', 'sort_by'));
            }elseif ($sort_by == 'kytu-tu-za') {
                $listProduct = Product::where('status', 1)->orderby('name', 'DESC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listCategory', 'listBrand', 'listProduct', 'sort_by'));
            }elseif ($sort_by == 'none') {
                $listProduct = Product::where('status', 1)->orderby('price', 'ASC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listCategory', 'listBrand', 'listProduct', 'sort_by'));
            }elseif ($sort_by == 'san-pham-giam-gia') {
                $listProduct = Product::where('status', 1)->orderby('discount', 'DESC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listCategory', 'listBrand', 'listProduct', 'sort_by'));
            }
        }else{
        $listProduct = Product::where('status', 1)->orderby('price', 'ASC')->paginate(6);
    return view('pages.home', compact('listCategory', 'listBrand', 'listProduct'/*, 'meta_des', 'meta_keywords', 'meta_title', 'meta_canonical'*/));
        }
    }
    public function search(Request $request)
    {
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        $value_search = $request->search;
        $listSearchs = Product::where('name', 'like', '%'.$value_search.'%')->orWhere('price', 'like', '%'.$value_search.'%')->get();
        return view('pages.search', compact('listBrand', 'listCategory', 'listSearchs', 'value_search'));
    }


    public function showContactForm()
    {
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        return view('users.contact-us', compact('listCategory', 'listBrand'));
    }
    public function sendMail(Request $request)
    {
        $toEmail = $request->email;
        $fromEmail = 'vanhauqld45@gmail.com';
        $data = ['content' => $request->content, 'username'=> 'HauPham'];
        \Mail::send('mails.contatct-us', $data, function($message) use ($toEmail, $fromEmail){
            $message->to($toEmail, 'Mr Hau');
            $message->from($fromEmail, 'Mr ngu');
            $message->subject('Contact Mail');
        });
        return 'success';
    }
}
