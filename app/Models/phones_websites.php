<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phones_websites extends Model
{
    use HasFactory;

    protected $fillable = ['phone_id', 'website_id'];

    public function website()
    {
        return $this->belongsToMany(
                Website::class,
                'phones_websites',
                'phone_id',
                'website_id');
    }
}
