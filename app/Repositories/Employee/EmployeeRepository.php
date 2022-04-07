<?php
namespace App\Repositories\Employee;

use App\Repositories\Interfaces\Employee\EmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function listEmployees()
    {
        return $this->model->paginate(15);
    }

    public function createEmployee(array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function showEmployee($id)
    {
        return $this->model->find($id);
    }

    public function updateEmployee(array $inputs, $id)
    {
        return $this->model->find($id)->update($inputs);
    }

    public function deleteEmployee($id)
    {
        return $this->model->find($id)->delete();
    }

    public function restoreEmployee($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }
}
