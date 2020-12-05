<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Role;
use App\Permission;
use DB;
use Session;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        //lấy tất cả các vai trò (roles) của users đang login vào hệ thống
        $userId = Session::get('userId');
        $list_roles_of_users = User::find($userId)->roles()->select('roles.id')->pluck('id')->toArray();
        // dd($list_roles_of_users);

        //lấy tất cả các quyền(permission) của users đang login trong hệ thống
        $listPermissionRole = DB::table('roles')
                            ->join('permission_role', 'permission_role.role_id', '=', 'roles.id')
                            ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
                            ->whereIn('roles.id', $list_roles_of_users)
                            ->select('permissions.*')->get()->pluck('id')->unique();
        // dd($listPermissionRole);

        //lấy màn hình để check phân quyền
        $checkPermission = Permission::where('name', $permission)->value('id');
        // dd($checkPermission);
        //kiểm tra users được phép vào màn hình không
        if ($listPermissionRole->contains($checkPermission)) {
            return $next($request);
        }
        return abort(401);
    }
}
