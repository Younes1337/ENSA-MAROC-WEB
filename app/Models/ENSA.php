<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ENSA extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'logo' ,
        'cover_picture' ,
        'intro' ,
        'city',
        'type' ,
        'website' ,
        'address' ,
        'campus' ,
        'restaurants' ,
        'carte' ,
        'initial_education' ,
        'continuing_education' ,
        'cooperation' ,
        'published'
    ];


    public function clubs() {
        return $this->hasMany('App\Models\Club');
    }

    public function news() {
        return $this->hasMany('App\Models\News');
    }

    public function events() {
        return $this->hasMany('App\Models\Event');
    }

    public function phones() {
        return $this->belongsToMany("App\Models\Phone", "phones_ensas", "e_n_s_a_id", "phone_id");
    }

    public function cycles() {
        return $this->belongsToMany("App\Models\Cycle", "cycle_bellongs_tos", "e_n_s_a_id", "id_cycle");
    }

    public function images() {
        return $this->hasMany('App\Models\Image');
    }

    public function emails() {
        return $this->hasMany('App\Models\Email');
    }
}
