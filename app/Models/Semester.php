<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['title_semester', 'cycle_id'];

    public function modules() {
        return $this->hasMany('App\Models\Module');
    }

    public function cycle() {
        return $this->belongsTo('App\Models\Cycle', "cycle_id");
    }
}
