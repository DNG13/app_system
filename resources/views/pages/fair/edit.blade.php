@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование  заявки ярмарка</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('fair.update', $fair->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="type_id">
                                        @foreach($types as $key=>$type)
                                            @if($key == $fair->type_id)
                                                <option value="{{$key}}" selected>{{$type}}</option>
                                            @else
                                                <option value="{{$key}}">{{$type}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('type_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('group_nick') ? ' has-error' : '' }}">
                                <label for="group_nick" class="col-md-4 control-label">Hазвание группы/ник</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="group_nick" value="{{ $fair->group_nick }}" required autofocus>

                                    @if ($errors->has('group_nick'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('group_nick') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="logo" class="col-md-4 control-label">Логотип</label>
                                <div class="col-md-6">
                                    <img src="/{{  $fair->logo }}" id="logo"/>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">

                                <label for="image_uploads" class="col-md-4 control-label"></label>

                                <div class="col-md-6">Выберите файл для изменения логотипа (PNG,JPG,JPEG)
                                    <input name="logo" type="file"  accept=".jpeg, .jpg, .png" />

                                    @if ($errors->has('logo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="contact_name" class="col-md-4 control-label">Контактное лицо</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="contact_name" value="{{ $fair->contact_name }}" required autofocus>

                                    @if ($errors->has('contact_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>

                                <div class="col-md-6">
                                    <input id="phone" pattern='[\+]\d{3}[\(]\d{2}[\)]\d{7}'  placeholder="+380(00)0000000" type="tel" class="form-control" name="phone" value="{{  $fair->phone }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('members_count') ? ' has-error' : '' }}">
                                <label for="members_count" class="col-md-4 control-label">Количество представителей</label>
                                <div class="col-md-6">
                                    <input id="members_count" type="number" min="1" class="form-control" name="members_count" value="{{  $fair->members_count }}" required autofocus>

                                    @if ($errors->has('members_count'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('members_count') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('social_link') ? ' has-error' : '' }}">
                                <label for="social_link" class="col-md-4 control-label">Ссылка на личную страницу в соцсети</label>

                                <div class="col-md-6">
                                    <input id="social_link" type="url" class="form-control" name="social_link" value="{{$fair->social_link }}" required autofocus>

                                    @if ($errors->has('social_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('group_link') ? ' has-error' : '' }}">
                                <label for="group_link" class="col-md-4 control-label">Ссылка на сайт или группу в соцсетях</label>

                                <div class="col-md-6">
                                     <input  id="group_link" type="url" class="form-control" name="group_link" value="{{  $fair->group_link }}" required autofocus>

                                    @if ($errors->has('group_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('group_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('square') ? ' has-error' : '' }}">
                                <label for="square" class="col-md-4 control-label">Площадь(м²)</label>
                                <div class="col-md-6">
                                    <input id="square" type="number" min="1" step="0.5" class="form-control" name="square" value="{{  $fair->square }}" required autofocus>

                                    @if ($errors->has('square'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('square') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : '' }}">
                                <label for="payment_type" class="col-md-4 control-label">Способ оплаты</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="payment_type">
                                        @if( $fair->payment_type == 'наличный')
                                            <option selected value="наличный">наличный (в день фестиваля)</option>
                                            <option value="безналичный">безналичный(закрывается за неделю до фестиваля)</option>
                                        @else
                                            <option value="наличный">наличный (в день фестиваля)</option>
                                            <option selected  value="безналичный">безналичный(закрывается за неделю до фестиваля)</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('payment_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('payment_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <div class="form-group{{ $errors->has('equipment[chair]') ? ' has-error' : '' }}">
                                    <label for="equipment[chair]" class="col-md-4 control-label">Оборудование: Количество стульев</label>
                                    <div class="col-md-6">
                                        <input id="equipment[chair]" type="number" min="1" class="form-control" name="equipment[chair]" value="{{ $equipment->chair }}"  required autofocus>

                                        @if ($errors->has('equipment[chair]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[chair]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('equipment[table]') ? ' has-error' : '' }}">
                                    <label for="equipment[table]" class="col-md-4 control-label">Количество столов</label>

                                    <div class="col-md-6">
                                        <input id="equipment[table]" type="number" min="1" class="form-control" name="equipment[table]" value="{{  $equipment->table }}" required autofocus>

                                        @if ($errors->has('equipment[table]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[table]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('equipment[electricity]') ? ' has-error' : '' }}">
                                    <label for="equipment[electricity]" class="col-md-4 control-label">Надобность подведения электричества</label>
                                    <div class="col-md-6">
                                        <select id="type_id" class="form-control" name="equipment[electricity]">
                                            @if($equipment->electricity == 'no')
                                                <option selected value="no">Нет</option>
                                                <option value="yes">Да</option>
                                            @else
                                                <option value="no">Нет</option>
                                                <option  selected value="yes">Да</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('equipment[electricity]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[electricity]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('equipment[extra]') ? ' has-error' : '' }}">
                                    <label for="equipment[extra]" class="col-md-4 control-label">Дополнительное оборудование с размерами</label>

                                    <div class="col-md-6">
                                        <textarea id="equipment[extra]" rows="5"
                                                  class="form-control" placeholder="Например, баннер, этажерка, ширма и т.д."
                                                  name="equipment[extra]"  required autofocus>{{ $equipment->extra }}</textarea>

                                        @if ($errors->has('equipment[extra]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[extra]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea  id="description" rows="5"
                                               placeholder="C указанием, что именно. Этот текст мы опубликуем в качестве рекламы в соцсетях."
                                               class="form-control" name="description"  autofocus required>{{  $fair->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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
