<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'frame_id',
        'lens_id',
        'total_price',
        'currency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public function lens()
    {
        return $this->belongsTo(Lens::class);
    }
}