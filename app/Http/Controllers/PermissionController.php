<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(8);
        return view('permissions.list_permission', compact('permissions'));
    }
    public function create()
    {
        return view('permissions.add_permission');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data = $request->validate([
            'name' => 'required',
            'display_name' => 'required',
        ]);
        Permission::create($data);
        return Redirect()->back()->with('message', 'Bạn đã thêm quyền thành công!');
    }
    public function show(Permission $permission)
    {
        //
    }
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permissions.edit_permission', compact('permission'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        Permission::find($id)->update($data);
        return Redirect()->route('permission.index')->with('message', 'Bạn cập nhật thành công!');
    }
    public function destroy($id)
    {
        Permission::find($id)->delete();
        return Redirect()->back()->with('message', 'Bạn đã xóa thành công!');
    }
}
