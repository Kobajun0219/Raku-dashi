@extends('layouts.app')
@section('content')

<!--css 読み込み-->
<link href="{{ asset('css/form.css') }}" rel="stylesheet">

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->

   <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <h4 class="card-title">
            登録 <a style="font-size:15px;"><span class="red">*</span>は<span class="red">必須</span>です</a>
        </h4>

        <!-- 登録フォーム -->
        <form action="{{ url('boxs') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="input-group">
                <div class="col-sm-6">
                   場所名<span class="red">*</span><input type="text" name="place_name" class="form-control" value="{{old('place_name')}}" placeholder="ユニクロ渋谷店">
                </div>
                <div class="col-sm-6">
                    コメント<span class="red" >*</span><input type="text" name="message" class="form-control" value="{{old('message')}}" placeholder="500円クーポンもらえます、一階にあります">
                </div>
            </div>
            
            <div class="input-group">
                <div class="col-6">
                    サイトURL<input type="text" name="url" class="form-control" value="{{old('url')}}" placeholder="rakupo.example.com">
                </div>
                <div class="col-6">
                  画像
                  <label for="file_upload" class="form-control"id="label">
                  <div id="file_n" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">ファイルを選択</div>
                    <input type="file" id="file_upload" name="file_name" class="form-control" value="{{old('file_name')}}" style="display:none;">
                  </label>
                </div>
            </div>
          
            <!--タグ-->
            <div class="form-content">
                <div class="col-sm-6">
                <h5 class="font-weight">回収品<i class="fas fa-socks pl-1"></i></h5>
                <input name='tags' id='input-custom-dropdown' class='some_class_name' placeholder="選択" value='{{old('tags')}}'>
                </div>
            </div>
            <!--ここまで-->
            
              <!--場所-->
            <div class="form-content mt-3">
              <div><label for="address">
                
              <h5 class="font-weight">
                住所入力<i class="fas fa-map-marker-alt pl-1"></i></i><span class="red">*</span>
              </h5>
                
                </label></div>
              <input type="text" name="address" id="address" value="{{old('address') ?: 'ユニクロ渋谷店'}}">
              <button type="button" id="map_button" class="btn btn-dark"><i class="fas fa-search"></i></button>
              
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
    <div class="map_box01" style="padding-bottom: 30px;">
      <div id="map-canvas" style="max-width:500px;height:300px;"></div>
    </div>
    <!--ここまで-->
</div>

    <script src="{{ asset('/js/tag.js') }}"></script>
    <script src="{{ asset('/js/edit.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{config('app.api')}}"></script>
    
@endsection