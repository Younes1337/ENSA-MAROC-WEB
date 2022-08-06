<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['doc_title', 'doc_type', 'doc_link', 'module_id', 'element_id'];

    public function module() {
        $this->belongsTo("App\Models\Module", "module_id");
    }

    public function element() {
        $this->belongsTo("App\Models\Element", "element_id");
    }
}
