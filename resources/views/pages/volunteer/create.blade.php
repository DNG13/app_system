@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Новая заявка волонтер</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('volunteer.index') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">

                                <label for="image_uploads" class="col-md-4 control-label">Фото</label>

                                <div class="col-md-6">Выберите файл для загрузки(PNG, JPG, JPEG)
                                    <input name="photo" type="file"  accept=".jpeg, .jpg, .png" required/>

                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname" class="col-md-4 control-label">Фамилия</label>

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
                                <label for="first_name" class="col-md-4 control-label">Имя</label>

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
                                <label for="birthday" class="col-md-4 control-label">Дата рождения</label>

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
                                <label for="city" class="col-md-4 control-label">Город</label>

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
                                <label for="phone" class="col-md-4 control-label">Телефон</label>

                                <div class="col-md-6">
                                    <input id="phone" pattern='[\+]\d{3}[\(]\d{2}[\)]\d{7}'  placeholder="+380(00)0000000" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                                <label for="skills" class="col-md-4 control-label">Навыки</label>

                                <div class="col-md-6">
                                    <textarea id="skills" rows="5" class="form-control" name="skills" required autofocus>{{ old('skills') }}</textarea>

                                    @if ($errors->has('skills'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skills') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
                                <label for="experience" class="col-md-4 control-label">Опыт работы волонтером</label>
                                <div class="col-md-6">
                                    <textarea  id="experience" rows="5" class="form-control" placeholder="Год, название фестиваля, должность" name="experience" autofocus>{{ old('experience') }}</textarea>

                                    @if ($errors->has('experience'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('experience') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('difficulties') ? ' has-error' : '' }}">
                                <label for="difficulties" class="col-md-4 control-label">Возможные затруднения</label>
                                <div class="col-md-6">
                                    <textarea  id="difficulties" rows="5" class="form-control" name="difficulties"  autofocus >{{ old('difficulties') }}</textarea>

                                    @if ($errors->has('difficulties'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('difficulties') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_links[vk]') ? ' has-error' : '' }}">
                                <label for="social_links[vk]" class="col-md-4 control-label">Cоцсети: VK</label>

                                <div class="col-md-6">
                                    <input id="social_links[vk]" type="url" class="form-control" name="social_links[vk]" value="{{ old('social_links[vk]') }}" autofocus>

                                    @if ($errors->has('social_links[vk]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links[vk]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_links[fb]') ? ' has-error' : '' }}">
                                <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>

                                <div class="col-md-6">
                                    <input id="social_links[fb]" type="url" class="form-control" name="social_links[fb]" value="{{ old('social_links[fb]') }}"  autofocus>

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
                                    <input id="social_links[sk]" type="url" class="form-control" name="social_links[sk]" value="{{ old('social_links[sk]') }}" autofocus>

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
                                    <input id="social_links[tg]" type="url" class="form-control" name="social_links[tg]" value="{{ old('social_links[tg]') }}" autofocus>

                                    @if ($errors->has('social_links[tg]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links[tg]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Отправить
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
