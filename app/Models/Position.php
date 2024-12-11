<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\KpiCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function kpiCriterias()
    {
        return $this->hasMany(KpiCriteria::class);
    }
    public function Employees()
    {
        return $this->hasMany(Employee::class);
    }
}
