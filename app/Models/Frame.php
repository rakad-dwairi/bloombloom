<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'stock',
    ];

    public function price()
    {
        return $this->hasOne(Price::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}