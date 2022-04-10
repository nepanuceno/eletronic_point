<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'departament_id', 'responsibility_id', 'matriculation', 'telephone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

    public function responsibility()
    {
        return $this->belongsTo(Responsibility::class);
    }
}
