<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'date', 'total', 'email', 'name', 'lastname', 'phone_number', 'address',
    ];

    public function food()
    {
        return $this->belongsToMany(Food::class)->withPivot(['quantity']);
    }

    public function foodByUser()
    {

        return $this->belongsToMany(Food::class)->where('user_id', 1);
        // return $this->belongsToMany(Food::class)->where('user_id', $id);
    }
}
