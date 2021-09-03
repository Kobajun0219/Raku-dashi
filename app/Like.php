<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;
    
        public function user()
    {   //usersテーブルとのリレーションを定義するuserメソッド
        return $this->belongsTo(User::class);
    }

    public function box()
    {   //boxテーブルとのリレーションを定義するboxメソッド
        return $this->belongsTo(Box::class);
    }
}
