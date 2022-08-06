<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phones_ensas extends Model
{
    use HasFactory;

    protected $fillable = ['phone_id', 'e_n_s_a_id'];

    public function ensa()
    {
        return $this->belongsToMany(
                ENSA::class,
                'phones_ensas',
                'phone_id',
                'e_n_s_a_id');
    }

}
