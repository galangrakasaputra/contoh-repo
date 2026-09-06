<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingRsvp extends Model
{
    protected $fillable = [
        'wedding_id',
        'name',
        'attendance',
        'message',
    ];

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
