<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BoothHall extends Model
{
    protected $fillable = ['code', 'label', 'description', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function types(): HasMany
    {
        return $this->hasMany(BoothType::class, 'hall_id')->orderBy('sort_order');
    }

    public function activeTypes(): HasMany
    {
        return $this->hasMany(BoothType::class, 'hall_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }
}
