<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['name','dob'];

    public function prescriptions()
    {
        return $this->hasMany('eppo\Prescription');
    }
}
