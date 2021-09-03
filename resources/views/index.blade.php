<!-- resources/views/index.blade.php -->
@extends('layouts.app')
@section('content')

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->


  <!--<table class="table table-striped task-table">-->
  <!--  <thead>-->
  <!--    <tr>-->
  <!--      <th>順番</th>-->
  <!--      <th>ID</th>-->
  <!--      <th>店名</th>-->
  <!--      <th>現在地からの距離</th>-->
  <!--    </tr>-->
  <!--  </thead>-->
  <!--  <tbody id="data-list"></tbody>-->
  <!--</table>-->
  <style>
      .my-custom-scrollbar {
        position: relative;
        height: 300px;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
  </style>
    

    <div class="input-group pl-2 pr-2">
    <input type="text" id="address" value="{{old('address')}}" class="form-control" placeholder="住所を入力">
    <input class="btn btn-outline-secondary" type="button" value="検索" id="button">
    </div>
    
    <div class="pl-2 pr-2 pb-2">
    <form action="{{ url('myloc') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="my_lat" id="table_lat">
    <input type="hidden" name="my_lon" id="table_lon">
    <button type="submit" id="submit" class="btn" style="background-color:#FCE38A;">現在地から探す</button>
    </form>
    </div>
    
    <div class="pl-2 pr-2">
     <!-- 登録一覧 -->
    @if (count($boxes) > 0)
    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-sm">
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($boxes as $box)
                    <tr>
                        <td class="align-middle">
                          <div>
                          <i class="fas fa-map-marker-alt"></i>  
                          <div id ="distance">{{$box->distance}}km</div>
                          </div>
                        </td>
                        <td class="align-middle" style="width:30%">
                           <a href="https://www.google.com/maps/search/?api=1&query={{$box->address}}" target="_blank" class="font-weight-bold">{{$box->place_name}}</a>
                        </td>
                        <td style="width:35%">
                            <div>
                            @foreach ($box->tags as $tag) 　　　
                                <a class="btn btn-outline-warning text-body font-weight-bold align-middle">{{$tag->tag_name}}</a>
                            @endforeach
                            </div>
                        </td>

                        <!--詳細ボタン-->
                        <td class="align-middle">
                            <div>
                                
                              <div style="text-align:center;">
                              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{$box->id}}">
                              <img src="{{url('image/02.png')}}">
                              </button>
                              </div>
                              
                              <div class="modal fade" id="exampleModal{{$box->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="max-width:400px;">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModal{{$box->id}}">
                                        <a href="https://www.google.com/maps/search/?api=1&query={{$box->address}}" target="_blank"><i class="fas fa-map-marker-alt"></i></a>
                                        {{$box->place_name}}&nbsp;&nbsp;&nbsp;&nbsp;
                                        @if ($box->url == true)
                                        <button type="submit" class="btn" style="background-color:#FCE38A;"><a href="{{$box->url}}">URL</a></button>
                                        @endif
                                        </h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{url('image/raku.png')}}" style="max-width:100%;">
                                        <div>{{$box->message}}</div>
                                        <div>
                                        <!--タグを表示させるループ処理-->
                                        @foreach ($box->tags as $tag) 　　　
                                            <button class="btn btn-outline-warning text-body font-weight-bold no-gutters">{{$tag->tag_name}}</button>
                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                
                                          <!--コメント入力欄-->
                                          <form action="{{ url('comment') }}" method="POST" class="form-horizontal"> 
                                                {{ csrf_field() }}
                                                 <input type="text" name="comment" class="form-control　c_text" placeholder="コメントを入力">
                                                 <input type="hidden" name="box_id" class="form-control c_box_id" value="{{$box->id}}">
                                                 <button type="submit" class="btn" style="background-color:#FCE38A;">送信</button>
                                          </form>
                                          <!--コメント入力欄終わり-->
                                  
                                        <!--コメント一覧-->
                                        <div style="width: 100%;">
                                           @foreach ($box->comments as $comment)
                                            <div>{{$comment->comment}}</div>
                                            <div class="float-right">{{$comment->created_at}}</div>
                                        　 @endforeach
                                        </div>
                                          <!--コメント一覧終わり-->
                                    </div>
                                    </div>
                                    </div>
                                  </div>
                                  
                                <!--いいね機能-->
                                <div style="text-align:center;"> 
                                @auth
                                    @if (!$box->isLikedBy(Auth::user()))
                                            <span class="likes">
                                                <i class="fas fa-thumbs-up like-toggle" data-review-id="{{ $box->id }}"></i>
                                                <span class="like-counter">{{$box->likes_count}}</span>
                                            </span><!-- /.likes -->
                                    @else
                                            <span class="likes">
                                                <i class="fas fa-thumbs-up heart like-toggle liked" data-review-id="{{ $box->id }}"></i>
                                                <span class="like-counter">{{$box->likes_count}}</span>
                                            </span><!-- /.likes -->
                                    @endif
                                @endauth
                                    @guest
                                      <span class="likes">
                                          <i class="fas fa-thumbs-up heart"></i>
                                        <span class="like-counter">{{$box->likes_count}}</span>
                                      </span><!-- /.likes -->
                                @endguest
                            </div>
                          </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    </div>
    
    
  <!--地図が入る-->
  <div id="mapDiv" style="height:400px; width:95%; margin:auto;"></div>
  <!--地図の中に画像を表示させるのに必要-->
  <!--<img id="getImg" src="" hidden>-->
  
  
  <canvas id="cap" width="300" height="60" style="display:none;"></canvas>
    
    
<!--jsにでーたおくるためのものです消さないでください！-->
<div style="display:none;">{{$keynum = 1}}</div>

<!--下記スクリプトタグはｊｓに必要なデータを送る処理-->
<script>


let boxes = @json($boxes);
let keynum= {{$keynum}};

let my_lat = '{{$my_lat}}';
let my_long = '{{$my_long}}';

console.log(boxes);
console.log(my_lat);
console.log(my_long);
</script>



<!--地図用のJS-->
<script src="{{ asset('js/result.js') }}"></script>


<!--google map api 読み込み-->
<script src="https://maps.googleapis.com/maps/api/js?key={{config('app.api')}}&libraries=geometry"></script>
<script src="{{ asset('js/distance.js') }}"></script>
<script src="{{ asset('js/like.js') }}"></script>
<script>
    console.log(position.coords.latitude);
</script>

@endsection
