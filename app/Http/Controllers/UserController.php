<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\Http\Requests\RegisterUserRequest;
use App\Province;
use App\District;
use App\Ward;
use DB;
use Session;
session_start();

class UserController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function showLoginForm()
    {
        return view('users.login');
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        // dd($data);
        $result = User::where('email', $email)->where('password', $password)->first();
        if ($result) {
            Session::put('name', $result ->name);
            Session::put('id', $result ->id);
            $user = User::find($result ->id)->first();
            Session::put('userId', $result ->id);
            return Redirect()->route('home.index');
        }
        return Redirect()->back()->with('message', 'Mật khẩu hoặc tài khoản không đúng!')->withInput();
    }
    public function logout(Request $request)
    {
        Session::put('name', null);
        Session::put('id', null);
        return Redirect()->route('users.showLoginForm');
    }
    public function showRegistrationForm()
    {
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        $listCategory = Category::where('status', 1)->get();
        $listBrand = Brand::where('status', 1)->get();
        return view('users.register', compact('listCategory', 'listBrand', 'provinces', 'districts', 'wards'));
    }
    public function showDistrict(Request $request)
    {
        if($request->ajax()){
            $districts = District::where('province_id', $request->province_id)->select('id', 'name')->get();
            return response()->json($districts);
        }
    }
    public function showWard(Request $request)
    {
        if ($request->ajax()) {
            $wards = DB::table('wards')->where('district_id', $request->district_id)->where('province_id', $request->province_id)->select('id', 'name')->get();
            return response()->json($wards);
        }
    }
    public function register(RegisterUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = md5($request->password);
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image-> move('upload/users', $new_image);
            $data['image'] = $new_image;
            $user = User::create($data);
            return Redirect()->route('users.showLoginForm')->with('message', 'Bạn đăng ký thành công, vui lòng đăng nhập để được truy cập!');
        } else{
            $data['image'] = '';
            $user = User::create($data);
            return Redirect()->route('users.showLoginForm')->with('message', 'Bạn đăng ký thành công, vui lòng đăng nhập để được truy cập!');
        }
    }
}
