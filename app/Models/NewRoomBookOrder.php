<?php

namespace Rumi\Models;

use Illuminate\Database\Eloquent\Model;

class NewRoomBookOrder extends Model
{
	protected $dates = [
    'created_at',
    'updated_at',
    'book_date',
];
   public function hostel(){
   		return $this->belongsTo('Rumi\Models\Hostel', 'hostel_id');
   }

   public function roomer(){
   		return $this->belongsTo('Rumi\Models\Roomer', 'roomer_id');
   }


}
