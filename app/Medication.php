<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
        'name','instruction'
    ];
    public function dosingSchedules()
	{
    	return $this->hasMany('App\DosingSchedule');
	}
}
