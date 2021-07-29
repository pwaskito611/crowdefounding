<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'title',
        'description',
        'photo_path',
        'status',
        'collected',
        'target',
        
    ];

    protected $table ="donation";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public function comments()
    {
        return $this->hasMany(Payment::class, 'donation_id', 'id');
    }

    public function takeFunds() 
    {
        return $this->hasOne(TakeFundsRequest::class, 'donation_id', 'id');
    }
}
