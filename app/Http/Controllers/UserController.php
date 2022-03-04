<?php

namespace App\Http\Controllers;

//TODO Implementar os blocos Try/Catch
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Classes\UserStatusActive;
use App\Http\Requests\UserPostRequest;
use App\Interfaces\Role\RoleInterface;
use App\Interfaces\User\UserInterface;
use App\Http\Requests\UserUpdatePostRequest;

class UserController extends Controller
{
    const PAGINATION=5;
    const STATUS_ACTIVE_USER=1;

    private UserInterface $userRepository;
    private RoleInterface $roleRepository;

    public function __construct(UserInterface $userInterface, RoleInterface $roleInterface)
    {
        $this->userRepository = $userInterface;
        $this->roleRepository = $roleInterface;

        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_status_active = UserStatusActive::getUserStatusActive() ? 1:0;
        $data = $this->userRepository->getAllUsers(self::PAGINATION, $user_status_active);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * self::PAGINATION);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->getAllRoles();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        $request->validated();
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = $this->userRepository->createUser($input);
        $this->userRepository->assignRole($user, $request->input('roles'));

        activity()->log(__('users.create_user_success'));

        return redirect()->route('users.index')
            ->with('success', __('users.str-feedback-create-user'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getUser($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getUser($id);
        $roles = $this->roleRepository->getAllRoles();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdatePostRequest $request, $id)
    {
        $request->validated();

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = $this->userRepository->getUser($id);
        $this->userRepository->updateUser($user, $input);
        $this->roleRepository->destroyModelHasRole($id);
        $this->userRepository->assignRole($user,$request->input('roles'));
        activity()->log(__('users.edit_user_success'));

        return redirect()->route('users.index')
            ->with('success',__('users.str-feedback-update-user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->getUser($id);
        UserStatusActive::changeStatus($user);
        $user->save();
        activity()->log(__('users.disable_user_success'));

        return redirect()->route('users.index')->with('success',__('users.str-feedback-update-user'));
    }

    /**
     * Set value session Status User. 0|1
     *
     * @param null
     * @return \Illuminate\Http\Response
     */
    public function switchUserShowStatus() {
        UserStatusActive::setUserStatusActive();
        return redirect()->route('users.index');
    }

    public function getAllActiveUsers() {
        return $this->userRepository->getAllUsersActive(self::STATUS_ACTIVE_USER);
    }
}
