<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_specialty',
        'e_n_s_a_id',
    ];

    public function ensa() {
        return $this->belongsTo('App\Models\ENSA', "e_n_s_a_id");
    }

    public function cycle() {
        return $this->hasMany('App\Models\Cycle');
    }

}
