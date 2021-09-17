<?php

namespace App\Http\Controllers;

use App\Box;
use App\Comment;
use App\Tag;
use App\Box_tag;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Jobs\LikeJob;
use Config;

class UserController extends Controller
{
    //表示
    public function mypage(){
        $boxes = Box::withCount('likes')->where('u_id',auth()->id())->orderBy('created_at', 'asc')->get();
        
        return view('mypage', ['boxes' => $boxes]);
    }
    
    //編集画面
    public function edit($id){
        $box = Box::find($id);
        // dd($box);
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
            return redirect('/post')
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
         
        $boxes->place_name = $request->place_name;
        $boxes->message = $request->message;
        $boxes->url = $request->url;
        $boxes->address = $request->address;
        $boxes->box_latitude = $request->ido;
        $boxes->box_longitude = $request->keido;
        $boxes->save(); 
        $boxes->tags()->syncWithoutDetaching($tags_id);// 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
        return view('endedit');
    }
    
    
    //削除
    public function destroy(Box $box){
        
        $box->delete();       
        return redirect('mypage'); 
    }
    
}
