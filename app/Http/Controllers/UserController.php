<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateProfileUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserAdRequest;
use App\Province;
use App\District;
use App\Ward;
use App\Role;
use App\Role_User;
use DB;
use Closure;
use Session;
session_start();

class UserController extends Controller
{
    public function AuthLogin(){
        $userId = Session::get('userId');
        if ($userId) {
            return Redirect()->route('users.show_profile');
        } else{
            return abort(401);
        }
    }
    public function index()
    {
        $users = User::all();
        return view('users.list_user', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        $provinces = Province::all();
        return view('users.add_user', compact('provinces', 'roles'));
    }
    public function store(RegisterUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = array();
            $data = $request->all();
            $data['password'] = md5($request->password);
            $get_image = $request->file('image');
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image-> move('upload/users', $new_image);
                $data['image'] = $new_image;
                $users = User::create($data);
                $users->roles()->attach($request->role_ids);
                DB::commit();
                return Redirect()->back()->with('message', 'Bạn tạo người dùng thành công!');
            } else{
                $data['image'] = '';
                $users = User::create($data);
                $users->roles()->attach($request->role_ids);
                DB::commit();
                return Redirect()->back()->with('message', 'Bạn tạo người dùng thành công!');
            }
        } catch (Exception $e) {
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $users = User::where('id', $id)->first();
            $roles = Role::all();
            $provinces = Province::all();
            $districts = District::all();
            $wards = Ward::all();
            $listRoleUser = Role_User::where('user_id', $id)->pluck('role_id');
            // dd($listRoleUser);
            DB::commit();
            return view('users.edit_users_ad', compact('users', 'roles', 'listRoleUser', 'provinces', 'districts', 'wards'));
        } catch (Exception $e) {
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }
    }
    public function update(UpdateUserAdRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = array();
            if ($request->password == null) {
                $data = $request->except('_token', '_method', 'password');
                $get_image = $request->file('image');
                if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image-> move('upload/users', $new_image);
                    $data['image'] = $new_image;
                    $users = User::find($id);
                    $users->update($data);
                    $users->roles()->sync($request->role_ids);
                    DB::commit();
                    return Redirect()->route('users.index')->with('message', 'Bạn đã sửa người thành công!');
                } else{
                    $data['image'] = $request->old_image;
                    $users = User::find($id);
                    $users->update($data);
                    $users->roles()->sync($request->role_ids);
                    DB::commit();
                    return Redirect()->route('users.index')->with('message', 'Bạn đã sửa người thành công!');
                }
            } else{
                $data = $request->except('_token', '_method');
                $data['password'] = md5($request->password);
                $get_image = $request->file('image');
                if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image-> move('upload/users', $new_image);
                    $data['image'] = $new_image;
                    $users = User::find($id);
                    $users->update($data);
                    $users->roles()->sync($request->role_ids);
                    DB::commit();
                    return Redirect()->route('users.index')->with('message', 'Bạn đã sửa người thành công!');
                } else{
                    $data['image'] = $request->old_image;
                    $users = User::find($id);
                    $users->update($data);
                    $users->roles()->sync($request->role_ids);
                    DB::commit();
                    return Redirect()->route('users.index')->with('message', 'Bạn đã sửa người thành công!');
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return Redirect()->back()->with('message', 'Bạn xóa người dùng thành công');
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
        $user = User::where('email', $email)->where('password', $password)->first();
        if ($user) {
            Session::put('image', $user->image);
            Session::put('name', $user ->name);
            Session::put('id', $user ->id);
            $roles = $user->with('roles')->find($user->id);
            $role_id = $roles->roles->pluck('id');
            Session::put('role_id', $role_id);
            Session::put('userId', $user ->id);
            if (count($role_id) > 0) {
                return Redirect()->route('admin.show_dashboard');
            } else{
                return Redirect()->route('home.index');
            }
        }
        return Redirect()->back()->with('message', 'Mật khẩu hoặc tài khoản không đúng!')->withInput();
    }
    public function logout(Request $request)
    {
        Session::put('name', null);
        Session::put('id', null);
        Session::put('userId', null);
        Session::put('image', null);
        Session::put('roles', null);
        return Redirect()->route('users.showLoginForm');
    }
    public function showRegistrationForm()
    {
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        return view('users.register', compact('provinces', 'districts', 'wards'));
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
    public function show_profile()
    {
        $this->AuthLogin();
        return view('users.setting');
    }
    public function manage_profile($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $provinces = Province::all();
            $districts = District::all();
            $wards = Ward::all();
            DB::commit();
            return view('users.edit_user_profile', compact('user', 'provinces', 'districts', 'wards'));
        } catch (Exception $e) {
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }

    }
    public function update_profile(UpdateProfileUserRequest $request, $id){
        $data = array();
        $data = $request->except('_token', '_method');
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image-> move('upload/users', $new_image);
            $data['image'] = $new_image;
            User::find($id)->update($data);
            $user = User::find($id);
            // dd($user->toArray());
            Session::put('image', $user->image);
            Session::put('name', $user ->name);
            Session::put('id', $user ->id);
            Session::put('userId', $user ->id);
            return Redirect()->back()->with('message', 'Bạn đã cập nhật thông tin thành công!');
        } else{
            $data['image'] = $request->old_image;
            User::find($id)->update($data);
            $user = User::find($id);
            // dd($user->toArray());
            Session::put('image', $user->image);
            Session::put('name', $user ->name);
            Session::put('id', $user ->id);
            Session::put('userId', $user ->id);
            return Redirect()->back()->with('message', 'Bạn đã cập nhật thông tin thành công!');
        }
    }
    public function info_profile($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $provinces = Province::all();
            $districts = District::all();
            $wards = Ward::all();
            DB::commit();
            return view('users.info_user', compact('user', 'provinces', 'districts', 'wards'));
        } catch (Exception $e) {
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }
    }
    public function form_change_password($id)
    {
        return view('users.change_password');
        
    }
    public function change_password(ChangePasswordRequest $request, $id)
    {
        $data = array();
        $old_password = md5($request->old_password);
        $data['password'] = md5($request->new_password);
        $user = User::find($id);
        // dd($old_password);
        if ($old_password == $user->password) {
            $user->update($data);
            return Redirect()->back()->with('message', 'Bạn đã thay đổi mật khẩu thành công');
        }else{
            return Redirect()->back()->with('message', 'Mật khẩu cũ không chính xác xin vui lòng kiểm tra lại!');
        }
    }
}
