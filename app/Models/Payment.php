<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donation_id',
        'paypal_payment_id',
        'amount',
        'status',
        
    ];

    protected $table ="payments";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'id', 'donation_id');
    }
}
