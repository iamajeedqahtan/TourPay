<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'iban',
        'pool_account_balance',
        'settlement_cycle',
    ];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
