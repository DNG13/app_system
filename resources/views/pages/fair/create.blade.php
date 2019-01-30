@extends('layouts.app')

@section('title', 'Ярмарка(создать)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Новая заявка ярмарка</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ url('/expo/store')}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-8">
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

                            <div class="form-group{{ $errors->has('group_nick') ? ' has-error' : '' }}">
                                <label for="group_nick" class="col-md-4 control-label">Hазвание группы/ник</label>

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="group_nick" value="{{ old('group_nick') }}" required autofocus>

                                    @if ($errors->has('group_nick'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('group_nick') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="contact_name" class="col-md-4 control-label">Контактное лицо</label>

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}" required autofocus>

                                    @if ($errors->has('contact_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Город</label>

                                <div class="col-md-8">
                                    <input id="title" type="text" placeholder="Для иногородних - город и дата/время прибытия" class="form-control" name="city" value="{{ old('city') }}" required autofocus>

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

                            <div class="form-group{{ $errors->has('social_link') ? ' has-error' : '' }}">
                                <label for="social_link" class="col-md-4 control-label">Ссылка на личную страницу</label>

                                <div class="col-md-8">
                                    <input id="social_link" type="text" class="form-control" name="social_link" value="{{ old('social_link') }}" placeholder="vk, fb или tg для связи с ответственным по заявке" required autofocus>

                                    @if ($errors->has('social_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('social_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('group_link') ? ' has-error' : '' }}">
                                <label for="group_link" class="col-md-4 control-label">Ссылка на сайт</label>

                                <div class="col-md-8">
                                    <input id="group_link" type="text" class="form-control" name="group_link" value="{{ old('group_link') }}" autofocus>

                                    @if ($errors->has('group_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('group_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#social-panel" >
                                        Соцсети (нажмите для заполнения)
                                    </button>
                                </div>
                            </div>
                            <div id="social-panel" class="collapse social-panel">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="form-group{{ $errors->has('social_links[vk]') ? ' has-error' : '' }}">
                                            <label for="social_links[vk]" class="col-md-4 control-label">VK</label>
                                            <div class="col-md-8">
                                                <input id="social_links[vk]" type="text" value="{{ old('social_links[vk]') }}"
                                                          class="form-control" name="social_links[vk]" autofocus>
                                                @if ($errors->has('social_links[vk]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[vk]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('social_links[fb]') ? ' has-error' : '' }}">
                                            <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>
                                            <div class="col-md-8">
                                                <input id="social_links[fb]" type="text" value="{{ old('social_links[fb]') }}"
                                                          class="form-control" name="social_links[fb]" autofocus>{{ old('social_links[fb]') }}
                                                @if ($errors->has('social_links[fb]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[fb]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('social_links[insta]') ? ' has-error' : '' }}">
                                            <label for="social_links[insta]" class="col-md-4 control-label">Instagram</label>
                                            <div class="col-md-8">
                                                <input id="social_links[insta]" type="text" value="{{ old('social_links[insta]') }}"
                                                          class="form-control" name="social_links[insta]" autofocus>{{ old('social_links[insta]') }}
                                                @if ($errors->has('social_links[insta]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[insta]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('social_links[tg]') ? ' has-error' : '' }}">
                                            <label for="social_links[tg]" class="col-md-4 control-label">Telegram</label>
                                            <div class="col-md-8">
                                                <input id="social_links[tg]" type="text" value="{{ old('social_links[tg]') }}"
                                                          class="form-control" name="social_links[tg]" autofocus>{{ old('social_links[tg]') }}
                                                @if ($errors->has('social_links[tg]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[tg]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('social_links[tumblr]') ? ' has-error' : '' }}">
                                            <label for="social_links[tumblr]" class="col-md-4 control-label">Tumbler</label>
                                            <div class="col-md-8">
                                                <input id="social_links[tumblr]" type="text" value="{{ old('social_links[tumblr]') }}"
                                                          class="form-control" name="social_links[tumblr]" autofocus>{{ old('social_links[tumblr]') }}
                                                @if ($errors->has('social_links[tumblr]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[tumblr]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#filter-panel" >
                                        Блок для стендов, игрозоны и фудкорта(нажмите для заполнения)
                                    </button>
                                </div>
                            </div>
                            <div id="filter-panel" class="collapse filter-panel">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="form-group{{ $errors->has('block[universe]') ? ' has-error' : '' }}">
                                            <label for="block[universe]" class="col-md-4 control-label">Вселенная</label>
                                            <div class="col-md-8">
                                                <textarea id="block[universe]" type="text"
                                                          placeholder="Например: Фотостенд по «Гравити Фоллс» или игровая зона 'Вархаммер'. Обязательно к заполнению стендами и игрозонами."
                                                          class="form-control" name="block[universe]" autofocus>{{ old('block[universe]') }}
                                                </textarea>
                                                @if ($errors->has('block[universe]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('block[universe]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('block[description]') ? ' has-error' : '' }}">
                                            <label for="block[description]" class="col-md-4 control-label">Краткое описание декораций и интерактива</label>
                                            <div class="col-md-8">
                                                <textarea id="block[description]" type="text"
                                                          placeholder="Опишите, что будет происходить на стенде, а также дизайн стенда. Фото и план следует прикрепить через редактирование заявки"
                                                          class="form-control" name="block[description]" autofocus>{{ old('block[description]') }}
                                                </textarea>
                                                @if ($errors->has('block[description]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('block[description]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('block[stuff]') ? ' has-error' : '' }}">
                                            <label for="block[stuff]" class="col-md-4 control-label">Используемые материалы</label>
                                            <div class="col-md-8">
                                                <textarea id="block[stuff]" type="text"
                                                          placeholder="Обязательно к заполнению при наличии любых конструкций и декораций"
                                                          class="form-control" name="block[stuff]" autofocus>{{ old('block[stuff]') }}
                                                </textarea>
                                                @if ($errors->has('block[stuff]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('block[stuff]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('block[goods]') ? ' has-error' : '' }}">
                                            <label for="block[goods]" class="col-md-4 control-label">Перечень продукции</label>
                                            <div class="col-md-8">
                                                <textarea id="block[goods]" type="text"
                                                          placeholder="Обязательно к заполнению для фудкорта. Для обширных игрозон - перечень игр"
                                                          class="form-control" name="block[goods]" autofocus>{{ old('block[goods]') }}
                                                </textarea>
                                                @if ($errors->has('block[goods]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('block[goods]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('block[square]') ? ' has-error' : '' }}">
                                            <label for="block[square]" class="col-md-4 control-label">Размер торгово-развлекательной точки</label>
                                            <div class="col-md-8">
                                                <textarea id="block[square]" type="text"
                                                          placeholder="Ширина, глубина и высота в сантиметрах."
                                                          class="form-control" name="block[square]" autofocus>{{ old('block[square]') }}
                                                </textarea>
                                                @if ($errors->has('block[square]'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('block[square]') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div style="text-align:center"><strong>Оборудование</strong></div>
                            <div>
                                <div class="form-group{{ $errors->has('equipment[table]') ? ' has-error' : '' }}">
                                    <label for="equipment[table]" class="col-md-4 control-label">Количество столов</label>

                                    <div class="col-md-8">
                                        <input id="equipment[table]" type="number" min="0" class="form-control" name="equipment[table]" value="{{ old('equipment[table]') }}" required autofocus>

                                        @if ($errors->has('equipment[table]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[table]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('equipment[chair]') ? ' has-error' : '' }}">
                                    <label for="equipment[chair]" class="col-md-4 control-label">Количество стульев</label>
                                    <div class="col-md-8">
                                        <input id="equipment[chair]" type="number" min="0" class="form-control" name="equipment[chair]" value="{{ old('equipment[chair]') }}"  required autofocus>

                                        @if ($errors->has('equipment[chair]'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('equipment[chair]') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('equipment[extra]') ? ' has-error' : '' }}">
                                    <label for="equipment[extra]" class="col-md-4 control-label">Дополнительное оборудование с размерами</label>

                                    <div class="col-md-8">
                                        <textarea id="equipment[extra]" class="form-control"
                                                  placeholder="Например, баннер, этажерка, ширма и т.д."
                                                  name="equipment[extra]" autofocus>{{ old('equipment[extra]') }}</textarea>

                                        @if ($errors->has('equipment[extra]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[extra]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('equipment[electricity]') ? ' has-error' : '' }}">
                                    <label for="equipment[electricity]" class="col-md-4 control-label">Надобность подведения электричества</label>
                                    <div class="col-md-8">
                                        <select id="type_id" class="form-control" name="equipment[electricity]">
                                            <option value="Нет">Нет</option>
                                            <option value="Да">Да</option>
                                        </select>
                                        @if ($errors->has('equipment[electricity]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[electricity]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('electrics') ? ' has-error' : '' }}">
                                <label for="electrics" class="col-md-4 control-label">Электрооборудование</label>
                                <div class="col-md-8">
                                    <textarea  id="electrics"
                                               placeholder="список оборудования и информация из спецификации или паспорта оборудования в Вт и А"
                                               class="form-control" name="electrics"  autofocus>{{ old('electrics') }}</textarea>

                                    @if ($errors->has('electrics'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('electrics') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : '' }}">
                                <label for="payment_type" class="col-md-4 control-label">Способ оплаты</label>

                                <div class="col-md-8">
                                    <select id="type_id" class="form-control" name="payment_type">
                                        <option value="наличный">наличный (в день фестиваля)</option>
                                        <option value="договорной">договорной (для коммерческих стендов, игрозон, фудкортов)</option>
                                        <option value="фанатский">на условиях участника фестиваля(для фанатских стендов)</option>
                                    </select>
                                    @if ($errors->has('payment_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('payment_type') }}</strong>
                                    </span>
                                    @endif
                                    В этом году безналичный расчет недоступен. На само участие в ярмарке это никак не повлияет. Приносим извинения за возможные неудобства
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-8">
                                    <textarea  id="description" rows="4"
                                               placeholder="Именно этот краткий текст мы опубликуем на сайте. После отправки заявки не забудьте зайти в меню редактирования и прикрепить промо-фото вашей продукции/стенда, а также можете добавить свой логотип.
Для больших магазинов (от 3 столов), игрозон, и стендов: этот текст и фото мы также опубликуем в качестве рекламы в некоторых соцсетях."
                                               class="form-control" name="description"  autofocus required>{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div style="text-align:center"><strong>Участники</strong></div>
                            <div id="dynamic_field">
                                <div class="members" id="row0">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Фамилия</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[0][surname]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Имя</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[0][first_name]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Деятельность на фестивале</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[0][duty]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-8">
                                    <button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>Добавить участника</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Отправить
                                    </button>
                                    <p>Нажимая кнопку “Отправить” Вы подтверждаете, что ознакомились с <a href="http://khanifest.com/?page_id=346">правилами фестиваля</a> и даёте согласие на обработку данных оргкомитетом фестиваля.</p>
                                </div>
                            </div>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                var postURL = "<?php echo url('expo/create'); ?>";
                                var i=1;

                                $('#add').click(function(){
                                    $('#dynamic_field').append(
                                        '<div class="col-md-12"><hr></div>' +
                                        '<div class="members" id="row'+i+'">' +
                                        '<div class="form-group">'+
                                        '<label  class="col-md-4 control-label">Фамилия</label>'+
                                        '<div class="col-md-8">' +
                                        '<input type="text" name="members['+i+'][surname]" class="form-control name_list" required/>' +
                                        '</div>' +
                                        '</div>'+
                                        '<div class="form-group">' +
                                        '<label class="col-md-4 control-label">Имя</label>' +
                                        '<div class="col-md-8">' +
                                        '<input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/>' +
                                        '</div>' +
                                        '</div>'+
                                        '<div class="form-group">' +
                                        '<label class="col-md-4 control-label">Деятельность на фестивале</label>' +
                                        '<div class="col-md-7">' +
                                        '<input type="text" name="members['+i+'][duty]" class="form-control name_list" required/>' +
                                        '</div>' +
                                        '<div class="col-md-1">'+
                                        '<a class="btn btn-info btn-sm" name="remove" id="btn_remove" title="Удалить участника"> <i class="fa fa-user-times" aria-hidden="true"></i> </a>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>'
                                    );
                                    i++;
                                });
                                $(document).on('click', '#btn_remove', function(){
                                    $(this).closest('.members').remove();
                                    i--;
                                });

                                $('#submit').click(function(){
                                    $.ajax({
                                        url:postURL,
                                        method:"POST",
                                        data:$('#add_name').serialize(),
                                        type:'json'
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
        </div>
    </div>
@endsection
