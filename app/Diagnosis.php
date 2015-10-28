<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'name','diagnosis_secondary_category_id',
    ];

    public function secondaryCat()
    {
        return $this->belongsTo('App\DiagnosisSecondaryCategory','diagnosis_secondary_category_id');
    }

    public function primaryCat()
    {
        $secondaryCat = $this->secondaryCat;
        return $secondaryCat->primaryCat();
        //return $secondaryCat->belongsTo('App\DiagnosisPrimaryCategory','diagnosis_primary_category_id');
    }
}
