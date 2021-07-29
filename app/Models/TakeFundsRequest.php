<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakeFundsRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'bank_account',

    ];

    protected $table ="take_funds_requests";

    public function donation()
    {
        return $this->hasOne(User::class, 'id', 'donation_id');
    }
}
