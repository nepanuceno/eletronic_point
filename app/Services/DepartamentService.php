<?php
namespace App\Services;

use App\Repositories\Interfaces\Departament\DepartamentRepositoryInterface;

class DepartamentService
{
    protected $departament;
    private $status;

    public function __construct(DepartamentRepositoryInterface $departamentRepositoryInterface)
    {
        $this->departament = $departamentRepositoryInterface;
    }

    public function list($request=null)
    {
        if (!isset($request->status) || $request->status==1) {
            $this->setStatusActive(0);
            return $this->departament->listDepartaments();
        }
        else if ($request->status == 0) {
            $this->setStatusActive(1);
            return $this->departament->listDeactivatedDepartments();
        }
    }

    public function setStatusActive($status)
    {
        $this->status = $status;
    }

    public function getStatusActive()
    {
        return $this->status;
    }

    public function get($id)
    {
        return $this->departament->getDepartament($id);
    }

    public function store(array $inputs)
    {
        return $this->departament->createDepartament($inputs);
    }

    public function update(array $inputs, $id)
    {
        return $this->departament->updateDepartament($inputs, $id);
    }

    public function delete($id)
    {
        return $this->departament->deleteDepartament($id);
    }

    public function restore($id)
    {
        return $this->departament->restoreDepartament($id);
    }

    public function rootDepartament()
    {
        return $this->departament->rootDepartament();
    }

    public function output($descendents, $departament)
    {
        $string = "<ul>";
        foreach ($descendents as $i => $project) {
            $string .= "<li>";
            if($departament->id == $project->id) {
                $string .= "<code class='color'>".$project['name']."</code>";
            }
            else {
                if ($project->status == 0)
                $string .= "<code class='disable'>".$project['name']."</code>";
                else
                $string .= "<code>".$project['name']."</code>";
            }
            if (count($project['children'])) {
                $string .= $this->output($project['children'], $departament);
            }
            $string .= "</li>";
        }
        $string .= "</ul>";

        return $string;
    }

}
