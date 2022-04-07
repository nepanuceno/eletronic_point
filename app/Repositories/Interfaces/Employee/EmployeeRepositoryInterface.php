<?php
namespace App\Repositories\Interfaces\Employee;

use Illuminate\Database\Eloquent\Model;

interface EmployeeRepositoryInterface
{
    public function __construct(Model $model);
    public function listEmployees();
    public function createEmployee(array $inputs);
    public function showEmployee($id);
    public function updateEmployee(array $inputs, $id);
    public function deleteEmployee($id);
    public function restoreEmployee($id);
}
