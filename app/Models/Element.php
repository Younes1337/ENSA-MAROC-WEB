<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $fillable = ['title_element', 'module_id'];

    public function module() {
        return $this->belongsTo('App\Models\Module', "module_id");
    }

    public function documents() {
        return $this->hasMany('App\Models\Document');
    }
}
