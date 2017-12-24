<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Khanifest</title>

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app_system.css') }}" rel="stylesheet">
    <link href="{{ asset('css/basic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       Khanifest
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::user())
                            <li class={{ Request::is('/')? "active" : ''}}><a href="/"><i class="fa fa-home" aria-hidden="true"> Главная</i></a></li>
                            <li class={{ Request::is('home')? "active" : ''}}><a href="{{url('/home')}}">Читать правила</a></li>
                            <li class="dropdown"><a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Мои заявки<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/cosplay')}}">Косплей-шоу</a>
                                        <a href="{{ url('/fair')}}">Ярмарка</a>
                                        <a href="{{ url('/press')}}">Пресса</a>
                                        <a href="{{ url('/volunteer')}}">Волонтер</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Подать заявку<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/cosplay/create')}}">Косплей-шоу</a>
                                        <a href="{{ url('/fair/create')}}">Ярмарка</a>
                                        <a href="{{ url('/press/create')}}">Пресса</a>
                                        <a href="{{ url('/volunteer/create')}}">Волонтер</a>
                                    </li>
                                </ul>
                            </li>
                            @if(Auth::user()->isAdmin())
                            <li class="dropdown"><a  class="dropdown-toggle" title="Настройки" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-cog" aria-hidden="true"></i><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/type/create')}}">Добавить тип заявки</a>
                                        <a href="{{ url('/type')}}">Все типы заявок</a>
                                        <a href="{{ url('/role/create')}}">Добавить роль</a>
                                        <a href="{{ url('/role')}}">Все роли</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ url('auth/facebook')}}" title="Войти через facebook"><i class="fa fa-facebook-square fa-2x text-primary" aria-hidden="true"></i></a></li>
                            <li><a href="{{ route('login') }}">Войти</a></li>
                            <li><a href="{{ route('register') }}">Регистрация</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    @if(Auth::user()->avatar)
                                        <img width="20" src="/{{ Auth::user()->avatar->link }}" id="avatar"/>
                                    @endif
                                    {{ Auth::user()->profile->nickname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>

                                        <a href="{{ url('/profile') }}"><i class="fa fa-user" aria-hidden="true"></i> Профиль</a>

                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Выйти
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/dropzone-amd-module.min.js') }}"></script>

</body>
</html>
