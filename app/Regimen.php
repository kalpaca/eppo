<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regimen extends Model
{
	public function Ppos()
	{
    	return $this->hasMany('App\Ppo');
	}
}
