<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookPost extends Model
{
    protected $fillable = [
        'fb_post_id', 'message', 'full_picture', 'permalink_url',
        'posted_at', 'is_visible', 'sort_order', 'synced_at',
    ];

    protected $casts = [
        'posted_at'  => 'datetime',
        'synced_at'  => 'datetime',
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function getExcerptAttribute(): string
    {
        if (!$this->message) return '';
        return mb_strlen($this->message) > 120
            ? mb_substr($this->message, 0, 120) . '...'
            : $this->message;
    }
}
