<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['tag_name'];

    public function boxes()
    {
        return $this->belongsToMany('App\Box', 'box_tags');
    }
}
