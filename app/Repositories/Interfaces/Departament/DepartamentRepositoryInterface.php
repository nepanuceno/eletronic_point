<?php
namespace App\Repositories\Interfaces\Departament;

use Illuminate\Database\Eloquent\Model;

interface DepartamentRepositoryInterface
{
    public function __construct(Model $model);
    public function listDepartaments();
    public function getDepartament($id);
    public function createDepartament(array $inputs);
    public function updateDepartament(array $inputs, $id);
    public function deleteDepartament($id);
    public function rootDepartament();
}
