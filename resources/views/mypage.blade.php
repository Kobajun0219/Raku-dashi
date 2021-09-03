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
                              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{$box->id}}">
                              <img src="{{url('image/02.png')}}">
                              </button>
                              </div>
                                 
                                 <div class="modal fade" id="exampleModal{{$box->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModal{{$box->id}}"><a href="https://www.google.com/maps/search/?api=1&query={{$box->address}}" target="_blank">{{$box->place_name}}</a></h5>
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
                            </td>
                            <!-- 削除ボタン -->
                            <td class="align-middle">
                                <form action="{{ url('box/'.$box->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                 <button type="submit" class="btn btn-danger" onClick="delete_alert(event);return false;">削除</button>
                                </form>
                            </td>
                            
                                
                                
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
        </div>




@endsection