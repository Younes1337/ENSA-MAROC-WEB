<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'type'];

    public function ensa() {
        return $this->belongsTo('App\Models\ENSA', "e_n_s_a_id");
    }
}
