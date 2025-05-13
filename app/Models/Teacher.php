<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function first_appointments()
    {
        return $this->hasMany(Firstappointment::class);
    }
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
    public function uleaves()
    {
        return $this->hasMany(Uleave::class);
    }
}
