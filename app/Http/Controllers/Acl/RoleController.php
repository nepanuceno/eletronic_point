<?php
namespace App\Http\Controllers\Acl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Repositories\Interfaces\Role\RoleRepositoryInterface;
use App\Repositories\Interfaces\Permission\PermissionRepositoryInterface;

class RoleController extends Controller
{
    const PAGINATION=5;

    private $role;
    private $permission;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(RoleRepositoryInterface $roleRepositoryInterface, PermissionRepositoryInterface $permissionRepositoryInterface)
    {
        $this->role = $roleRepositoryInterface;
        $this->permission = $permissionRepositoryInterface;

        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $roles = $this->role->getRolesOrderBy('id','DESC')->paginate(self::PAGINATION);
            return view('roles.index',compact('roles'))
                ->with('i', ($request->input('page', 1) - 1) * self::PAGINATION);
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error',__('roles.error_list_roles'). ' - '.$th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $permissions = $this->permission->getPermissions();
            return view('roles.create',compact('permissions'));
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error',$th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $this->role->createRole($request);
            activity()->log(__('roles.create_role_success'));
            return redirect()->route('roles.index')->with('success',__('roles.success_create_role'));
        } catch (\Throwable $th) {
            activity()->log(__('roles.create_role_error'). ' - '.$th->getMessage());
            return redirect()->route('roles.index')->with('error',__('roles.error_create_role'). ' - '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $role = $this->role->getRole($id);
            $rolePermissions = $this->permission->getPermissionsForRole($role->id);
            return view('roles.show',compact('role','rolePermissions'));
        } catch (\Throwable $th) {
            return view('roles.edit')->with('error',__('roles.error_get_fields_role'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $role = $this->role->getRole($id);
            $permissions = $this->permission->getPermissions();
            $rolePermissions = $this->permission->getAllPermissionsEditRole($role->id);
            return view('roles.edit',compact('role','permissions','rolePermissions'));
        } catch (\Throwable $th) {
            return view('roles.edit')->with('error',__('roles.error_get_fields_role'). ' - '.$th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $this->role->updateRole($request, $id);
            activity()->log(__('roles.edit_role_success'));

            return redirect()->route('roles.index')->with('success',__('roles.success_update_role'));
        } catch (\Throwable $th) {
            activity()->log(__('roles.edit_role_error'. ' - '.$th->getMessage()));
            return redirect()->route('roles.index')->with('error',__('roles.error_update_role').' - '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->roleIsAdmin($id)) {
            return redirect()->route('roles.index')->with('error',__('roles.error_delete_role').' - '. __('roles.forbidden_delete_profile_admin'));
        }

        try {
            $this->role->deleteRole($id);
            activity()->log(__('roles.destroy_role_success'));

            return redirect()->route('roles.index')->with('success',__('roles.success_delete_role'));
        } catch (\Throwable $th) {
            activity()->log(__('roles.destroy_role_error'. ' - '.$th->getMessage()));

            return redirect()->route('roles.index')->with('error',__('roles.error_delete_role').' - '. $th->getMessage());
        }
    }

    private function roleIsAdmin($role_id) {
        $role = $this->role->getRole($role_id);
        if($role->name == config('app.user_admin')) {
            return true;
        }
    }
}
