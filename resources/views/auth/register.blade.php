@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Регистрация<br><p style="color: red"><strong>* Поля обязательные для заполнения</strong></p></div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">

                            <label for="image_uploads" class="col-md-4 control-label">Аватар</label>

                            <div class="col-md-6">Выберите файл для загрузки(PNG, JPG, JPEG)
                                <input name="avatar" type="file"  value="" accept=".jpeg, .jpg, .png"/>

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail<span style="color: red"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Фамилия<span style="color: red"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">Имя<span style="color: red"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                            <label for="nickname" class="col-md-4 control-label">Никнейм</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" autofocus>

                                @if ($errors->has('nickname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">Дата рождения<span style="color: red"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="birthday" type="date" min='1899-01-01' max="{{date("Y-m-d")}}" class="form-control" name="birthday" value="{{ old('birthday') }}" required autofocus>

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">Город<span style="color: red"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="city" placeholder="Населенный пункт" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Телефон<span style="color: red"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="phone" pattern='[\+]\d{3}[0-9]{9}'  placeholder="+380000000000" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль<span style="color: red"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Подтверждение пароля<span style="color: red"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                            <label for="info" class="col-md-4 control-label">Дополнительные данные</label>

                            <div class="col-md-6">
                                <textarea id="info" rows="5" class="form-control" name="info" autofocus>{{ old('info') }}</textarea>

                                @if ($errors->has('info'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('info') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div style="text-align:center"><strong>Cоцсети</strong></div>
                        <div class="form-group{{ $errors->has('social_links[vk]') ? ' has-error' : '' }}">
                            <label for="social_links[vk]" class="col-md-4 control-label">VK</label>

                            <div class="col-md-6">
                                <input id="social_links[vk]" type="text" class="form-control" name="social_links[vk]" value="{{ old('social_links[vk]') }}" autofocus>

                                @if ($errors->has('social_links[vk]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('social_links[vk]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('social_links->in') ? ' has-error' : '' }}">
                            <label for="social_links[in]" class="col-md-4 control-label">Instagram</label>

                            <div class="col-md-6">
                                <input id="social_links[in]" type="text" class="form-control" name="social_links[in]" value="{{ old('social_links[in]') }}"  autofocus>

                                @if ($errors->has('social_links->in'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('social_links->in') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('social_links[fb]') ? ' has-error' : '' }}">
                            <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>

                            <div class="col-md-6">
                                <input id="social_links[fb]" type="text" class="form-control" name="social_links[fb]" value="{{ old('social_links[fb]') }}"  autofocus>

                                @if ($errors->has('social_links[fb]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('social_links[fb]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('social_links[sk]') ? ' has-error' : '' }}">
                            <label for="social_links[sk]" class="col-md-4 control-label">Skype</label>

                            <div class="col-md-6">
                                <input id="social_links[sk]" type="text" class="form-control" name="social_links[sk]" value="{{ old('social_links[sk]') }}" autofocus>

                                @if ($errors->has('social_links[sk]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('social_links[sk]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('social_links[tg]') ? ' has-error' : '' }}">
                            <label for="social_links[tg]" class="col-md-4 control-label">Telegram</label>

                            <div class="col-md-6">
                                <input id="social_links[tg]" type="text" class="form-control" name="social_links[tg]" value="{{ old('social_links[tg]') }}" autofocus>

                                @if ($errors->has('social_links[tg]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('social_links[tg]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Зарегистрироваться
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
