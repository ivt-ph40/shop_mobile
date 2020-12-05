<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Permission;
use App\Permission_Role;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.list_role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.add_role', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $roles = Role::create($data);

            //insert permissions
            $roles->permissions()->attach($request->permission_ids);
            DB::commit();
            return Redirect()->back()->with('message', 'Bạn thêm vai trò thành công!');   
        } catch (Exception $e) {
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $permissions = Permission::all();
            $roles = Role::find($id);
            $listPermissionRole = Permission_Role::where('role_id', $id)->pluck('permission_id');
            // dd($roles->toArray());
            DB::commit();
            return view('roles.edit_role', compact('roles', 'listPermissionRole', 'permissions'));
        } catch (Exception $e) {
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = array();
            $data = $request->except('_token', '_method');
            $roles = Role::find($id);
            $roles->update($data);
            $roles->permissions()->sync($request->permission_ids);
            DB::commit();
            return Redirect()->route('roles.index')->with('message', 'Bạn đã cập nhật thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return Redirect()->back()->with('message', 'Bạn xóa người dùng thành công');
    }
}
