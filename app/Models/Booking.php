<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'event_name', 
        'event_date', 
        'event_time', 
        'event_location', 
        'guest_count', 
        'special_requests', 
        'status',
        'price',
        'payment_proof',
        'payment_status',
        'midtrans_snap_token',
        'midtrans_transaction_id',
        'payment_method',
        'refund_status',
        'refund_reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(BookingMessage::class);
    }
}
