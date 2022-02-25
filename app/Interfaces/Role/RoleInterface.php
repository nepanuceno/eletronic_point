<?php

namespace App\Interfaces\Role;

interface RoleInterface
{
    public function getAllRoles();
    public function destroyModelHasRole($user_id);
}
