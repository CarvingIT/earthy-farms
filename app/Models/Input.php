<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Input extends Model
{
    protected $fillable = ['name', 'unit'];

    public function supplies(): HasMany
    {
        return $this->hasMany(Supply::class);
    }
}
