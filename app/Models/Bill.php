<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    function payment()
    {
        return $this->hasOne(Payment::class, 'bill_id');
    }
    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    function booking()
    {
        return $this->belongsTo(Booking::class, 'service_id');
    }
    function facility()
    {
        return $this->belongsTo(Facility::class, 'service_id');
    }
}
