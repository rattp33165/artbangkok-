<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BoothType extends Model
{
    protected $fillable = [
        'hall_id', 'type_code', 'label', 'dimensions', 'sqm', 'qty',
        'note', 'group_key', 'group_label', 'rate_standard', 'rate_special',
        'sort_order', 'is_active',
    ];

    protected $casts = [
        'sqm'      => 'float',
        'is_active' => 'boolean',
    ];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(BoothHall::class, 'hall_id');
    }
}
