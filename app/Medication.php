<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    public function dosingSchedules()
	{
    	return $this->hasMany('App\DosingSchedule');
	}
}
