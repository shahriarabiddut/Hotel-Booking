<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    function bill()
    {
        return $this->hasOne(Bill::class, 'service_id')->where('service_type', '=', 'facility');
    }
}
