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

        $product = Product::where('status', 1);
        if (isset($_GET['sort-by'])) {
            $sort_by = $_GET['sort-by'];
            if ($sort_by == 'tang-dan') {
                $listProduct = $product->orderby('price', 'ASC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listProduct', 'sort_by'));
            } elseif ($sort_by == 'giam-dan') {
                $listProduct = $product->orderby('price', 'DESC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listProduct', 'sort_by'));
            } elseif ($sort_by == 'san-pham-moi-nhat') {
                $listProduct = $product->orderby('created_at', 'DESC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listProduct', 'sort_by'));
                    
            }elseif ($sort_by == 'kytu-tu-az') {
                $listProduct = $product->orderby('name', 'ASC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listProduct', 'sort_by'));
            }elseif ($sort_by == 'kytu-tu-za') {
                $listProduct = $product->orderby('name', 'DESC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listProduct', 'sort_by'));
            }elseif ($sort_by == 'none') {
                $listProduct = $product->orderby('price', 'ASC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listProduct', 'sort_by'));
            }elseif ($sort_by == 'san-pham-giam-gia') {
                $listProduct = $product->orderby('discount', 'DESC')->paginate(6)->appends(request()->query());
                return view('pages.home', compact('listProduct', 'sort_by'));
            }
        }else{
        $listProduct = $product->orderby('price', 'ASC')->paginate(6);
    return view('pages.home', compact('listProduct'/*, 'meta_des', 'meta_keywords', 'meta_title', 'meta_canonical'*/));
        }
    }
    public function search(Request $request)
    {
        $value_search = $request->search;
        $listSearchs = Product::where('name', 'like', '%'.$value_search.'%')->orWhere('price', 'like', '%'.$value_search.'%')->get();
        return view('pages.search', compact('listSearchs', 'value_search'));
    }


    public function showContactForm()
    {
        return view('users.contact-us');
    }
    public function sendMail(Request $request)
    {
        $toEmail = $request->email;
        $fromEmail = 'vanhauqld45@gmail.com';
        $data = ['content' => $request->content, 'username'=> 'HauPham'];
        \Mail::send('mails.contatct-us', $data, function($message) use ($toEmail, $fromEmail){
            $message->to($toEmail, 'Mr Hau');
            $message->from($fromEmail, 'Mr Brown');
            $message->subject('Contact Mail');
        });
        return 'success';
    }
}
