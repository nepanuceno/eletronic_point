<?php
namespace App\Services;

use App\Repositories\Interfaces\Employee\EmployeeRepositoryInterface;
use Yajra\DataTables\Facades\DataTables as Datatables;

class EmployeeService
{
    protected $interface;

    const ACTIVE=1;
    const DEACTIVE=0;
    protected $status;

    public function __construct(EmployeeRepositoryInterface $interface)
    {
        $this->interface = $interface;
    }

    private function makeDataTables($employees)
    {
        return Datatables::of($employees)
                ->addIndexColumn()
                ->addColumn('employee', function($employee){
                    $url = url('employees', ['id'=>$employee->id]);
                    return "<a href='$url'>".$employee->user->name."</a>";
                })
                ->addColumn('departament', function($employee){
                    return $employee->departament->name;
                })
                ->addColumn('responsibility', function($employee){
                    return $employee->responsibility->name;
                })
                ->addColumn('action', function($employee){
                        $btn = "
                        <div class=\"dropdown dropleft\">
                            <button class=\"btn btn-info dropdown-toggle\" type=\"button\"
                                id=\"dropdownMenu2\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                                aria-expanded=\"false\">
                                ".__('app.label-actions')."
                            </button>
                            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu2\">
                                <a class=\"dropdown-item\" href=\"employees/$employee->id/edit\"><i class=\"fas fa-edit\"></i>".__('app.btn-edit')."</a>
                                <a class=\"dropdown-item\" href=\"employees/$employee->id\"><i class=\"fas fa-eye\"></i>".__('app.btn-details')."</a>
                                <form method=\"POST\" action=\"".
                                    url("employees".($this->status==self::ACTIVE?'/':'/restore/').$employee->id)
                                    ."\" accept-charset=\"UTF-8\" style=\"display:inline\">
                                    <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                                    <input name=\"_token\" type=\"hidden\" value=\"".csrf_token()."\">
                                    <button
                                        type=\"submit\"
                                        type-icon=\"question\"
                                        data-title=\"Desativar ".($this->status==self::ACTIVE?'Desativar':'Ativar').$employee->user->name."?\"
                                        class=\"dropdown-item disable-button\"
                                        data-text=\"Tem certeza desta ação?\"
                                        confirm-button-text=\"Sim\"
                                        cancel-button-text=\"Não\">
                                        <i class=\"fas fa-trash\"></i> ".($this->status==self::ACTIVE?'Desativar':'Ativar')."
                                    </button>
                                </form>
                            </div>
                        </div>";
                        return $btn;
                })
                ->rawColumns(['employee', 'action'])
                ->make(true);
    }

    public function listEmployees(&$request)
    {
        $this->status = $request->status;

        if (!isset($request->status) || $request->status==self::ACTIVE) {
            return $this->makeDataTables($this->interface->listEmployees());
        }
        else if ($request->status == self::DEACTIVE) {
            return $this->makeDataTables($this->interface->listDeactivatedEmployees());
        }
    }

    public function createEmployee(array $inputs)
    {
        return $this->interface->createEmployee($inputs);
    }

    public function getEmployee($id)
    {
        return $this->interface->showEmployee($id);
    }

    public function updateEmployee(array $inputs, $id)
    {
        return $this->interface->updateEmployee($inputs, $id);
    }

    public function deleteEmployee($id)
    {
        return $this->interface->deleteEmployee($id);
    }

    public function restoreEmployee($id)
    {
        return $this->interface->restoreEmployee($id);
    }
}
