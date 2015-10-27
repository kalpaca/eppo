<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosisSecondaryCategory extends Model
{
    protected $fillable = ['name','diagnosis_primary_category_id'];

    public function primaryCat()
    {
        return $this->belongsTo('App\DiagnosisPrimaryCategory','diagnosis_primary_category_id');
    }
    public function diagnoses()
    {
        return $this->hasMany('App\Diagnosis');
    }
}
