<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'size', 'type', 'e_n_s_a_id'];

    public function ensa() {
        return $this->belongsTo('App\Models\ENSA', "e_n_s_a_id");
    }
}
