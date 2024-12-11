<?php

namespace App\Models;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpiCriteria extends Model
{
    use HasFactory;

    protected $fillable = ['position_id', 'criteria_name', 'weight'];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
