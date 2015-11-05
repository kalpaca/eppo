<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Ppo extends Model
{
    protected $fillable = ['name','regimen_id','version','is_active','is_start_date','is_cycle','is_dose_reason','user_id'];

    public function author()
	{
    	return $this->belongsTo('eppo\User','user_id');
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
	public function reasons()
	{
		return $this->belongsToMany('eppo\DoseModificationReason','ppo_dose_modification_reasons');
	}

}
