<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosingSchedule extends Model
{
	public function Ppo()
	{
    	return $this->belongsTo('App\Ppo');
	}
}
