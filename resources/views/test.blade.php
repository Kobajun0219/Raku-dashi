    <!-- resources/views/index.blade.php -->
@extends('layouts.app')
@section('content')
    
    
    
    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->
       
       
       
       
       <form action="{{ url('job') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-sm-6">
                   名前 <input type="text" name="name" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6">
                    email<input type="text" name="email" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6">
                    message<input type="text" name="message" class="form-control">
                </div>
            </div>
            


            <!-- 登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
        
        
        
        @endsection