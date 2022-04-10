<?php
namespace App\Services;

use App\Repositories\Interfaces\Employee\EmployeeRepositoryInterface;

class EmployeeService
{
    protected $interface;

    const ACTIVE=1;
    const DEACTIVE=0;

    public function __construct(EmployeeRepositoryInterface $interface)
    {
        $this->interface = $interface;
    }

    public function listEmployees(&$request)
    {
        if (!isset($request->status) || $request->status==self::ACTIVE) {
            return $this->interface->listEmployees();
        }
        else if ($request->status == self::DEACTIVE) {
            return $this->interface->listDeactivatedEmployees();
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
