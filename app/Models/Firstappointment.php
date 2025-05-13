<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firstappointment extends Model
{
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
