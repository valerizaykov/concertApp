<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $casts = [
        'eventDate' => 'date:d-m-Y'
    ];

    public function UserBand()
    {
        return $this->belongsTo(userBand::class);
    }

}
