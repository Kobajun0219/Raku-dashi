<!-- resources/views/index.blade.php -->
@extends('layouts.app')
@section('content')

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->
    
    <!-- 投稿後に表示-->
    @include('common.com')
    <!-- 投稿後に表示-->


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
    <input type="text" id="address" value="{{old('address')}}" class="form-control" placeholder="住所で検索">
    <button class="btn btn-outline-secondary"value="検索" id="button"><i class="fas fa-search-location"></i></button>
    </div>
    
    <div class="pl-2 pr-2 pb-2">
    <form action="{{ url('myloc') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="my_lat" id="table_lat">
    <input type="hidden" name="my_lon" id="table_lon">
    <button type="submit" id="submit" class="btn" style="background-color:#FCE38A;">現在地から探す</button>
    </form>
    </div>
    
      <!--地図が入る-->
      <div id="mapDiv" style="height:400px; width:95%; margin:auto;"></div>
      <!--地図の中に画像を表示させるのに必要-->
      <!--<img id="getImg" src="" hidden>-->
      <canvas id="cap" width="300" height="60" style="display:none;"></canvas>
    
    <div class="pl-2 pr-2 pb-3 mb-2">
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
                           <a style="text-decoration:none;" target="_blank" class="font-weight-bold" onclick="eventPanto({{ $box }})">{{$box->place_name}}</a>
                        </td>
                               
                        <!--tag表示-->
                        <td nowrap style="width:35%">
                            <div style="display:flex; flex-wrap: wrap;">
                            @foreach ($box->tags as $tag)<div class="btn btn-outline-warning text-body font-weight-bold btn-sm pl-1 pr-1" style="font-size: 7px;">{{$tag->tag_name}}</div>
                            @endforeach
                            </div>
                        </td>

                        <!--詳細ボタン-->
                        <td class="align-middle">
                            <div>
                                
                              <div style="text-align:center;">
                              <button type="button" class="btn pr-1 pl-1 pb-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{$box->id}}" id="detail{{$box->id}}" style="background-color:#FCE38A;">
                              <i class="far fa-comment-alt fa-2x"></i>
                              </button>
                              </div>
                              
                              <!--modal中身-->
                              @include('modal.detail')
                                  
                                <!--いいね機能-->
                                <div style="text-align:center;"> 
                                @auth
                                    @if (!$box->isLikedBy(Auth::user()))
                                            <span class="likes">
                                                <i class="fas fa-heart like-toggle" data-review-id="{{ $box->id }}"></i>
                                                <span class="like-counter">{{$box->likes_count}}</span>
                                            </span><!-- /.likes -->
                                    @else
                                            <span class="likes">
                                                <i class="fas fa-heart heart like-toggle liked" data-review-id="{{ $box->id }}"></i>
                                                <span class="like-counter">{{$box->likes_count}}</span>
                                            </span><!-- /.likes -->
                                    @endif
                                @endauth
                                    @guest
                                      <span class="likes">
                                          <i class="fas fa-heart heart"></i>
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
    
<!--jsにでーたおくるためのものです消さないでください！-->
<!--<div style="display:none;"></div>-->

<!--下記スクリプトタグはｊｓに必要なデータを送る処理-->
<script>
let toukou = @json($boxes);
let my_lat = '{{$my_lat}}';
let my_long = '{{$my_long}}';
</script>

<!--google map api 読み込み-->
<script src="https://maps.googleapis.com/maps/api/js?key={{config('app.api')}}&libraries=geometry"></script>
<script src="{{ asset('js/result.js') }}"></script>

<!--like機能用のJS-->
<script src="{{ asset('js/like.js') }}"></script>

@endsection
