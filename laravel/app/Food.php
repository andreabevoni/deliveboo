<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Food extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'price', 'description', 'visible', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(['quantity']);
    }
}
