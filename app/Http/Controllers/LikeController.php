<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Box;
use App\Like;

use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    
    
    public function like(Request $request){
        $u_id = Auth::user()->id; //1.ログインユーザーのid取得
        $box_id = $request->review_id; //2.投稿idの取得
        $already_liked = Like::where('u_id', $u_id)->where('box_id', $box_id)->first(); //3.
        
        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->box_id = $box_id; //Likeインスタンスにreview_id,user_idをセット
            $like->u_id = $u_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('box_id', $box_id)->where('u_id', $u_id)->delete();
        }

        //5.この投稿の最新の総いいね数を取得
        $review_likes_count = Box::withCount('likes')->findOrFail($box_id)->likes_count;
        $param = [
            'review_likes_count' => $review_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }
}
