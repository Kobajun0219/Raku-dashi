    <!-- resources/views/index.blade.php -->
@extends('layouts.app')
@section('content')

    <script type="text/javascript">

     
      function delete_alert(e){
           if(!window.confirm('本当に削除しますか？')){
              window.alert('キャンセルされました'); 
              return false;
           }
           document.deleteform.submit();
        };

    </script>
    
        <div>Hi! {{Auth::user()->name}}さん</div>


        <div class="pl-2 pr-2">
                <table class="table table-sm">
                    <div>自分の投稿BOX一覧</div>
                    @if (count($boxes) > 0)
                    <tbody>
                        @foreach ($boxes as $box)
                        <tr>
                            
                            <!-- タイトル -->
                            <td class="align-middle">
                                <div id="place_name">{{$box->place_name}}</div>
                            </td>
                    
                            <td class="align-middle">
                            　<span class="likes">
                                  <i class="fas fa-thumbs-up heart"></i>
                                <span class="like-counter">{{$box->likes_count}}</span>
                              </span><!-- /.likes -->
                            </td>
                            
                            
                            <td>
                              <div style="">
                              <button type="button" class="btn pr-1 pl-1 pb-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{$box->id}}" style="background-color:#FCE38A;">
                              <i class="far fa-comment-alt fa-2x"></i>
                              </button>
                              </div>
                                 
                              <!--modal中身-->
                              <div class="modal fade" id="exampleModal{{$box->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content" style="height:600px; max-width:400px;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModal{{$box->id}}"><a href="https://www.google.com/maps/search/?api=1&query={{$box->address}}" target="_blank">{{$box->place_name}}</a></h5>
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


                                        <!--コメント一覧-->
                                        <div>コメント一覧</div>
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
                            </td>
                            
                            <!-- 編集ボタン -->
                            <td class="align-middle">
                                <form action="{{ url('edit/'.$box->id) }}" method="POST">
                                {{ csrf_field() }}
                                 <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                </form>
                            </td>
                            
                            <!-- 削除ボタン -->
                            <td class="align-middle">
                                <form action="{{ url('box/'.$box->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                 <button type="submit" class="btn btn-danger" onClick="delete_alert(event);return false;"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
        </div>
@endsection