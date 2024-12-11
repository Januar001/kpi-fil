<?php

namespace App\Models;

use App\Models\Period;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpiScore extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'period_id', 'score'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
