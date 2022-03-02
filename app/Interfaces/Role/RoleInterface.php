<?php

namespace App\Interfaces\Role;

interface RoleInterface
{
    public function getAllRoles();
    public function destroyModelHasRole($user_id);
    public function getRolesOrderBy($field, $order);
    public function createRole($inputs);
    public function updateRole($inputs, $id);
    public function deleteRole($id);
    public function getRole($id);
}
