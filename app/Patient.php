<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['name','dob'];

    public function prescriptions()
    {
        return $this->hasMany('eppo\Prescription')->select(['patient_id','id','diagnosis_id','regimen_id','user_id','author','created_at','updated_at']);
    }
}
