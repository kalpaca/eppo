<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'name','diagnosis_secondary_category_id',
    ];

    public function secondaryCat()
    {
        return $this->belongsTo('eppo\DiagnosisSecondaryCategory','diagnosis_secondary_category_id')->select('name','id','diagnosis_primary_category_id');
    }
}
