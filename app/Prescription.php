<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function patient()
	{
    	return $this->belongsTo('eppo\Patient');
	}
    public function author()
	{
    	return $this->belongsTo('eppo\User');
	}
   	public function regimen()
	{
    	return $this->belongsTo('eppo\Regimen');
	}
    public function diagnosis()
	{
    	return $this->belongsTo('eppo\Diagnosis');
	}
	public function items()
	{
    	return $this->hasMany('eppo\PrescriptionItem');
	}
	public function doseModificationReasons()
	{
		return $this->hasMany('eppo\DoseModificationReason');
	}
	public function operationRecords()
	{
		return $this->hasMany('eppo\PrescriptionOperationRecord');
	}
}
