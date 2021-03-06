<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Raku-dashi') }}</title>
    
    <link rel="icon" href="{{url('image/sample.png')}}">
    <link rel="apple-touch-icon" href="{{url('image/sample.png')}}" sizes="180x180">
    <!-- Scripts -->
    


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:wght@300&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    
    <!--Tagifi.js-->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="crossorigin="anonymous"></script>


    <script src="https://kit.fontawesome.com/db3ae15c2d.js" crossorigin="anonymous"></script>
</head>

    <!-- Modal for news-->
    @include('modal.news')
    
    <!--modal for チュートリアル-->
    @include('modal.tutorial')
    
    <!--modal for send-->
    @include('modal.send')

<body>
    <header class =" mb-5">
    <div class="row justify-content-center align-items-center fixed-top" style="background-color:#FCE38A; height: 60px;">
    <div style="max-width:180px;"><img src="{{url('image/chara.png')}}" style="width:20%;"><a href="{{ url('/') }}"><img src="{{url('image/Rakupo!.png')}}" style="width:80%;"></a></div>
    </div>
    </header>
    
    <main class="py-4">
        @yield('content')
    </main>
        
        
    <footer　id="" class="fixed-bottom">
        <div id="app">
            <nav class="navbar shadow-sm pt-1 pb-1 pr-1 pl-1" style="background-color:#FCE38A;">
                <div class="container">
                    <button class="navbar-toggler">
                        <a href="{{ url('/') }}"><i class="fas fa-home"></i><div class="sub">ホーム</div></a>
                    </button>
                    
                    <button class="navbar-toggler" data-bs-toggle="modal" data-bs-target="#add">
                      <i class="fas fa-globe-asia"></i><div class="sub">ニュース</div>
                    </button>
                    
                    <button class="navbar-toggler" data-bs-toggle="modal" data-bs-target="#send">
                      <i class="fas fa-box-open"></i></i><div class="sub">寄付</div>
                    </button>
                    
                    <button class="navbar-toggler" type="button">
                        <a href="{{ url('post') }}"><i class="fas fa-plus"></i><div class="sub">投稿</div></a>
                    </button>
                    
                    
                    <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" >-->
                    <!--    <i class="fas fa-hamburger"></i>-->
                    <!--</button>-->
                    
                    
                    <div class="dropup">
                      <button class="navbar-toggler" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tshirt"></i><div class="sub">メニュー</div>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style = "left: -100px;">
                            @guest
                                <li class="dropdown-item list-group-item-action" style="display:flex; align-items: center;">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                                </li>
                                @if (Route::has('register'))
                                    <li class="dropdown-item list-group-item-action" style="display:flex; align-items: center;">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                                    </li>
                                    <li class="dropdown-item list-group-item-action" style="display:flex; align-items: center;" data-bs-toggle="modal" data-bs-target="#tutorial">
                                        <a class="nav-link">チュートリアル</a>
                                        <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                                    </li>
                                    <li class="dropdown-item list-group-item-action" style="display:flex; align-items: center;">
                                        <a class="nav-link" href="{{url('policy')}}" style="font-size:10px;">プライバシーポリシー</a>
                                    <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                                </li>
                                @endif
                            @else
                                <li class="dropdown-item list-group-item-action">
                                    {{ Auth::user()->name }}
                                </li>
                                <li class="dropdown-item" style="display:flex; align-items: center;">
                                    <a class="nav-link" href="{{url('mypage')}}">マイページ</a>
                                    <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                                </li>
                                
                                <li class="dropdown-item list-group-item-action" style="display:flex; align-items: center;" data-bs-toggle="modal" data-bs-target="#tutorial">
                                    <a class="nav-link">チュートリアル</a>
                                    <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                                </li>
                                
                                <li class="dropdown-item list-group-item-action" style="display:flex; align-items: center;">
                                    <a class="nav-link" href="https://lin.ee/fN1kM8t">お問い合わせ</a>
                                    <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                                </li>
                                
                                <li class="dropdown-item list-group-item-action" style="display:flex; align-items: center;">
                                    <a class="nav-link" href="{{url('policy')}}" style="font-size:10px;">プライバシーポリシー</a>
                                    <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                                </li>
                                
                                <li class="dropdown-item list-group-item-action" style="display:flex; align-items: center;">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    </a>
                                    <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                
                            @endguest
                      </ul>
                    </div>
    
                </div>
            </nav>
        </div>
    </footer>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v12.0&appId=561627295145225&autoLogAppEvents=1" nonce="USXDxhKS"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"crossorigin="anonymous"></script>
</body>
</html>
