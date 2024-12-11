<?php

namespace App\Models;

use App\Models\Bonus;
use App\Models\Payroll;
use App\Models\KpiScore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Period extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date', 'is_active'];

    public function kpiScores()
    {
        return $this->hasMany(KpiScore::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }
}
