@extends('layouts.app')

@section('title', 'Профиль')

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
                                    <img src="/storage/{{ $profile->user_id }}/avatar" id="avatar"/>
                                </div>
                            </div>
                            @endif

                            @if($profile->surname)
                                <div>
                                    <label for="surname" class="col-md-4">Фамилия</label>
                                    <div class="col-md-6">
                                        <p id="surname"> {{ $profile->surname }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($profile->first_name)
                                <div>
                                    <label for="first_name" class="col-md-4">Имя</label>
                                    <div class="col-md-6">
                                        <p id="first_name">{{ $profile->first_name }}</p>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <label for="nickname" class="col-md-4">Никнейм</label>
                                <div class="col-md-6">
                                    <p id="nickname"> {{ $profile->nickname }}</p>
                                </div>
                            </div>

                            @if($profile->birthday)
                                <div>
                                    <label for="birthday" class="col-md-4">Дата рождения</label>
                                    <div class="col-md-6">
                                        <p id="birthday"> {{ $profile->birthday }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($profile->city)
                                <div>
                                    <label for="city" class="col-md-4">Город</label>
                                    <div class="col-md-6">
                                        <p id="city"> {{ $profile->city }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($profile->phone)
                                <div>
                                    <label for="phone" class="col-md-4">Телефон</label>
                                    <div class="col-md-6">
                                        <p id="phone"> {{ $profile->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <label for="email" class="col-md-4">E-Mail</label>
                                <div class="col-md-6">
                                    <p id="email">{{$profile->user->email}}</p>
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

                            @if(!$social_links->in==null)
                                <div>
                                    <label for="social_links[in]" class="col-md-4">Instagram</label>
                                    <div class="col-md-6">
                                        <p id="social_links[in]"> {{ $social_links->in}}</p>
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
                                        <p id="social_links[sk]"> {{ $social_links->sk }}</p>
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
                                        <p id="info">{{ $profile->info }}</p>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{ route('profile.edit')}}" class="btn btn-info" role="button">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
