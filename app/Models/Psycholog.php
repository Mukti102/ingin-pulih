<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Psycholog extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    public function jenisPsikolog()
    {
        return $this->belongsTo(Type::class, 'jenis_psikolog');
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'psycholog_topics');
    }

    public function document()
    {
        return $this->hasOne(PsychologDocument::class, 'psycholog_id');
    }

    public function services()
    {
        return $this->hasMany(PsichologService::class, 'psycholog_id');
    }

    public function weeklySchedules()
    {
        return $this->hasMany(PsychologistWeeklySchedule::class);
    }

    public function booking(){
        return $this->hasOne(Booking::class,'psycholog_id');
    }
}
