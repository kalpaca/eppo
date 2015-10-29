<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosingSchedule extends Model
{
    protected $fillable = ['name'];
	public function Ppo()
	{
    	return $this->belongsTo('App\Ppo');
	}
}
