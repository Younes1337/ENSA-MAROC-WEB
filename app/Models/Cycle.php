<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    protected $fillable = ['title_cycle', 'e_n_s_a_id', 'speciality_id'];

    public function semesters() {
        return $this->hasMany('App\Models\Semester');
    }

    public function speciality() {
        return $this->hasMany('App\Models\Speciality', 'id');
    }

}
