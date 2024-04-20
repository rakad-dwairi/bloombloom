<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'frame_id',
        'lens_id',
        'currency',
        'price',
    ];

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public function lens()
    {
        return $this->belongsTo(Lens::class);
    }
}
