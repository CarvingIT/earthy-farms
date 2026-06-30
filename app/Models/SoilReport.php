<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoilReport extends Model
{
    protected $fillable = [
        'crop_id',
        'sample_date',
        'Ph',
        'EC',
        'OC',
        'N',
        'P',
        'K',
        'Boron',
        'Fe',
        'Zn',
        'Cu',
        'Mg',
        'S',
        'microbial_count'
    ];

    public function crop(): BelongsTo
    {
        return $this->belongsTo(Crop::class);
    }
}
