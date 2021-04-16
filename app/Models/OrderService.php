<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    protected $table= 'order_service';

    protected $fillable = ['job_id', 'service_id', 'quantity'];
}
