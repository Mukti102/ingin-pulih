<?php

namespace App\Services;

use App\Models\PsychologistWeeklySchedule;
use Illuminate\Support\Facades\DB;

class PsychologistWeeklyScheduleService
{
    public function listByPsycholog($psychologId)
    {
        return PsychologistWeeklySchedule::where('psycholog_id', $psychologId)
            ->orderByRaw("FIELD(day_of_week,
                'monday','tuesday','wednesday',
                'thursday','friday','saturday','sunday')")
            ->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return PsychologistWeeklySchedule::create($data);
        });
    }

    public function update(PsychologistWeeklySchedule $schedule, array $data)
    {
        return DB::transaction(function () use ($schedule, $data) {
            $schedule->update($data);
            return $schedule;
        });
    }

    public function delete(PsychologistWeeklySchedule $schedule)
    {
        return DB::transaction(function () use ($schedule) {
            $schedule->delete();
            return true;
        });
    }
}
