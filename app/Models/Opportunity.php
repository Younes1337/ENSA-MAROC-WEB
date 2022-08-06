<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;
    protected $fillable = [
        "city",
        "type",
        "country",
        "description",
        "typeO",
        "title"
    ];

    public function scopeSearchCity($query, $city)
    {
        if ($city) $query->where('city', $city);
    }

    public function scopeSearchContract($query, $contract)
    {
        if ($contract) $query->where('type', $contract);
    }

    public function scopeSearchTitle($query, $title)
    {
        if ($title) $query->where('type', 'like', "%$title%");
    }

    public function scopeSearchDate($query, $date)
    {
        if ($date) $query->whereDate('created_at', $date);
    }

}
