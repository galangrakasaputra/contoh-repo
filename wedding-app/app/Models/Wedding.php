<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'data',

        'groom_name',
        'groom_nickname',

        'bride_name',
        'bride_nickname',

        'groom_father',
        'groom_mother',

        'bride_father',
        'bride_mother',

        'message',

        // acara
        'akad_date',
        'akad_start_time',
        'akad_end_time',
        'akad_address',
        'akad_maps_url',

        'reception_date',
        'reception_start_time',
        'reception_end_time',
        'reception_address',
        'reception_maps_url',

        // pembayaran
        'bank_name',
        'account_number',
        'account_name',
        'account_number_alt',
        'account_name_alt',

        'background_type',
        'background_value',

        'status',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    /**
     * User pemilik undangan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Template yang digunakan
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function rsvps()
    {
        return $this->hasMany(WeddingRsvp::class);
    }
}
