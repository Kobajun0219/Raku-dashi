@extends('layouts.app')
@section('content')


    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->


   <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <h4 class="card-title">
            登録 <a style="font-size:15px;">*は必須です</a>
        </h4>

        <!-- 登録フォーム -->
        <form action="{{ url('boxs') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-sm-6">
                   名称* <input type="text" name="place_name" class="form-control" value="{{old('place_name')}}">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6">
                    コメント*<input type="text" name="message" class="form-control" value="{{old('message')}}">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6">
                    サイトURL<input type="text" name="url" class="form-control" value="{{old('url')}}">
                </div>
            </div>
            
            <!--タグ-->
            <div class="form-content">
                <div><label for="tags">
                <h5 class="font-weight">
                タグ<img src="https://img.icons8.com/material-outlined/24/000000/tag-window.png"/>
                </h5>
      
                </label></div>
                <input name='tags' class='basic' placeholder='write some tags' value='#何でも, #ポリエステル,#自社のみ,#コットン' autofocus>
            </div>
            <!--ここまで-->
            
              <!--場所-->
            <div class="form-content">
              <div><label for="address">
                
                <h5 class="font-weight">
                住所入力*<img src="https://img.icons8.com/material-outlined/24/000000/place-marker--v1.png"/>
              </h5>
                
                </label></div>
              <input type="text" name="address" id="address" value="{{old('address')}}">
              <button type="button" value="検索" id="map_button" class="btn btn-secondary"><img src="https://img.icons8.com/material-outlined/24/000000/search--v1.png"/></button>
              
              <!-- 登録ボタン -->
              <div class="text-right">
              <button type="submit" class="btn" id="show_s" style="background-color:#FCE38A; display: none;">登録</button>
             </div>
            
            </div>
    <!--ここまで-->
            
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