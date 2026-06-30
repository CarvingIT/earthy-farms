<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Observation extends Model
{
    protected $fillable = ['crop_id', 'observation_date', 'observation'];

    public function crop(): BelongsTo
    {
        return $this->belongsTo(Crop::class);
    }
}
