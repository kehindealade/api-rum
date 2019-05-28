<?php

namespace Rumi\Models;


use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    public function leaser(){
    	return $this->belongsTo('Rumi\Models\Leaser', 'leasers_id');
    }

    public function newRoomBookOrder(){
    	return $this->hasMany('Rumi\Models\NewRoomBookOrder');
    }
}
