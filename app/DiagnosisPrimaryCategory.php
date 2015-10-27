<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosisPrimaryCategory extends Model
{
    protected $fillable = ['name'];

    public function secondaryCats()
    {
        return $this->hasMany('App\DiagnosisSecondaryCategory');
    }
    public function diagnoses()
    {
        return $this->hasMany('App\Diagnosis');
    }
}
