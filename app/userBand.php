<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userBand extends Model
{
    protected $table = 'user_bands';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function band()
    {
        return $this->hasOne(Event::class);
    }

}
