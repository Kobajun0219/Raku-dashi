<?php

namespace App\Http\Controllers;

use App\Box;
use App\Comment;
use App\Tag;
use App\Box_tag;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Jobs\LikeJob;

class UserController extends Controller
{
    //表示
    public function mypage(){
        $boxes = Box::withCount('likes')->where('u_id',auth()->id())->orderBy('created_at', 'asc')->get();
        
        return view('mypage', ['boxes' => $boxes]);
    }
    
    
    //削除
    public function destroy(Box $box){
        
        $box->delete();       
        return redirect('mypage'); 
    }
    
}
