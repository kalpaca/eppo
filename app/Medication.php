<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
        'name','instruction'
    ];
    public function dosingSchedules()
	{
    	return $this->hasMany('eppo\PpoItem');
	}
}
