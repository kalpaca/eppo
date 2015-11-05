<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Ppo extends Model
{
    protected $fillable = ['name','regimen_id','version','is_active','is_start_date','is_cycle','is_dose_reason','user_id'];

    public function author()
	{
    	return $this->belongsTo('eppo\User','user_id')->select(['id','name']);
	}
   	public function regimen()
	{
    	return $this->belongsTo('eppo\Regimen')->select(['id','name','code']);
	}
    public function diagnoses()
	{
    	return $this->belongsToMany('eppo\Diagnosis','ppo_diagnoses','ppo_id','diagnosis_id')->select(['diagnosis_id','name','diagnoses.id','diagnosis_secondary_category_id']);
	}
	public function ppoItems()
	{
    	return $this->hasMany('eppo\PpoItem');
	}
	public function reasons()
	{
		return $this->belongsToMany('eppo\DoseModificationReason','ppo_dose_modification_reasons')->select(['dose_modification_reasons.id','dose_modification_reason_id','name']);
	}

}
