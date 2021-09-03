@extends('index')
@section('good')
    {{ \App\Like::where('box_id',$box->id)->count()}}
    <form action="{{ url('/like') }}" method="POST" class="form-horizontal">
        {{ csrf_field()}}
        <button>いいね</i></button>
        
            <input type="hidden" name="box_id" value="{{ $box->id }}">
            <input type="hidden" name="u_id" value="1">
    </form>    
@endsection