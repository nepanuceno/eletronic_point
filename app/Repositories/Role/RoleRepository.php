<?php

namespace App\Repositories\Role;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Interfaces\Role\RoleInterface;

class RoleRepository implements RoleInterface
{
    public function getAllRoles() {
        return Role::pluck('name','name')->all();
    }

    public function destroyModelHasRole($id) {
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    }
}
