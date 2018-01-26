<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')| Khanifest</title>

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app_system.css') }}" rel="stylesheet">
    <link href="{{ asset('css/basic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
</head>
<body>
    <div id="app" style="margin-bottom: 65px"  class="social-float-parent">
        <nav class="navbar navbar-default navbar-static-top social-float">
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
                        <img src="/images/logo.png" id="logo" alt="logo"/>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::user())
                            <li class={{ Request::is('/')? "active" : ''}}><a href="/">ГЛАВНАЯ</a></li>
                            <li class={{ Request::is('home')? "active" : ''}}><a href="{{url('/home')}}">ПРАВИЛА</a></li>
                            <li class="dropdown
                            {{ Request::is('cosplay')|| Request::is('fair')|| Request::is('press')|| Request::is('volunteer') ? "active" : ''}}"
                            ><a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">МОИ ЗАЯВКИ<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/cosplay')}}">КОСПЛЕЙ-ШОУ</a>
                                        <a href="{{ url('/fair')}}">ЯРМАРКА</a>
                                        <a href="{{ url('/press')}}">ПРЕССА</a>
                                        <a href="{{ url('/volunteer')}}">ВОЛОНТЕРСТВО</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown {{ Request::is('*/create')? "active" : ''}}"><a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">ПОДАТЬ ЗАЯВКУ<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/cosplay/create')}}">КОСПЛЕЙ-ШОУ</a>
                                        <a href="{{ url('/fair/create')}}">ЯРМАРКА</a>
                                        <a href="{{ url('/press/create')}}">ПРЕССА</a>
                                        <a href="{{ url('/volunteer/create')}}">ВОЛОНТЕРСТВО</a>
                                    </li>
                                </ul>
                            </li>
                            @if(Auth::user()->isAdmin())
                            <li class="dropdown  {{ (Auth::user()->isAdmin()) ? "active" : ''}}"><a  class="dropdown-toggle" title="Настройки" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><i class="fa fa-cog" aria-hidden="true"></i><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('type')}}">ТИПЫ ЗАЯВОК</a>
                                        <a href="{{ url('role')}}">РОЛИ</a>
                                        <a href="{{ url('user-role')}}">ДОБАВИТЬ РОЛЬ ПОЛЬЗОВАТЕЛЮ</a>
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
                            <li><a href="{{ url('auth/facebook')}}" title="Войти через facebook"><i class="fa fa-facebook-square fa-2x text-info" aria-hidden="true"></i></a></li>
                            <li><a href="{{ route('login') }}">ВОЙТИ</a></li>
                            <li><a href="{{ route('register') }}">РЕГИСТРАЦИЯ</a></li>
                        @else
                            <li class="dropdown  {{ Request::is('profile/*')|| Request::is('profile')? "active" : ''}}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" style="font-size: 10pt">
                                    @if(Auth::user()->avatar)<img width="20" src="/storage/{{ Auth::user()->id }}/avatar" id="avatar"/>@endif
                                    {{ Auth::user()->profile->nickname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/profile') }}"><i class="fa fa-user" aria-hidden="true"></i> ПРОФИЛЬ</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            ВЫЙТИ
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
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
    <script src="{{ asset('js/dropzone.js') }}"></script>

    <footer class="collapse navbar-collapse footer" id="footer">
        <div>
            <div class="row">
                <div class="col-sm-6 text-left">
                    <div>Made by <a style="color: white" href="https://www.linkedin.com/in/nataliia-duka-7262b2a8/" target="_blank">Duka Nataliia </a> © 2017 - {{date("Y")}} <a style="color: white" href="http://khanifest.com/"target="_blank">Khanifest</a></div>
                </div>
                <div class="col-sm-6 text-right" style="text-align: right;">
                    <nav>
                        <ul class="list-inline">
                            <li><a class="li-footer-fa" href="https://www.instagram.com/khanifest"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a></li>
                            <li><a class="li-footer-fa" href="https://www.facebook.com/khanifest/"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a></li>
                            <li><a class="li-footer-fa" href="https://twitter.com/khanifest"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></li>
                            <li><a class="li-footer-fa" href="http://plus.google.com/u/0/117135632301135612843"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a></li>
                            <li><a class="li-footer-fa" href="http://t.me/khanifest"><i class="fa fa-telegram fa-2x" aria-hidden="true"></i></a></li>
                            <li><a class="li-footer-fa" href="http://vk.com/khanifest"><i class="fa fa-vk fa-2x" aria-hidden="true"></i></a></li>
                            <li><a class="li-footer-fa" href="#top" title="Вверх"><i class="fa fa-caret-square-o-up fa-2x" aria-hidden="true"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>