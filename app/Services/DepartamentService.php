<?php

namespace App\Services;

use App\Repositories\Interfaces\Departament\DepartamentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DepartamentService
{
    protected $departament;

    public function __construct(DepartamentRepositoryInterface $departamentRepositoryInterface)
    {
        $this->departament = $departamentRepositoryInterface;
    }

    public function list()
    {
        return $this->departament->listDepartaments();
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

    public function rootDepartament()
    {
        return $this->departament->rootDepartament();
    }

    public function output($projects, $departament)
    {
        $string = "<ul>";
        foreach ($projects as $i => $project) {
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
