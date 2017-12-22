@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование профиля</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('profile') }}">
                            {{ csrf_field() }}

                            @if($avatar)
                            <div class="form-group">
                                <label for="avatar" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <img src="/{{ $avatar }}" id="avatar"/>
                                </div>
                            </div>
                            @endif

                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">

                                <label for="image_uploads" class="col-md-4 control-label">Аватар</label>

                                <div class="col-md-6">Выберите файл для изменения автара (PNG,JPG,JPEG)
                                    <input name="avatar" type="file"  accept=".jpeg, .jpg, .png" />

                                    @if ($errors->has('avatar'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname" class="col-md-4 control-label">Фамилия</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="surname" value="{{ $profile->surname }}" required autofocus>

                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">Имя</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $profile->first_name }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                                <label for="middle_name" class="col-md-4 control-label">Отчество</label>

                                <div class="col-md-6">
                                    <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ $profile->middle_name }}" required autofocus>

                                    @if ($errors->has('middle_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                <label for="nickname" class="col-md-4 control-label">Никнейм</label>

                                <div class="col-md-6">
                                    <input id="nickname" type="text" class="form-control" name="nickname" value="{{ $profile->nickname }}" autofocus>

                                    @if ($errors->has('nickname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label for="birthday" class="col-md-4 control-label">Дата рождения</label>

                                <div class="col-md-6">
                                    <input id="birthday" type="date" min='1899-01-01' max="{{date("Y-m-d")}}" class="form-control" name="birthday" value="{{ $profile->birthday}}" required autofocus>

                                    @if ($errors->has('birthday'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Город</label>

                                <div class="col-md-6">
                                    <input id="city" placeholder="Населенный пункт" type="text" class="form-control" name="city" value="{{ $profile->city }}" required autofocus>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>

                                <div class="col-md-6">
                                    <input id="phone" pattern='[\+]\d{3}[\(]\d{2}[\)]\d{7}'  placeholder="+380(00)0000000" type="tel" class="form-control" name="phone" value="{{ $profile->phone }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_links->vk') ? ' has-error' : '' }}">
                                <label for="social_links[vk]" class="col-md-4 control-label">Cоцсети: VK</label>

                                <div class="col-md-6">
                                    <input id="social_links[vk]" type="url" class="form-control" name="social_links[vk]" value="{{ $social_links->vk }}" autofocus>

                                    @if ($errors->has('social_links->vk'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links->vk') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_links->fb') ? ' has-error' : '' }}">
                                <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>

                                <div class="col-md-6">
                                    <input id="social_links[fb]" type="url" class="form-control" name="social_links[fb]" value="{{ $social_links->fb }}"  autofocus>

                                    @if ($errors->has('social_links->fb'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links->fb') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_links->sk') ? ' has-error' : '' }}">
                                <label for="social_links[sk]" class="col-md-4 control-label">Skype</label>

                                <div class="col-md-6">
                                    <input id="social_links[sk]" type="url" class="form-control" name="social_links[sk]" value="{{ $social_links->sk }}" autofocus>

                                    @if ($errors->has('social_links->sk'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links->sk') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_links->tg') ? ' has-error' : '' }}">
                                <label for="social_links[tg]" class="col-md-4 control-label">Telegram</label>

                                <div class="col-md-6">
                                    <input id="social_links[tg]" type="url" class="form-control" name="social_links[tg]" value="{{ $social_links->tg }}" autofocus>

                                    @if ($errors->has('social_links->tg'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links->tg') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                                <label for="info" class="col-md-4 control-label">Дополнительные данные</label>

                                <div class="col-md-6">
                                    <textarea rows="5" class="form-control" name="info" autofocus>{{ $profile->info }}</textarea>

                                    @if ($errors->has('info'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('info') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
