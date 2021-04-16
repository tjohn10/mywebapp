<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    public function job(): BelongsTo
    {
        return $this->belongsTo('App\Job');
    }

    /**
     * Get the user that made the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
