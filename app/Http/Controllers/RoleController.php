<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Permission\PermissionInterface;
use App\Interfaces\Role\RoleInterface;

class RoleController extends Controller
{
    const PAGINATION=5;

    private RoleInterface $role;
    private PermissionInterface $permission;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(RoleInterface $roleInterface, PermissionInterface $permissionInterface)
    {
        $this->role = $roleInterface;
        $this->permission = $permissionInterface;

        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
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
            return redirect()->route('roles.index')->with('error',__('error_list_roles'). ' - '.$th->getMessage());
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        try {
            $this->role->createRole($request);
            return redirect()->route('roles.index')->with('success',__('success_create_role'));
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error',__('error_create_role'). ' - '.$th->getMessage());
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
            return view('roles.edit')->with('error',__('error_get_fields_role'));
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
            $permission = $this->permission->getPermissions();
            $rolePermissions = $this->permission->getAllPermissionsEditRole($role->id);
            return view('roles.edit',compact('role','permission','rolePermissions'));

        } catch (\Throwable $th) {
            return view('roles.edit')->with('error',__('error_get_fields_role'). ' - '.$th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        try {
            $this->role->updateRole($request, $id);
            return redirect()->route('roles.index')->with('success',__('success_update_role'));
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error',__('error_update_role').' - '.$th->getMessage());
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
        try {
            $this->role->deleteRole($id);
            return redirect()->route('roles.index')->with('success',__('success_delete_role'));
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error',__('error_delete_role').' - '. $th->getMessage());

        }

    }
}
