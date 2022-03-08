<?php
namespace App\Repositories\Interfaces\Permission;

interface PermissionRepositoryInterface
{
    public function getPermissions();
    public function getPermissionsForRole($role_id);
    public function getAllPermissionsEditRole($role_id);
}
