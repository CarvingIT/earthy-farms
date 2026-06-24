<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plot extends Model
{
    //
    public function crops(): HasMany
    {
        return $this->hasMany(Crop::class);
    }
}
