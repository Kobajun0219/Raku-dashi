<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
        public function box(){
          
        return $this->belongsTo('App\Box');
        } 
}