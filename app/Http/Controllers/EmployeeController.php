<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Services\DepartamentService;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Services\ResponsibilityService;

class EmployeeController extends Controller
{

    protected $service;
    protected $userService;
    protected $departamentService;
    protected $responsibilityService;

    public function __construct(EmployeeService $service, UserRepositoryInterface $user, DepartamentService $departament, ResponsibilityService $responsibility)
    {
        $this->service = $service;
        $this->userService = $user;
        $this->departamentService = $departament;
        $this->responsibilityService = $responsibility;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->service->listEmployees();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userService->getAllUsers(15, 1);
        $departaments = $this->departamentService->list();
        $responsibilities = $this->responsibilityService->listResponsibilities();
        return view('employees.create', compact('users', 'departaments', 'responsibilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->service->createEmployee($request->all());
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
