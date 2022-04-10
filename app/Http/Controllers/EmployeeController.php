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
        $employees = $this->service->listEmployees($request);

        return Datatables::of($employees)
                ->addIndexColumn()
                ->addColumn('employee', function($employee){
                    $url = url('users.show', ['id'=>$employee->user->id]);
                    return "<a href='$url'>".$employee->user->name."</a>";
                })
                ->addColumn('departament', function($employee){
                    return $employee->departament->name;
                })
                ->addColumn('responsibility', function($employee){
                    return $employee->responsibility->name;
                })
                ->addColumn('action', function($employee){
                        $btn = '
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>';
                        return $btn;
                })
                ->rawColumns(['employee', 'action'])
                ->make(true);
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
        return view('employees.index', compact('employee'));
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
    }
}
