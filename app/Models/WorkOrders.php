<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrders extends Model
{
    protected $fillable = [
        'name',
        'delivery_date',
        'payment_option',
        'order_status'
    ];

    public function user() {
        return $this->belongsTo(Users::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
