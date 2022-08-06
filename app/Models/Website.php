<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_long_introduction',
        'long_description',
        'short_description',
        'email',
        'logo',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'linkedin_link',
        'youtube_link',
    ];

    public function phones() {
        return $this->belongsToMany("App\Models\Phone", "phones_websites", "website_id", "phone_id");
    }
}