<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MadaCard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'card_number',
        'cvv',
        'expiry_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
