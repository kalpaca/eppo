<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Lucode extends Model
{
    protected $fillable = ['name','code','medication_id'];

    public function medication()
    {
        return $this->belongsTo('eppo\Medication')->select(['id','name']);
    }

    public function getDetailAttribute()
    {
        return $this->attributes['code'] .' '. $this->attributes['name'];
    }
}
