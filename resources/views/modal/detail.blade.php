<!--modal中身-->
<div class="modal fade" id="exampleModal{{$box->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content" style="height:600px; max-width:400px;">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModal{{$box->id}}">
        <a href="https://www.google.com/maps/search/?api=1&query={{$box->address}}" target="_blank"><i class="fas fa-map-marker-alt"></i>
        {{$box->place_name}}
        </a>
        
        @if ($box->url == true)
        &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn" style="background-color:#FCE38A;"><a href="{{$box->url}}">サイトURL</a></button>
        @endif
        </h5>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
    <div class="modal-body">
        @if ($box->file_name == "")
            <img src="{{url('image/raku.png')}}" style="max-width:100%;">
        @else
            <img src="{{$box->file_name}}" style="max-width:100%;">
        @endif
            <div class="p-1">{{$box->message}}</div>
            <div class="border-bottom pb-1 mb-1">
        <!--タグを表示させるループ処理-->
        @foreach ($box->tags as $tag)
            <button class="btn btn-outline-warning text-body font-weight-bold no-gutters">{{$tag->tag_name}}</button>
        @endforeach
            </div>

        <!--コメント入力欄-->
          <form action="{{ url('comment') }}" method="POST" class="form-horizontal" enctype="multipart/form-data"> 
                {{ csrf_field() }}
                 <div style="font-weight:bold;">BOXに出した服を投稿しよう！</div>
                 <input type="text" name="comment" class="form-control c_text" placeholder="コメントを入力">
                 <label for="file_upload" class="form-control p-1"id="label">
                 <div id="file_n">ファイルを選択</div>
                 <input type="file"  id="file_upload" name="file_name" class="file_upload c_box_id" value="{{old('file_name')}}" style="display:none;">
                 </label>
                 <input type="hidden" name="box_id" class="form-control c_box_id" value="{{$box->id}}">
                 <button type="submit" class="btn" style="background-color:#FCE38A; display: block; margin: 0 0 0 auto;">送信</button>
          </form>
        <!--コメント入力欄終わり-->
          
        <!--コメント一覧-->

          @foreach ($box->comments as $comment)
          <div style="width: 100%;" class="border-top pt-1 mt-1">
            <div class="p-1">{{$comment->comment}}</div>
            @if ($comment->file_name == true)
            <img src="{{$comment->file_name}}" style="max-width:100%;">
            @endif
            <div class="float-right">{{$comment->created_at}}</div>
          </div>
        　@endforeach
       
         <!--コメント一覧終わり-->
    </div>
</div>
</div>
</div>