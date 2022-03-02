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

    public function getRolesOrderBy($field, $order) {
       return Role::orderBy($field,$order);
    }

    public function createRole($inputs) {
        $role = Role::create(['name' => $inputs->input('name')]);
        $role->syncPermissions($inputs->input('permission'));
    }

    public function updateRole($inputs, $id) {
        $role = $this->getRole($id);
        $role->name = $inputs->input('name');
        $role->save();
        $role->syncPermissions($inputs->input('permission'));
    }

    public function getRole($id) {
       return Role::find($id);
    }

    public function deleteRole($id) {
        $this->getRole($id)->delete();
    }
}