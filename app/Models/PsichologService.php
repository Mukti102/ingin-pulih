<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsichologService extends Model
{
    protected $guarded = ['id'];

    public function psycholog()
    {
        return $this->belongsTo(Psycholog::class, 'psycholog_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
