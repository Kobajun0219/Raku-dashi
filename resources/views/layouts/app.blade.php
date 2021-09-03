<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    
    <!--Tagifi.js-->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

    <!-- Modal -->
    <div class="modal fade" id="add" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="add">真のコスト</h5>
          </div>
          <div class="modal-body">
            <iframe style="max-width:100%;" width="400" height="280" src="https://www.youtube.com/embed/nxhCpLzreCw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <div class="modal-footer">
            真のコストは、人々と地球に対するファッションの影響を探るドキュメンタリー映画です。<br>ストーリーライン：これは衣服についてのストーリーです。私たちが着る服、それを作る人々、そして業界が私たちの世界に与えている影響についてです。衣料の価格は数十年にわたって減少してきましたが、人的および環境的コストは劇的に増大しました。真のコストは、未知の物語の幕を引き、私たちに問題定義をしてくれます。
          </div>
        </div>
      </div>
    </div>

<body>
    <header class =" mb-5">
    <div class="row justify-content-center align-items-center fixed-top" style="background-color:#FCE38A; height: 60px;">
    Raku-dashi
    </div>
        
    </header>
    
    <main class="py-4">
        @yield('content')
    </main>
        
        
    <footer　id="" class="fixed-bottom">
        <div id="app">
            <nav class="navbar shadow-sm" style="background-color:#FCE38A;">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <i class="fas fa-home"></i>
                    </a>
                    
                    <button class="navbar-toggler" data-bs-toggle="modal" data-bs-target="#add">
                      <i class="fas fa-globe-asia"></i>
                    </button>
                    

                    <button class="navbar-toggler" type="button">
                        <a href="{{ url('post') }}"><i class="fas fa-edit"></i></a>
                    </button>
                    
                    
                    <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" >-->
                    <!--    <i class="fas fa-hamburger"></i>-->
                    <!--</button>-->
                    
                    
                    <div class="dropup">
                      <button class="navbar-toggler" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-hamburger"></i>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style = "left: -100px;">
                            @guest
                                <li class="dropdown-item list-group-item-action">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="dropdown-item list-group-item-action">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="dropdown-item list-group-item-action">
                                    {{ Auth::user()->name }}
                                </li>
                                <li class="dropdown-item">
                                    <a class="nav-link" href="{{url('mypage')}}">マイページ&nbsp;&nbsp;<i class="fas fa-chevron-right"></i></a>
                                </li>
                                <li class="dropdown-item list-group-item-action">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                
                                <li class="dropdown-item list-group-item-action">
                                    <a class="nav-link" href="https://lin.ee/fN1kM8t">お問い合わせ&nbsp;&nbsp;<i class="fas fa-chevron-right"></i></a>
                                </li>
                                
                            @endguest
                      </ul>
                    </div>
    
                </div>
            </nav>
        </div>
    </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"crossorigin="anonymous"></script>
</body>
</html>
