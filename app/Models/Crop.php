<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Crop extends Model
{
    protected $fillable = ['plot_id', 'name', 'variety', 'sowing_date', 'harvest_date'];

    public function plot(): BelongsTo
    {
        return $this->belongsTo(Plot::class);
    }

    public function supplies(): HasMany
    {
        return $this->hasMany(Supply::class);
    }

    public function soilReports(): HasMany
    {
        return $this->hasMany(SoilReport::class);
    }

    public function observations(): HasMany
    {
        return $this->hasMany(Observation::class);
    }
}
