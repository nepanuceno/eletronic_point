<?php
namespace App\Services;

use App\Repositories\Interfaces\Departament\DepartamentRepositoryInterface;

class DepartamentService
{
    protected $departament;

    const ACTIVE=1;
    const DEACTIVE=0;

    public function __construct(DepartamentRepositoryInterface $departamentRepositoryInterface)
    {
        $this->departament = $departamentRepositoryInterface;
    }

    public function list(&$request=null)
    {
        if (!isset($request->status) || $request->status==self::ACTIVE) {
            $request=self::DEACTIVE;
            return $this->departament->listDepartaments();
        }
        else if ($request->status == self::DEACTIVE) {
            $request=self::ACTIVE;
            return $this->departament->listDeactivatedDepartments();
        }
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
