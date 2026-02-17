<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistWeeklySchedule extends Model
{
    protected $fillable = [
        'psycholog_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_active'
    ];

    public function psycholog()
    {
        return $this->belongsTo(Psycholog::class);
    }
}
