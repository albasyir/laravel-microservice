<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $fillable = [
        'profile_id',
        'identity_id',
        'identity_photo',
        'address',
        'acks',
    ];

    protected $casts = [
        'profile_id' => 'integer',
        'acks' => 'array',
    ];

    protected $attributes = [
        'acks' => '[]',
    ];
}
