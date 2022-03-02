<?php
namespace App\Interfaces\Permission;

interface PermissionInterface
{
    public function getPermissions();
    public function getPermissionsForRole($role_id);
    public function getAllPermissionsEditRole($role_id);
}
