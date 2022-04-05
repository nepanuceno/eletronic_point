<?php
namespace App\Repositories\Interfaces\Responsibility;

use Illuminate\Database\Eloquent\Model;

interface ResponsibilityRepositoryInterface
{
    public function __construct(Model $model);
    public function listResponsibilities();
    public function createResponsibility(array $inputs);
    public function updateResponsibility(array $inputs, $id);
    public function showResponsibility($id);
    public function destroy($id);
}
