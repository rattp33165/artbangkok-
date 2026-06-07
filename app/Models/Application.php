<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id', 'status', 'completion_percent',
        'gallery_type', 'gallery_name', 'year_founded', 'description',
        'website_url', 'gallery_email', 'phone', 'instagram', 'facebook',
        'gallery_images', 'business_name', 'business_license',
        'office_country', 'office_city', 'office_zipcode', 'office_address',
        'head_office_gallery_name',
        'director_name', 'director_phone', 'director_email',
        'branches', 'represented_artists', 'booth_section', 'booth_hall', 'booth_type',
        'booth_rate_standard', 'booth_rate_special',
        'participating_artists', 'exhibitions',
        'persons_in_charge', 'art_fairs',
    ];

    protected $casts = [
        'branches'              => 'array',
        'represented_artists'   => 'array',
        'persons_in_charge'     => 'array',
        'art_fairs'             => 'array',
        'gallery_images'        => 'array',
        'participating_artists' => 'array',
        'exhibitions'           => 'array',
    ];
}
