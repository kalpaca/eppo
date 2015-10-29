<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ppo extends Model
{
    protected $fillable = ['regimen_id','version','is_active','is_start_date','is_cycle','is_dose_reason'];
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
    	return $this->belongsToMany('App\Diagnosis','ppo_diagnoses','ppo_id','diagnosis_id');
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
