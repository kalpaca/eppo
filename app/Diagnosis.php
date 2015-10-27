<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'name','diagnosis_primary_category_id','diagnosis_secondary_category_id',
    ];
    public function primaryCat()
    {
        return $this->belongsTo('App\DiagnosisPrimaryCategory','diagnosis_primary_category_id');
    }
    public function secondaryCat()
    {
        return $this->belongsTo('App\DiagnosisSecondaryCategory','diagnosis_secondary_category_id');
    }
}
