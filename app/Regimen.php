<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regimen extends Model
{
    protected $fillable = [
        'name','code'
    ];
	public function Ppos()
	{
    	return $this->hasMany('App\Ppo');
	}
}
