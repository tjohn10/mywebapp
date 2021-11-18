<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
      'name',
        'service',
      'delivery_date',
      'payment_option',
      'order_status'
    ];

    public function customer() {
        return $this->belongsTo(Customers::class);
    }

//    public function service() {
//        return $this->belongsTo(Service::class);
//    }
}
