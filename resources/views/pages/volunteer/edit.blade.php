@extends('layouts.app')

@section('title', 'Волонтерство(редактировать)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Редактирование  заявки волонтерство</div>

                <div class="panel-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('volunteer.update', $volunteer->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label for="photo" class="col-md-4 control-label">Фото</label>
                                <div class="col-md-8">
                                    <img src="/storage/{{ $volunteer->id }}/volunteers" style="width:100%;" id="photo"/>
                                </div>
                            </div>

                            @if(Auth::user()->isAdmin())
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-md-4 control-label">Статус заявки</label>

                                <div class="col-md-8">
                                    <select class="form-control input-sm" id="status" name="status">
                                        @if(!empty($volunteer->status))
                                            <option selected value="{{$volunteer->status}}">{{$volunteer->status}}</option>
                                        @endif
                                        <option value="В обработке">В обработке</option>
                                        <option value="Ожидает ответа пользователя">Ожидает ответа пользователя</option>
                                        <option value="Принята">Принята</option>
                                        <option value="Отклонена">Отклонена</option>
                                        <option value="Внесены изменения">Внесены изменения</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">

                                <label for="image_uploads" class="col-md-4 control-label"></label>

                                <div class="col-md-8">Выберите файл для изменения фото (PNG,JPG,JPEG)
                                    <input name="photo" type="file"  accept=".jpeg, .jpg, .png" />

                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname" class="col-md-4 control-label">Фамилия</label>

                                <div class="col-md-8">
                                    <input id="surname" type="text" class="form-control" name="surname" value="{{ $volunteer->surname }}" required autofocus>

                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">Имя</label>

                                <div class="col-md-8">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $volunteer->first_name }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                <label for="nickname" class="col-md-4 control-label">Никнейм</label>

                                <div class="col-md-8">
                                    <input id="nickname" type="text" class="form-control" name="nickname" value="{{ $volunteer->nickname }}" autofocus>

                                    @if ($errors->has('nickname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class="col-md-4 control-label">Возраст (полных лет)</label>

                                <div class="col-md-8">
                                    <input id="age" type="number" min="1" max="100" class="form-control" name="age" value="{{ $volunteer->age}}" required autofocus>

                                    @if ($errors->has('age'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Город</label>

                                <div class="col-md-8">
                                    <input id="city" placeholder="Населенный пункт" type="text" class="form-control" name="city" value="{{ $volunteer->city }}" required autofocus>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>

                                <div class="col-md-8">
                                    <input id="phone" pattern='[\+]\d{3}[0-9]{9}'  placeholder="+380000000000" type="tel" class="form-control" name="phone" value="{{ $volunteer->phone }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telegram') ? ' has-error' : '' }}">
                                <label for="telegram" class="col-md-4 control-label">Telegram</label>

                                <div class="col-md-8">
                                    <input id="telegram"  type="text" class="form-control" name="telegram" value="{{ $volunteer->telegram }}" required autofocus>

                                    @if ($errors->has('telegram'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telegram') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                                <label for="skills" class="col-md-4 control-label">Навыки</label>

                                <div class="col-md-8">
                                    <textarea id="skills" rows="5" class="form-control" name="skills" required autofocus>{{ $volunteer->skills }}</textarea>

                                    @if ($errors->has('skills'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skills') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
                                <label for="experience" class="col-md-4 control-label">Опыт работы волонтером</label>
                                <div class="col-md-8">
                                    <textarea  id="experience" rows="5" class="form-control" placeholder="Год, название фестиваля, должность" name="experience" autofocus>{{ $volunteer->experience }}</textarea>

                                    @if ($errors->has('experience'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('experience') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('difficulties') ? ' has-error' : '' }}">
                                <label for="difficulties" class="col-md-4 control-label">Возможные затруднения</label>
                                <div class="col-md-8">
                                    <textarea  id="difficulties" rows="5" class="form-control" placeholder="Например: нестабильный график работы/учебы (может сорваться волонтерство), маленький рост, плохое зрение, участие в косплей-шоу и т.д." name="difficulties"  autofocus >{{ $volunteer->difficulties }}</textarea>

                                    @if ($errors->has('difficulties'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('difficulties') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div style="text-align:center"><strong>Cоцсети</strong></div>
                            <div class="form-group{{ $errors->has('social_links->vk') ? ' has-error' : '' }}">
                                <label for="social_links[vk]" class="col-md-4 control-label">VK</label>

                                <div class="col-md-8">
                                    <input id="social_links[vk]" type="text" class="form-control" name="social_links[vk]" value="{{ $social_links['vk'] }}" autofocus>

                                    @if ($errors->has('social_links->vk'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links->vk') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_links->fb') ? ' has-error' : '' }}">
                                <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>

                                <div class="col-md-8">
                                    <input id="social_links[fb]" type="text" class="form-control" name="social_links[fb]" value="{{ $social_links['fb'] }}"  autofocus>

                                    @if ($errors->has('social_links->fb'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links->fb') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_links->sk') ? ' has-error' : '' }}">
                                <label for="social_links[sk]" class="col-md-4 control-label">Skype</label>

                                <div class="col-md-8">
                                    <input id="social_links[sk]" type="text" class="form-control" name="social_links[sk]" value="{{ $social_links['sk'] }}" autofocus>

                                    @if ($errors->has('social_links->sk'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links->sk') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-info">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection
