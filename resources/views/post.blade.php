@extends('layouts.app')
@section('content')
  <style>
      .tags-look .tagify__dropdown__item{
      display: inline-block;
      border-radius: 3px;
      padding: .3em .5em;
      border: 1px solid #CCC;
      background: #F3F3F3;
      margin: .2em;
      font-size: .85em;
      color: black;
      transition: 0s;
    }
    
    .tags-look .tagify__dropdown__item--active{
      color: black;
    }
    
    .tags-look .tagify__dropdown__item:hover{
      background: lightyellow;
      border-color: gold;
    }
    
    
    .tagify__tag{
      margin:1px;
    }
    
  </style>

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->

   <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <h4 class="card-title">
            登録 <a style="font-size:15px;">*は<span style="color: red;">必須</span>です</a>
        </h4>

        <!-- 登録フォーム -->
        <form action="{{ url('boxs') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="input-group">
                <div class="col-sm-6">
                   場所名* <input type="text" name="place_name" class="form-control" value="{{old('place_name')}}" placeholder="ユニクロ渋谷店">
                </div>
                <div class="col-sm-6">
                    コメント*<input type="text" name="message" class="form-control" value="{{old('message')}}" placeholder="500円クーポンもらえます">
                </div>
            </div>
            
            <div class="input-group">
                <div class="col-6">
                    サイトURL<input type="text" name="url" class="form-control" value="{{old('url')}}">
                </div>
                <div class="col-6">
                  画像
                  <label for="file_upload" class="form-control"id="label">
                  <div id="file_n">ファイルを選択</div>
                    <input type="file" id="file_upload" name="file_name" class="form-control" value="{{old('file_name')}}" style="display:none;">
                  </label>
                </div>
            </div>
          
            <!--タグ-->
            <div class="form-content">
                <div class="col-sm-6">
                <h5 class="font-weight">タグ<img src="https://img.icons8.com/material-outlined/24/000000/tag-window.png"/></h5>
                <input name='tags' id='input-custom-dropdown' class='some_class_name' value='{{old('tags') ?: '#他社製品OK, #自社製品のみ'}}'>
                </div>
            </div>
            <!--ここまで-->
            
              <!--場所-->
            <div class="form-content mt-3">
              <div><label for="address">
                
                <h5 class="font-weight">
                住所入力*<img src="https://img.icons8.com/material-outlined/24/000000/place-marker--v1.png"/>
              </h5>
                
                </label></div>
              <input type="text" name="address" id="address" value="{{old('address') ?: 'ユニクロ渋谷店'}}">
              <button type="button" id="map_button" class="btn btn-secondary"><img src="https://img.icons8.com/material-outlined/24/000000/search--v1.png"/></button>
              
              <!-- 登録ボタン -->
              <div class="text-right">
              <button type="submit" class="btn" id="show_s" style="background-color:#FCE38A;" disabled>登録</button>
             </div>
            
            </div>
            
            <!-- 緯度、軽度をhiddenで情報送ってます -->
                <input type="hidden" id="lat" value="" name="ido">
                <input type="hidden" id="lng" value="" name="keido">

        </form>
    </div>



  <!--マップ出す位置-->
    <div class="map_box01 ">
      <div id="map-canvas" style="max-width:500px;height:300px;"></div>
    </div>
    <!--ここまで-->
</div>

    <script src="{{ asset('/js/tag.js') }}"></script>
    <script src="{{ asset('/js/edit.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{config('app.api')}}"></script>
    
@endsection