<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ppo extends Model
{
    public function author()
	{
    	return $this->belongsTo('App\User');
	}
   	public function regimen()
	{
    	return $this->belongsTo('App\Regimen');
	}
    public function diagnoses()
	{
    	return $this->hasMany('App\Diagnosis');
	}
	public function dosingSchedules()
	{
    	return $this->hasMany('App\DosingSchedule');
	}
    public function ppoSections()
	{
    	return $this->hasMany('App\PpoSection');
	}
	public function doseModificationReasons()
	{
		return $this->hasMany('App\DoseModificationReason');
	}
}
