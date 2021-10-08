    <!-- resources/views/index.blade.php -->
@extends('layouts.app')
@section('content')

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->

    <div class="card-body">
        <h4 class="card-title">
            プロフィール変更
        </h4>

        <!-- 登録フォーム -->
        <form action="{{ url('edit_user') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="input-group">
                <div class="col-12">
                   名前 <input type="text" name="name" class="form-control" value="{{$user->name}}">
                </div>
                <!--<div class="col-sm-6">-->
                <!--    メールアドレス<input type="text" name="email" class="form-control" value="$user->email">-->
                <!--</div>-->
            </div>
            
            <div class="input-group">
                <div class="col-12">
                  プロフィール写真
                  <label for="file_upload" class="form-control"id="label">
                  <div id="file_n" style="width:100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    @if ($user->image)
                     {{$user->image}}
                    @else
                     ファイルを選択
                    @endif
                  </div>
                    <input type="file" id="file_upload" name="image" class="form-control" style="display:none;" value="{{$user->image}}" onchange="previewImage(this);">
                  </label>
                </div>
            </div>

            <div class="text-center">
            <div>プレビュー</div><br>
            @if ($user->image)
            <img id="preview" src="{{$user->image}}" style="width:200px; height:200px;" class="rounded-circle">
            @else
            <img id="preview" src="" style="width:200px; height:200px;" class="rounded-circle">
            @endif
            </div>
            
            <!--hidden-->
            <input type="hidden" id="" value="{{ $user->id }}" name="id">

              <!-- 登録ボタン -->
            <div class="text-right">
              <button type="submit" class="btn" style="background-color:#FCE38A;">変更</button>
            </div>
            
            </div>

        </form>
    </div>
<script>
//ファイルの名前表示処理
  $('#file_upload').on('change', function () {
  var file = $(this).prop('files')[0];
  $('#file_n').text(file.name);
  });

//画像プレビュー
  function previewImage(obj)
{
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
}
</script>

@endsection