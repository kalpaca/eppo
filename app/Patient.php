<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['fullname','dob','user_id'];

    public function prescriptions()
    {
        return $this->hasMany('eppo\Prescription')->select(['is_void','is_final','patient_id','id','diagnosis_id','regimen_id','user_id','created_at','updated_at']);
    }
}
