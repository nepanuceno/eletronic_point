<?php

namespace App\Repositories\Permission;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Repositories\Interfaces\Permission\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getPermissions() {
       return Permission::get();
    }

    public function getPermissionsForRole($role_id) {
        return Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id", $role_id)
        ->get();
    }

    public function getAllPermissionsEditRole($role_id) {
        return DB::table("role_has_permissions")
        ->where("role_has_permissions.role_id",$role_id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
    }
}
