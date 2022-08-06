<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orientations extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_exam',
        'level_exam',
        'link_exam',
        'e_n_s_a_id'
    ];
}
