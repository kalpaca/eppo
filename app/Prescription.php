<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function patient()
	{
    	return $this->belongsTo('App\Patient');
	}
    public function author()
	{
    	return $this->belongsTo('App\User');
	}
   	public function regimen()
	{
    	return $this->belongsTo('App\Regimen');
	}
    public function diagnosis()
	{
    	return $this->belongsTo('App\Diagnosis');
	}
	public function items()
	{
    	return $this->hasMany('App\PrescriptionItem');
	}
	public function doseModificationReasons()
	{
		return $this->hasMany('App\DoseModificationReason');
	}
	public function operationRecords()
	{
		return $this->hasMany('App\PrescriptionOperationRecord');
	}
}
