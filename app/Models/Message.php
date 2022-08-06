<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    protected $fillable = [
        'content',
        'sender_firstName',
        'sender_lastName',
        'email',
        'sender_type',
        'date_time_sent',
    ];
}
