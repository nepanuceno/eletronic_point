<?php

namespace App\Models;

use App\IsSelfReferencing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departament extends Model
{
    use HasFactory, SoftDeletes, IsSelfReferencing;

    protected $fillable = ['name', 'parent_id'];
}
