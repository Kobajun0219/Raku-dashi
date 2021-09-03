<?php

namespace App;

use App\Like;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
      public function comments(){
          
        return $this->hasMany('App\Comment');
      }
      
      public function tags(){
        
        return $this->belongsToMany('App\Tag', 'box_tags');
      }
      
      public function likes(){
          
        return $this->hasMany('App\Like');
      }
      
      //後でViewで使う、いいねされているかを判定するメソッド。
      public function isLikedBy($user): bool {
        return Like::where('u_id', $user->id)->where('box_id', $this->id)->first() !==null;
      }
      
      // protected $appends = ['distance']; 
      
      
      // public function getDistanceAttribute(){
              
      //   $my_lat=35.663788;
      //   $my_long=139.693898;
      //   $result= 6371 *acos(cos(deg2rad($my_lat))* 
      //   cos(deg2rad($this->box_latitude))* cos(deg2rad($this->box_longitude)
      //   - deg2rad($my_long))+ sin(deg2rad($my_lat))* sin(deg2rad($this->box_latitude)));
    
      //   return $result;
      // }
      
      
      
      
      public function get_distance($my_lat,$my_long)
      {
        $result= 6371 *acos(cos(deg2rad($my_lat))* 
        cos(deg2rad($this->box_latitude))* cos(deg2rad($this->box_longitude)
        - deg2rad($my_long))+ sin(deg2rad($my_lat))* sin(deg2rad($this->box_latitude)));
    
        return round($result, 2);
      }
    
    
    //       public function distance($box_lat,$box_long){
    //         $my_lat=35.663788;
    //         $my_long=139.693898;
    //         $result= 6371 *acos(cos(deg2rad($my_lat))* 
    //         cos(deg2rad($box_lat))* cos(deg2rad($box_long)
    //         - deg2rad($my_long))+ sin(deg2rad($my_lat))* sin(deg2rad($box_lat)));
        
    //         return $result;
    // }
    
    
}
