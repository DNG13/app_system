@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Профиль</div>

                    <div class="panel-body">
                        <div class="form-horizontal">


                            <div class="form-group">
                                <label for="avatar" class="col-md-4 control-label">Аватар</label>
                                <div class="col-md-6">
                                    <img src="{{ $avatar }}" id="avatar" name="avatar"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="surname" class="col-md-4 control-label">Фамилия</label>
                                <div class="col-md-6">
                                    <p id="surname" class="form-control" name="surname"> {{ $profile->surname}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="first_name" class="col-md-4 control-label">Имя</label>
                                <div class="col-md-6">
                                    <p id="first_name" class="form-control" name="first_name">{{ $profile->first_name }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middle_name" class="col-md-4 control-label">Отчество</label>
                                <div class="col-md-6">
                                    <p id="middle_name" class="form-control" name="middle_name"> {{ $profile->middle_name }}</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="nickname" class="col-md-4 control-label">Никнейм</label>
                                <div class="col-md-6">
                                    <p id="nickname" class="form-control" name="nickname"> {{ $profile->nickname }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="birthday" class="col-md-4 control-label">Дата рождения</label>
                                <div class="col-md-6">
                                    <p id="birthday" class="form-control" name="birthday"> {{ $profile->birthday }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <p id="city" class="form-control" name="city"> {{ $profile->city }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone" class="form-control" name="phone" > {{ $profile->phone }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>
                                <div class="col-md-6">
                                    <p id="email" class="form-control" name="email" >{{Auth::user()->email}}}</p>
                                </div>
                            </div>

                            @if(!$social_links->vk==null)
                                <div class="form-group">
                                <label for="social_links[vk]" class="col-md-4 control-label">VK</label>
                                <div class="col-md-6">
                                    <p id="social_links[vk]" class="form-control" name="social_links[vk]"> {{ $social_links->vk}}</p>
                                </div>
                            </div>
                            @endif

                            @if(!$social_links->fb==null)
                                <div class="form-group">
                                <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>
                                <div class="col-md-6">
                                    <p id="social_links[fb]" class="form-control" name="social_links[fb]"> {{$social_links->fb }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!$social_links->sk==null)
                                <div class="form-group">
                                <label for="social_links[sk]" class="col-md-4 control-label">Skype</label>
                                <div class="col-md-6">
                                    <p id="social_links[sk]" class="form-control" name="social_links[sk]" > {{ $social_links->fb }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!($social_links->tg)==null)
                             <div class="form-group">
                                <label for="social_links[tg]" class="col-md-4 control-label">Telegram</label>
                                <div class="col-md-6">
                                    <p id="social_links[tg]" class="form-control" name="social_links[tg]">{{ $social_links->tg }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!($profile->info)==null)
                             <div class="form-group">
                                <label for="info" class="col-md-4 control-label">Дополнительные данные</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="info">{{ $profile->info }}</textarea>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/profile/edit" class="btn btn-primary" role="button">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
