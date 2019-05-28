<?php

namespace Rumi\Models;

use Illuminate\Database\Eloquent\Model;

class NewRoomerHostelOrder extends Model
{
   public function roomerhostel(){
       return $this->belongsTo('Rumi\Models\RoomerHostel', 'roomer_hostel_id');
   }

   public function roomer(){
    return $this->belongsTo('Rumi\Models\Roomer', 'roomer_id');
}
}
