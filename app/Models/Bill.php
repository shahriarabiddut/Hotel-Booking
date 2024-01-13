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
}
