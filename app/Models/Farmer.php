<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farmer extends Model
{
    protected $fillable = ['name', 'location', 'address'];

    public function plots(): HasMany
    {
        return $this->hasMany(Plot::class);
    }
}
