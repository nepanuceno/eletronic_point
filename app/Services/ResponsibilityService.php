<?php
namespace App\Services;

use App\Repositories\Interfaces\Responsibility\ResponsibilityRepositoryInterface;

class ResponsibilityService
{
    protected $responsibility;
    public function __construct(ResponsibilityRepositoryInterface $responsibilityInterface)
    {
        $this->responsibility = $responsibilityInterface;
    }

    public function listResponsibilities(){
        return $this->responsibility->listResponsibilities();
    }

    public function createResponsibility(array $inputs)
    {
        return $this->responsibility->createResponsibility($inputs);
    }

    public function updateResponsibility(array $inputs, $id)
    {
        return $this->responsibility->updateResponsibility($inputs, $id);
    }

    public function showResponsibility($id)
    {
        return $this->responsibility->showResponsibility($id);
    }

    public function destroy($id)
    {
        return $this->responsibility->destroy($id);
    }
}
