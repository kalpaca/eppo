<?php

namespace eppo;

use Illuminate\Database\Eloquent\Model;

class Lucode extends Model
{
    protected $fillable = ['description','code','medication_id'];

    public function medication()
    {
        return $this->belongsTo('eppo\Medication')->select(['id','description']);
    }

    public function getDetailAttribute()
    {
        return $this->attributes['code'] .' '. $this->attributes['description'];
    }
}
