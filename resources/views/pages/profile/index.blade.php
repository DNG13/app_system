@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Профиль</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            @if($avatar)
                            <div>
                                <label for="avatar" class="col-md-4">Аватар</label>
                                <div class="col-md-6">
                                    <img src="/{{ $avatar }}" id="avatar" name="avatar"/>
                                </div>
                            </div>
                            @endif

                            <div>
                                <label for="surname" class="col-md-4">Фамилия</label>
                                <div class="col-md-6">
                                    <p id="surname"> {{ $profile->surname}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="first_name" class="col-md-4">Имя</label>
                                <div class="col-md-6">
                                    <p id="first_name">{{ $profile->first_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="nickname" class="col-md-4">Никнейм</label>
                                <div class="col-md-6">
                                    <p id="nickname"> {{ $profile->nickname }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="birthday" class="col-md-4">Дата рождения</label>
                                <div class="col-md-6">
                                    <p id="birthday"> {{ $profile->birthday }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="city" class="col-md-4">Город</label>
                                <div class="col-md-6">
                                    <p id="city"> {{ $profile->city }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="col-md-4">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone"> {{ $profile->phone }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="email" class="col-md-4">E-Mail</label>
                                <div class="col-md-6">
                                    <p id="email">{{Auth::user()->email}}</p>
                                </div>
                            </div>

                            @if(!$social_links->vk==null)
                                <div>
                                <label for="social_links[vk]" class="col-md-4">VK</label>
                                <div class="col-md-6">
                                    <p id="social_links[vk]"> {{ $social_links->vk}}</p>
                                </div>
                            </div>
                            @endif

                            @if(!$social_links->fb==null)
                                <div>
                                <label for="social_links[fb]" class="col-md-4">Facebook</label>
                                <div class="col-md-6">
                                    <p id="social_links[fb]"> {{$social_links->fb }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!$social_links->sk==null)
                                <div>
                                <label for="social_links[sk]" class="col-md-4">Skype</label>
                                <div class="col-md-6">
                                    <p id="social_links[sk]"> {{ $social_links->fb }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!($social_links->tg)==null)
                             <div>
                                <label for="social_links[tg]" class="col-md-4">Telegram</label>
                                <div class="col-md-6">
                                    <p id="social_links[tg]">{{ $social_links->tg }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!($profile->info)==null)
                             <div>
                                <label for="info" class="col-md-4">Дополнительные данные</label>
                                <div class="col-md-6">
                                    <p name="info">{{ $profile->info }}</p>
                                </div>
                            </div>
                            @endif

                            <div>
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{ route('profile.edit')}}" class="btn btn-primary" role="button">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
