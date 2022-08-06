<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'city',
        'tags',
        'image',
        'start_at',
        'end_at',
    ];

    public function getLocationAttribute(){
        $id =  $this->attributes['id'];
        $wkt = DB::table('events')->find($id, array(DB::raw('ST_AsText(location) AS location')));
        $location = $wkt->location;
        return $location;
    }

    public function ensa() {
        return $this->belongsTo('App\Models\ENSA', "e_n_s_a_id");
    }
}
