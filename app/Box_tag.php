<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box_tag extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['box_id', 'tag_id'];
}
