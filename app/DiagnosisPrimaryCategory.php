<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class DiagnosisPrimaryCategory extends Model
{
    protected $fillable = ['name'];

    public function secondaryCats()
    {
        return $this->hasMany('eppo\DiagnosisSecondaryCategory');
    }
    public function diagnoses()
    {
        return $this->hasMany('eppo\Diagnosis');
    }
}
