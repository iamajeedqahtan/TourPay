<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'bank_id',
        'nfc_tag',
        'contact_email',
        'contact_phone',
        'location',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
