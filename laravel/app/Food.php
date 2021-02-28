<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
