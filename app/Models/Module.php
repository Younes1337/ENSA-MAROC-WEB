<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        "title_module", "module_description", 'id_semester'
    ];

    public function elements() {
        return $this->hasMany('App\Models\Element');
    }

    public function documents() {
        return $this->hasMany('App\Models\Document');
    }

    public function semester() {
        return $this->belongsTo('App\Models\Semester', "id_semester");
    }
}
