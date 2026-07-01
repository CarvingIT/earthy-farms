<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supply extends Model
{
    protected $fillable = ['crop_id', 'input_id', 'quantity', 'loading_date'];

    public function crop(): BelongsTo
    {
        return $this->belongsTo(Crop::class);
    }

    public function input(): BelongsTo
    {
        return $this->belongsTo(Input::class);
    }
}
