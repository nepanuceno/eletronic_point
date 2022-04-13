<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Classes\StatusActive;
use App\Services\DepartamentService;
use App\Services\ResponsibilityService;
use Yajra\DataTables\Facades\DataTables as Datatables;
use App\Repositories\Interfaces\User\UserRepositoryInterface;


class EmployeeController extends Controller
{
    protected $service;
    protected $userService;
    protected $departamentService;
    protected $responsibilityService;
    protected $status;

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
    public function index(Request $request)
    {
        $status = StatusActive::setStatusActive($request);
        $this->status=$status;
        return view('employees.index', compact('status'));
    }

    public function listEmployeesWithAjax(Request $request)
    {
        return $this->service->listEmployees($request);
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
        return redirect()->back('employees.index')->with('success', __('employee.success_add_employee'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = $this->service->getEmployee($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = $this->userService->getAllUsers(15, 1);
        $departaments = $this->departamentService->list();
        $responsibilities = $this->responsibilityService->listResponsibilities();
        $employee = $this->service->getEmployee($id);
        return view('employees.create', compact('employee', 'users', 'departaments', 'responsibilities'));
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
        $this->service->updateEmployee($request->all(), $id);
        return redirect()->route('employees.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->deleteEmployee($id);
        return redirect()->back()->with('success', 'Show');
    }

     /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->service->restoreEmployee($id);
        return redirect()->back()->with('success', 'Show');
    }
}
