<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Province;
use App\District;
use App\Ward;
use DB;
use App\Http\Requests\RegisterUserRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
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
            auth()->login($user);
            return Redirect()->route('home.index');
        } else{
            $data['image'] = '';
            $user = User::create($data);
            auth()->login($user);
            return Redirect()->route('home.index');
        }
    }
}
