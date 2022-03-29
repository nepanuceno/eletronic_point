<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Mail\WelcomeNewUserMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Classes\UserStatusActive;
use App\Http\Requests\User\UserRequest;
use App\Http\Classes\NewUserPasswordCreate;
use App\Repositories\Interfaces\Role\RoleRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;

class UserController extends Controller
{
    const PAGINATION=5;
    const STATUS_ACTIVE_USER=1;

    private $userRepository;
    private $roleRepository;

    public function __construct(Request $request, UserRepositoryInterface $userInterface, RoleRepositoryInterface $roleInterface)
    {
        $this->userRepository = $userInterface;
        $this->roleRepository = $roleInterface;

        $this->middleware(function ($request, $next) {
            if ((integer) $request->user != auth()->id()) {
                $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
            }
            return $next($request);
        });

        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user_status_active = UserStatusActive::getUserStatusActive() ? 1:0;
            $data = $this->userRepository->getAllUsers(self::PAGINATION, $user_status_active);
            return view('users.index',compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * self::PAGINATION);
        } catch (\Throwable $th) {
            return view('users.index')->with('error',__('user_list_error').$th->getMessage());
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
            $roles = $this->roleRepository->getAllRoles();
            return view('users.create',compact('roles'));
        } catch (\Throwable $th) {
            return view('users.index')->with('error',__('data_load_error').$th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->validated();
        $input = $request->all();
        $passwd = NewUserPasswordCreate::generate();
        $input['password'] = Hash::make($passwd);

        try {
            $new_user = $this->userRepository->createUser($input);
            $details = [
                'name' => $new_user->name,
                'passwd' => $passwd,
                'email' => $new_user->email
            ];

            activity()->log(__('users.create_user_success'));
            Mail::to($new_user->email)->send(new WelcomeNewUserMail($details));
            return redirect()->route('users.index')
                ->with('success', __('users.str-feedback-create-user'));
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error',__('create_user_error').$th->getMessage());
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
            $user = $this->userRepository->getUser($id);
            return view('users.show',compact('user'));
        } catch (\Throwable $th) {
            return view('users.index')->with('error',__('show_user_error').$th->getMessage());
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
            $user = $this->userRepository->getUser($id);
            return view('users.edit',compact('user'));
        } catch (\Throwable $th) {
            return view('users.index')->with('error',__('update_user_error').$th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        try {
            $user = $this->userRepository->getUser($id);
            $this->userRepository->updateUser($user, $input);
            activity()->log(__('users.edit_user_success'));

            if ($user->can('user.list')) {
                return redirect()->route('users.index')
                    ->with('success',__('users.str-feedback-update-user'));
            } else {
                return redirect()->route('home')
                ->with('success',__('users.str-feedback-update-user'));
            }
        } catch (\Throwable $th) {
            return view('users.index')->with('error',__('update_user_error').$th->getMessage());
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
            $user = $this->userRepository->getUser($id);
            UserStatusActive::changeStatus($user);
            $user->save();
            activity()->log(__('users.disable_user_success'));
            return redirect()->route('users.index')->with('success',__('users.str-feedback-update-user'));
        } catch (\Throwable $th) {
            return view('users.index')->with('error',__('disable_user_error').$th->getMessage());
        }
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
        try {
            return $this->userRepository->getAllUsersActive(self::STATUS_ACTIVE_USER);
        } catch (\Throwable $th) {
            return view('role_user.index')->with('error', __('user_list_error').$th->getMessage());
        }
    }
}
