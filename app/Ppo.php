<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Ppo extends Model
{
    protected $fillable = ['name','regimen_id','version','is_active','is_start_date','is_cycle','is_dose_reason'];

    public function author()
	{
    	return $this->belongsTo('eppo\User');
	}
   	public function regimen()
	{
    	return $this->belongsTo('eppo\Regimen');
	}
    public function diagnoses()
	{
    	return $this->belongsToMany('eppo\Diagnosis','ppo_diagnoses','ppo_id','diagnosis_id');
	}
	public function ppoItems()
	{
    	return $this->hasMany('eppo\PpoItem');
	}
    /*
	public function doseModificationReasons()
	{
		return $this->hasMany('eppo\DoseModificationReason');
	}
    */
}
