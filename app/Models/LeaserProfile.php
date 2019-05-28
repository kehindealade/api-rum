<?php

namespace Rumi\Models;


use Illuminate\Database\Eloquent\Model;

class LeaserProfile extends Model
{
    public function leaser(){
      return $this->belongsTo('Rumi\Models\Leaser', 'leaser_id');
    }
}
