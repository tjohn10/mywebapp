<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedOrder extends Model
{
    protected $fillable = [
        'assigned_by',
        'assigned_to',
        'completed_at'
    ];

    public function order() {
        return $this->belongsTo(Orders::class);
    }

    public function user() {
        return $this->belongsTo(Users::class);
    }
}
