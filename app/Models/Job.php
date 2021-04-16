<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $fillable = [
        'billing_mail',
        'billing_name',
        'billing_address',
        'billing_city',
        'billing_country',
        'billing_postalcode',
        'billing_phone',
        'billing_name_on_card',
        'billing_subtotal',
        'billing_discount',
        'billing_total',
        'error'
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany('App/Review');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo('App/User');
    }

    public function services(): BelongsToMany{
        return $this->belongsToMany('App\Service')->withPivot('quantity');
    }
}
