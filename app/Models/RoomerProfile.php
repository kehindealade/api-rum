<?php

namespace Rumi\Models;


use Illuminate\Database\Eloquent\Model;

class RoomerProfile extends Model
{
    public function roomer(){
    	return $this->belongsTo('Rumi\Models\Roomer', 'roomer_id');
    }
}
