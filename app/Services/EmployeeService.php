<?php
namespace App\Services;

use App\Repositories\Interfaces\Employee\EmployeeRepositoryInterface;

class EmployeeService
{
    protected $interface;

    public function __construct(EmployeeRepositoryInterface $interface)
    {
        $this->interface = $interface;
    }

    public function listEmployees()
    {
        return $this->interface->listEmployees();
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
