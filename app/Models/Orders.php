<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
      'id',
      'name',
      'phone',
      'address',
      'delivery_date',
      'payment_option',
        'service_delivery_type',
        'order_status'
    ];
}
