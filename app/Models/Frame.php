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
        'currency',
        'price'
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}