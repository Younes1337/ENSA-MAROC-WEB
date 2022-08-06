<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'e_n_s_a_id'];

    public function ensa() {
        return $this->belongsTo('App\Models\ENSA', "e_n_s_a_id");
    }
}
