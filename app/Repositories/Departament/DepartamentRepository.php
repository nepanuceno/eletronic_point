<?php
namespace App\Repositories\Departament;

use App\Models\Departament;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\Departament\DepartamentRepositoryInterface;

class DepartamentRepository implements DepartamentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function listDepartaments()
    {
        return $this->model->paginate(15);
    }

    public function listDeactivatedDepartments()
    {
        return$this->model->onlyTrashed()->paginate(15);
    }

    public function getDepartament($id)
    {
        return $this->model->find($id);
    }

    public function createDepartament(array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function updateDepartament(array $inputs, $id)
    {
        return $this->model->find($id)->update($inputs);
    }

    public function deleteDepartament($id)
    {
        return $this->model->find($id)->delete();
    }

    public function restoreDepartament($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

    public function rootDepartament()
    {
        return $this->model->whereNull('parent_id')->get();
    }
}
