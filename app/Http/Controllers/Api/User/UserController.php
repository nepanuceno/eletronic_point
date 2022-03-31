<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Classes\UserStatusActive;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\Interfaces\User\UserRepositoryInterface;

class UserController extends BaseController
{
    const PAGINATION=5;
    const STATUS_ACTIVE_USER=1;

    private $userRepository;
    private $userLogged;

    public function __construct(Request $request, UserRepositoryInterface $userInterface)
    {
        $this->userRepository = $userInterface;
        $this->middleware(function ($request, $next) {
            if ((integer) $request->user != auth()->id()) {
                $this->userLogged = $this->userRepository->getUserLogged();
                dd($this->userLogged);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($this->userLogged->hasPermissionTo('user-list')) {
                $data = $this->userRepository->getAllUsers(self::PAGINATION, 1);
                return $this->sendResponse($data,'Users retrieved successfully.');
            } else {
                return $this->sendError("Não autorizado!", [], 403);
            }
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage(), [], $th->getCode());
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
