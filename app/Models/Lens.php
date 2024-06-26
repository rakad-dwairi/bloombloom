<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lens extends Model
{
    use HasFactory;

    protected $fillable = [
        'colour',
        'description',
        'prescription_type',
        'lens_type',
        'stock',
        'currency',
        'price'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}