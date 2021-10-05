<?php

namespace App\Http\Controllers;

use App\Box;
use App\Comment;
use App\Tag;
use App\Box_tag;
use App\Like;
use App\Point;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Jobs\LikeJob;
use Config;

class UserController extends Controller
{
    //表示
    public function mypage(Request $request){
        $boxes = Box::withCount('likes')->where('u_id',auth()->id())->orderBy('created_at', 'asc')->get();
        $points = Point::where('u_id',auth()->id())->get();
        
        function count($points){
            $point_count=(int)"";
            foreach($points as $point){
            $point_count = $point_count+$point->point;
            }
            return $point_count;
        }
        $point = count($points);
        
        $com = $request->old();
        return view('mypage', ['boxes' => $boxes,'point' => $point,'com' => $com]);
    }
    
    //編集画面
    public function edit($id){
        $box = Box::find($id);
        return view('edit', ['box' => $box]);
    }
    
    
     //Box編集
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'place_name' => 'required|max:255',
            'message' => 'required|max:255',
            'ido' => 'required|max:50',
            'keido' => 'max:50',
            'address' => 'required|max:255',
        ]);
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/edit/'.$request->id)
                ->withInput()
                ->withErrors($validator);
        }
        
        //tag付けに関して
        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠 - 々 ー \']+)/u', $request->tags, $match);
        // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag_name'=>$tag]); // firstOrCreateメソッドで、tags_tableのtag_nameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record);// $recordを配列に追加します(=$tags)
        };
        
        // 投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag->id);
        };
        
        $boxes = Box::find($request->id);
        //画像投稿
        if($fileName = $request->file_name){
        //保存するファイルに名前をつける
          $path = Storage::disk('s3')->putFile('/boxdemo', $fileName, 'public');
          $boxes->file_name = Storage::disk('s3')->url($path);
         }else{
        //画像が登録されなかった時はから文字をいれる
          $fileName = "";
          $boxes->file_name = $fileName;
         }
         
        Box_tag::where("box_id", $request->id)->delete();
         
        $boxes->place_name = $request->place_name;
        $boxes->message = $request->message;
        $boxes->url = $request->url;
        $boxes->address = $request->address;
        $boxes->box_latitude = $request->ido;
        $boxes->box_longitude = $request->keido;
        $boxes->save(); 
        $boxes->tags()->syncWithoutDetaching($tags_id);
        
        //redirect先でcom.bladeを表示させるために配列を作成
        $com = ["投稿BOXの変更が"];
        return redirect('mypage')->withInput($com);
    }
    
    
    //削除
    public function destroy(Box $box){
        $box->delete();       
        
         //redirect先でcom.bladeを表示させるために配列を作成
        $com = ["削除が"];
        return redirect('mypage')->withInput($com); 
    }
    
    //プロフィール編集画面遷移
    public function change($id){
        $user = User::find($id);
        return view('edit_user', ['user' => $user]);
    }
    
    
    //プロフィール編集
    public function edit_user(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            // 'email' => 'required|emial|max:255|unique:users',
            
        ]);
    
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/change_mypage'.auth()->id())
                ->withInput()
                ->withErrors($validator);
        }
        
        $users = User::find($request->id);
        //画像投稿
        if($fileName = $request->image){
        if(strpos($request->image,'http') == false){
            //保存するファイルに名前をつける
              $path = Storage::disk('s3')->putFile('/prof', $fileName, 'public');
              $users->image = Storage::disk('s3')->url($path);
         }
        }
        $users->name = $request->name;
        // $users->email = $request->email;
        $users->save(); 
        
        //redirect先でcom.bladeを表示させるために配列を作成
            $com = ["マイページの変更が"];
        return redirect('mypage')->withInput($com);
    }
    
    

}
