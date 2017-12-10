@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Новая заявка пресса</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('/press/store')}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="type_id">
                                        @foreach($types as $key=>$type)
                                            <option value="{{$key}}">{{$type}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('type_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('media_name') ? ' has-error' : '' }}">
                                <label for="media_name" class="col-md-4 control-label">Наименование СМИ/никнейм</label>

                                <div class="col-md-6">
                                    <input id="media_name" type="text" class="form-control" name="media_name" value="{{ old('media_name') }}" required autofocus>

                                    @if ($errors->has('media_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('media_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="contact_name" class="col-md-4 control-label">Контактное лицо</label>
                                <div class="col-md-6">
                                    <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}" required autofocus>

                                    @if ($errors->has('contact_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
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

                            <div class="form-group{{ $errors->has('portfolio_link') ? ' has-error' : '' }}">
                                <label for="portfolio_link" class="col-md-4 control-label">Ссылка на портфолио</label>

                                <div class="col-md-6">
                                    <input id="portfolio_link" type="url" class="form-control" name="portfolio_link" value="{{ old('portfolio_link') }}" required autofocus>

                                    @if ($errors->has('portfolio_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('portfolio_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('camera') ? ' has-error' : '' }}">
                                <label for="camera" class="col-md-4 control-label">Модель камеры</label>
                                <div class="col-md-6">
                                    <input id="camera" type="text" class="form-control" name="camera" value="{{ old('camera') }}" autofocus>

                                    @if ($errors->has('camera'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('camera') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('members_count') ? ' has-error' : '' }}">
                                <label for="members_count" class="col-md-4 control-label">Количество представителей</label>
                                <div class="col-md-6">
                                    <input id="members_count" type="number" min="1" class="form-control" name="members_count" value="{{ old('members_count') }}" required autofocus>

                                    @if ($errors->has('members_count'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('members_count') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('equipment') ? ' has-error' : '' }}">
                                <label for="equipment" class="col-md-4 control-label">Доп. техника</label>
                                <div class="col-md-6">
                                    <textarea  id="equipment" rows="5" class="form-control" name="equipment"  autofocus required>{{ old('equipment') }}</textarea>

                                    @if ($errors->has('equipment'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('equipment') }}</strong>
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
                                    <p>Нажимая кнопку “Отправить” Вы подтверждаете, что ознакомились с <a href="/home">правилами фестиваля</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection
