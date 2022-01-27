@extends('layouts.app')

@section('title', 'Волонтерство(створити)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Нова заявка волонтерство</div>

                <div class="panel-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('volunteer.index') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">

                                <label for="image_uploads" class="col-md-4 control-label">Фото</label>

                                <div class="col-md-8">Виберіть файл для завантаження (PNG, JPG, JPEG)
                                    <input name="photo" type="file"  accept=".jpeg, .jpg, .png" required/>

                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname" class="col-md-4 control-label">Прізвище</label>

                                <div class="col-md-8">
                                    <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">Ім'я</label>

                                <div class="col-md-8">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                <label for="nickname" class="col-md-4 control-label">Нікнейм</label>

                                <div class="col-md-8">
                                    <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" autofocus>

                                    @if ($errors->has('nickname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class="col-md-4 control-label">Вік (повних років)</label>

                                <div class="col-md-8">
                                    <input id="age" type="number" min="1" max="100" class="form-control" name="age" value="{{ old('age') }}" required autofocus>

                                    @if ($errors->has('age'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Місто</label>

                                <div class="col-md-8">
                                    <input id="city" placeholder="Населений пункт" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>

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
                                    <input id="phone" pattern='[\+]\d{3}[0-9]{9}'  placeholder="+380000000000" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

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
                                    <input id="telegram" type="text" class="form-control" name="telegram" value="{{ old('telegram') }}" required autofocus>

                                    @if ($errors->has('telegram'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telegram') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                                <label for="skills" class="col-md-4 control-label">Навички</label>

                                <div class="col-md-8">
                                    <textarea id="skills" rows="5" class="form-control" name="skills" required autofocus>{{ old('skills') }}</textarea>

                                    @if ($errors->has('skills'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skills') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
                                <label for="experience" class="col-md-4 control-label">Досвід роботи волонтером</label>
                                <div class="col-md-8">
                                    <textarea  id="experience" rows="5" class="form-control" placeholder="Рік, назва фестивалю, посада" name="experience" autofocus>{{ old('experience') }}</textarea>

                                    @if ($errors->has('experience'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('experience') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('difficulties') ? ' has-error' : '' }}">
                                <label for="difficulties" class="col-md-4 control-label">Можливі труднощі</label>
                                <div class="col-md-8">
                                    <textarea  id="difficulties" rows="5" placeholder="Наприклад: нестабільний графік роботи/навчання (може зірватися волонтерство), маленький зріст, поганий зір, участь у косплей-шоу тощо." class="form-control" name="difficulties"  autofocus >{{ old('difficulties') }}</textarea>

                                    @if ($errors->has('difficulties'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('difficulties') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="text-align:center"><strong>Cоцмережі</strong></div>

                            <div class="form-group{{ $errors->has('social_links[fb]') ? ' has-error' : '' }}">
                                <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>

                                <div class="col-md-8">
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

                                <div class="col-md-8">
                                    <input id="social_links[sk]" type="text" class="form-control" name="social_links[sk]" value="{{ old('social_links[sk]') }}" autofocus>

                                    @if ($errors->has('social_links[sk]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_links[sk]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Відправити
                                    </button>
                                    <p>Натискаючи кнопку “Відправити” Ви підтверджуєте, що ознайомилися з <a href="https://khanifest.com/visitors/main-rules/">правилами фестивалю</a> та даєте згоду на обробку даних оргкомітетом фестивалю.</p>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection
