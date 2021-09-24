<?php

namespace App\Http\Controllers;


use App\Box;
use App\Comment;
use App\Tag;
use App\Box_tag;
use App\Like;
use App\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Jobs\LikeJob;
use Config;

class MainController extends Controller
{
    
    
    //一覧画面
    public function index(Request $request){
        $boxes = Box::withCount('likes')->orderBy('created_at', 'asc')->get();
        $my_lat = NULL;
        $my_long = NULL;
        $com = $request->old();
       return view('index', ['boxes' => $boxes, 'my_lat'=> $my_lat, 'my_long'=>$my_long, 'com'=>$com]);
    
    }
    
    //投稿画面遷移
    public function post(){
        return view('post');
    }
    
    //コメント投稿
    public function comment(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:255',
        ]);
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        $comment = new Comment;
        
        //画像投稿
        if($fileName = $request->file_name){
        //保存するファイルに名前をつける
          $path = Storage::disk('s3')->putFile('/demo', $fileName, 'public');
          $comment->file_name = Storage::disk('s3')->url($path);
         }else{
        //画像が登録されなかった時はから文字をいれる
          $fileName = "";
          $comment->file_name = $fileName;
         }
        
        $comment->comment = $request->comment;
        $comment->u_id = auth()->id();
        $comment->box_id = $request->box_id;
        $comment->save(); 
        
        //point
        $point = new Point;
        $point->u_id = auth()->id();
        $point->point = "10";
        $point->save(); 
        
        //redirect先でcom.bladeを表示させるために配列を作成
        $com = ["コメント投稿が"];
        return redirect('/')->withInput($com);
    }
    
    
    //Box投稿
    public function store(Request $request){
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
        // 投稿にタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
        
        $boxes = new Box;

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
        $boxes->u_id = auth()->id();
        $boxes->save(); 
        $boxes->tags()->attach($tags_id);// 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
        
        //point
        $point = new Point;
        $point->u_id = auth()->id();
        $point->point = "20";
        $point->save(); 
        
        //redirect先でcom.bladeを表示させるために配列を作成
        $com = ["Boxの設置が"];
        return redirect('/')->withInput($com);
    }
    
    //現在地から
    public function myloc(Request $request){

        $boxes = Box::withCount('likes')->orderBy('created_at', 'asc')->get();
        
            $my_lat=$request->my_lat;
            $my_long=$request->my_lon;        

        $boxes->map(function($item,$key) use ($my_lat,$my_long){

            $item['distance'] .= $item->get_distance($my_lat,$my_long);
            return $item;

            });
        
        $boxes = $boxes->sortBy('distance')->values();
        
        return view('index', ['boxes' => $boxes, 'my_lat'=> $my_lat, 'my_long'=>$my_long]);
    }
    
    
    //チュートリアル
    public function tutorial(){
        return view('suspend');
    }
    

    //非同期テスト
    public function job(Request $request)
    {
        $rules = [
            'name' => 'required|max:10',
            'email' => 'required|email',
            'message' => 'required|max:1000',
        ];
 
        $messages = [
            'name.required' => '名前を入力して下さい。',
            'name.max' => '名前は10文字以下で入力して下さい。',
            'email.required' => 'メールアドレスを入力して下さい。',
            'email.email' => '正しいメールアドレスを入力して下さい。',
            'message.required' => 'メッセージを入力して下さい。',
            'message.max' => 'メッセージは1000文字以下で入力して下さい。',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if ($validator->fails()) {
            return redirect('/contact')
                ->withErrors($validator)
                ->withInput();
        }
 
        $data = $validator->validate();
 
        LikeJob::dispatch($data);
 
        session()->flash('success', '送信いたしました！');
        return back();
    }
    
    public function aa(){
        
        return view('test');
    
    }
}
