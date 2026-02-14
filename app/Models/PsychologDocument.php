<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologDocument extends Model
{
    protected $fillable = [ 
        'psycholog_id',
        'file_path',
        'is_verified',
        'verified_by',
        'note',
    ];

    public function psycholog()
    {
        return $this->belongsTo(Psycholog::class, 'psycholog_id');
    }

    public function verified_by()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
