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
}
