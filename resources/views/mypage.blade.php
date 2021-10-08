    <!-- resources/views/index.blade.php -->
@extends('layouts.app')
@section('content')

    <!-- マイページ変更時に表示-->
    @include('common.com')
    <!-- マイページ変更時に表示-->
    
    
    <div class="text-center"　style="align-items: flex-end;">
        @if(Auth::user()->image)
        <img src="{{Auth::user()->image}}" style="width:120px; height:120px" class="rounded-circle">
        @else
        <img src="{{url('image/sample.png')}}" style="width:120px; height:120px" class="rounded-circle">
        @endif
        <button class="btn pt-0 pb-0 pr-1 pl-1" style="background-color:#FCE38A; font-size:20px; margin-top: 80px;">
        <a href="{{ url('change_mypage/'.auth()->id()) }}"><i class="fas fa-user-cog"></i></a>
        </button>
    </div>

    <div class="text-center pt-3 pb-2"><h3>Hi!&nbsp;&nbsp;{{Auth::user()->name}}さん</h3></div>
    <div class="text-center pb-2"><h3>貢献度:{{$point}}&nbsp;thanks!</h3></div>


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
                          <i class="far fa-heart heart"></i>
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
                                <h5 class="modal-title" id="exampleModal{{$box->id}}">
                                <a href="https://www.google.com/maps/search/?api=1&query={{$box->address}}" target="_blank">
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
                                    <img src="{{url('image/rakupo.png')}}" style="max-width:100%;">
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
                         <button type="submit" class="btn pr-1 pl-1 pb-0" style="background-color:#FCE38A;"><i class="fas fa-edit fa-2x"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>
@endsection