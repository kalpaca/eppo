<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
    'ppo_id',
    'patient_id',
    'regimen_id',
    'cycle_id',
    'user_id',
    'diagnosis_id',
    'is_instruction_input',
    'is_start_date',
    'start_date',
    'final_date',
    'is_bsa',
    'height',
    'weight',
    'bsa',
    'is_allergies',
    'is_allergies_unknown',
    'allergies',
    'is_dose_reason',
    'other_dose_modification_reason',
    'is_final',
    'is_cycle',
    'cycle_days',
    ];
    public function patient()
	{
    	return $this->belongsTo('eppo\Patient')->select(['id','name']);
	}
    public function author()
    {
        return $this->belongsTo('eppo\User','user_id')->select(['id','name']);
    }
   	public function regimen()
	{
    	return $this->belongsTo('eppo\Regimen')->select(['id','code','name']);
	}
    public function diagnosis()
	{
    	return $this->belongsTo('eppo\Diagnosis')->select(['id','name']);
	}
    public function ppo()
    {
        return $this->belongsTo('eppo\Ppo');
    }
	public function prescriptionItems()
	{
    	return $this->hasMany('eppo\PrescriptionItem');
	}
    public function reasons()
    {
        return $this->belongsToMany('eppo\DoseModificationReason','prescription_dose_modification_reasons');
    }
	public function operationRecords()
	{
		return $this->hasMany('eppo\PrescriptionOperationRecord');
	}
}
