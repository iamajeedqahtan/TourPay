<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'card_number',
        'expiry_date',
        'cardholder_name',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
