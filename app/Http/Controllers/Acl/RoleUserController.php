<?php

namespace App\Http\Controllers\Acl;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Role\RoleRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;

class RoleUserController extends Controller
{
    const STATUS_ACTIVE_USER=1;
    private $user;
    private $role;

    public function __construct(UserRepositoryInterface $user, RoleRepositoryInterface $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->user->getAllUsersActive(self::STATUS_ACTIVE_USER);
            $roles = $this->role->getRoles();
            return view('role_user.index', compact('users', 'roles'));
        } catch (\Throwable $th) {
            return view('role_user.index')->with('error', __('user_list_error').$th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = $this->user->getUser($request->user);
            $user->syncRoles([$request->roles]);
            return back()->with('success', __('roles_user.link_successfully_completed').'!');
        } catch (Throwable $e) {
            report($e);
            return back()->with('error', __('roles_user.error').': '.$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id and $role
     * @return \Illuminate\Http\Response
     */
    public function delete_roles_user($user_id, $role)
    {
        $user = $this->user->getUser($user_id);
        if($user->hasRole($role)) {
            try {
                $user->removeRole($role);
                return redirect()->back()->with('success', __('roles_user.function') ." [".$role."] ". __('roles_user.unlinked_from') ." ".$user->name);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('roles_user.function') ."[".$role."] ".__('roles_user.could_unlinked_from')." ".$user->name);
            }
        }
    }

    /**
     * Roles for User the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roles_user($id)
    {
        $user = $this->user->getUser($id);
        $roles_user = $user->getRoleNames()->toArray();
        $all_roles = $this->role->getAllRoles();
        $select_roles_array=Array();

        foreach($all_roles as $role_id=>$role) {
            $selected=false;
            if (in_array($role, $roles_user)) {
                $selected = true;
            }
            array_push($select_roles_array, ['id'=>$role_id, 'role'=>$role, 'selected'=>$selected]);
        }
        return json_encode($select_roles_array);
    }
}
