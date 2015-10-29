<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Regimen extends Model
{
    protected $fillable = [
        'name','code'
    ];
	public function Ppos()
	{
    	return $this->hasMany('eppo\Ppo');
	}
}
