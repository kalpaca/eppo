<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class DiagnosisSecondaryCategory extends Model
{
    protected $fillable = ['name','diagnosis_primary_category_id'];

    public function primaryCat()
    {
        return $this->belongsTo('eppo\DiagnosisPrimaryCategory','diagnosis_primary_category_id')->select(['id','name']);
    }
    public function diagnoses()
    {
        return $this->hasMany('eppo\Diagnosis')->select(['id','name']);
    }
}
