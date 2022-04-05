<?php

namespace App\Repositories\Responsibility;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\Responsibility\ResponsibilityRepositoryInterface;

class ResponsibilityRepository implements ResponsibilityRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function listResponsibilities(){
        return $this->model->all();
    }

    public function createResponsibility(array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function updateResponsibility(array $inputs, $id)
    {
        return $this->model->find($id)->update($inputs);
    }

    public function showResponsibility($id)
    {
        return $this->model->find($id);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
