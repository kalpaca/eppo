<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class PpoItem extends Model
{
    protected $fillable = [
    'name',
    'is_active',
    'ppo_id',
    'ppo_section_id',
    'medication_id',
    'dose_base',
    'dose_calculation_type_id',
    'fixed_dose_result',
    'dose_unit_id',
    'dose_route_id',
    'instruction',
    'is_instruction_input',
    'is_start_date',
    'is_frequency_input',
    'is_duration_input',
    'is_mitte_input',
    'is_repeat_input',
    'mitte_unit_id',
    'note_to_md',
    ];
	public function ppo()
	{
    	return $this->belongsTo('eppo\Ppo')->select(['id','name']);
	}
    public function ppoSection()
    {
        return $this->belongsTo('eppo\PpoSection')->select(['id','name']);
    }
    public function medication()
    {
        return $this->belongsTo('eppo\Medication')->select(['id','name','instruction','is_rev_aid','is_eap']);
    }
    public function doseRoute()
    {
        return $this->belongsTo('eppo\DoseRoute')->select(['id','name']);
    }
    public function doseUnit()
    {
        return $this->belongsTo('eppo\DoseUnit')->select(['id','name']);
    }
    public function mitteUnit()
    {
        return $this->belongsTo('eppo\MitteUnit')->select(['id','name']);
    }
    public function lucodes()
    {
        return $this->belongsToMany('eppo\Lucode','ppo_item_lucodes')->select(['lucodes.id','lucode_id','description','code']);
    }
    public function getDetailAttribute()
    {
        return $this->medication->name .' @ '. $this->ppo->name .' '. $this->ppoSection->name .' '. $this->attributes['dose_base'];
    }
}
