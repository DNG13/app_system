@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-info">
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

                            @if(Auth::user()->isAdmin())
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-md-4 control-label">Статус заявки</label>

                                <div class="col-md-6">
                                    <select class="form-control input-sm" id="status" name="status">
                                        @if(!empty($fair->status))
                                            <option selected value="{{$fair->status}}">{{$fair->status}}</option>
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

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label"> Город</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" placeholder="Для иногородних - город и дата/время прибытия" class="form-control" name="city" value="{{ $fair->city }}" required autofocus>

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
                                    <input id="phone" pattern='[\+]\d{3}[0-9]{9}'  placeholder="+380000000000" type="tel" class="form-control" name="phone" value="{{  $fair->phone }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
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
                                <label for="square" class="col-md-4 control-label">Размер торгово-развлекательной точки</label>
                                <div class="col-md-6">
                                    <textarea id="square" type="text" class="form-control" placeholder="Обязательно для стендов, игровых зон, фудкорта(ширина, глубина и высота в сантиметрах)" name="square" autofocus>{{ $fair->square }}</textarea>

                                    @if ($errors->has('square'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('square') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <div class="form-group{{ $errors->has('equipment[table]') ? ' has-error' : '' }}">
                                    <label for="equipment[table]" class="col-md-4 control-label">Оборудование: Количество столов</label>

                                    <div class="col-md-6">
                                        <input id="equipment[table]" type="number" min="0" class="form-control" name="equipment[table]" value="{{  $equipment->table }}" required autofocus>

                                        @if ($errors->has('equipment[table]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[table]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('equipment[chair]') ? ' has-error' : '' }}">
                                    <label for="equipment[chair]" class="col-md-4 control-label">Количество стульев</label>
                                    <div class="col-md-6">
                                        <input id="equipment[chair]" type="number" min="0" class="form-control" name="equipment[chair]" value="{{ $equipment->chair }}"  required autofocus>

                                        @if ($errors->has('equipment[chair]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[chair]') }}</strong>
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

                                <div class="form-group{{ $errors->has('equipment[electricity]') ? ' has-error' : '' }}">
                                    <label for="equipment[electricity]" class="col-md-4 control-label">Надобность подведения электричества</label>
                                    <div class="col-md-6">
                                        <select id="type_id" class="form-control" name="equipment[electricity]">
                                                <option @if($equipment->electricity == 'Нет') selected @endif value="Нет">Нет</option>
                                                <option @if($equipment->electricity == 'Да') selected @endif value="Да">Да</option>
                                        </select>
                                        @if ($errors->has('equipment[electricity]'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('equipment[electricity]') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : '' }}">
                                <label for="payment_type" class="col-md-4 control-label">Способ оплаты</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="payment_type">
                                        <option @if( $fair->payment_type == 'наличный') selected @endif value="наличный">наличный (в день фестиваля)</option>
                                        <option @if( $fair->payment_type == 'безналичный') selected @endif value="безналичный">безналичный(закрывается за неделю до фестиваля)</option>
                                        <option @if( $fair->payment_type == 'фанатский') selected @endif value="фанатский">на условиях участника фестиваля(для фанатских стендов)</option>
                                    </select>
                                    @if ($errors->has('payment_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('payment_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea  id="description" rows="5"
                                               placeholder="Обратите внимание, что именно этот текст мы опубликуем в качестве рекламы. После отправки заявки не забудьте зайти в меню редактирования и прикрепить к заявке промо-фото вашей продукции/стенда, которые мы опубликуем. Также можете добавить свой логотип."
                                               class="form-control" name="description"  autofocus required>{{  $fair->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div style="text-align:center"><strong>Участники</strong></div>
                            <div id="dynamic_field">
                                @foreach($members as $member=>$attributes)
                                    <div class="members" id="row{{$count}}">
                                        @foreach($attributes as $attribute=>$data)
                                            @if($attribute=='surname')
                                                <div class="form-group">
                                                    <label  class="col-md-4 control-label">Участник : Фамилия</label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="members[{{$count}}][surname]" class="form-control name_list" required value="{{ $data }}"/>
                                                    </div>
                                                </div>
                                            @elseif($attribute=='first_name')
                                                <div class="form-group">
                                                    <label  class="col-md-4 control-label">Имя</label>
                                                    <div class="col-md-3">
                                                        <input type="text" name="members[{{$count}}][first_name]" class="form-control name_list" required value="{{ $data }}"/>
                                                    </div>
                                                </div>
                                            @elseif($attribute=='duty')
                                                <div class="form-group">
                                                    <label  class="col-md-4 control-label">Обязанности на фестивале</label>
                                                    <div class="col-md-3">
                                                        <input type="text" name="members[{{$count}}][duty]" class="form-control name_list" required value="{{ $data }}"/>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a class="btn btn-info btn-sm" name="remove" id="btn_remove" title="Удалить участника">
                                                            <i class="fa fa-user-times" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <input hidden {{$count++}}}>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>Добавить участника</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-info">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                var postURL = "<?php echo url('fair/edit'); ?>";
                                var i="<?php echo $count; ?>";
                                $('#add').click(function(){
                                    $('#dynamic_field').append(
                                        '<div class="members" id="row'+i+'">' +
                                        '<div class="form-group">'+
                                        '<label  class="col-md-4 control-label">Участник : Фамилия</label>'+
                                        '<div class="col-md-6">' +
                                        '<input type="text" name="members['+i+'][surname]" class="form-control name_list" required/>' +
                                        '</div>' +
                                        '</div>'+
                                        '<div class="form-group">' +
                                        '<label class="col-md-4 control-label">Имя</label>' +
                                        '<div class="col-md-6">' +
                                        '<input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/>' +
                                        '</div>' +
                                        '</div>'+
                                        '<div class="form-group">' +
                                        '<label class="col-md-4 control-label">Обязанности</label>' +
                                        '<div class="col-md-3">' +
                                        '<input type="text" name="members['+i+'][duty]" class="form-control name_list" required/>' +
                                        '</div>' +
                                        '<div class="col-md-1">'+
                                        '<a class="btn btn-info btn-sm" name="remove" id="btn_remove" title="Удалить участника"><i class="fa fa-user-times" aria-hidden="true"></i> </a>' +
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

            <div class="panel panel-info">
                <div class="panel-heading">Прикрепить файлы</div>
                <div class="panel-body">
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#filter-panel">
                        <i class="fa fa-file" aria-hidden="true"></i> Технические ограничения
                    </button>
                    <div id="filter-panel" class="collapse filter-panel">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul>
                                    <li>названия файлов должны быть выполнены латиницей и не содержать пробелов (scenraio_defile.doc)</li>
                                    <li>размеры файлов не более 10 мегабайт</li>
                                    <li>видео и большие файлы (>10 мегабайт) рекомендуем загружать на другие хостинги <i class="fa fa-cloud-download" aria-hidden="true"></i> (Youtube, dropbox) и оставлять ссылку в комментариях</li>
                                    <li>файлы менее 10 мегабайт загружайте в систему заявок.</li>
                                    <li>при загрузке файлов на сторонние хостинги обратите внимание на срок хранения файлов. Файлы должны храниться до <b>30 Апреля 2018</b>!</li>
                                    <li>eсли вам необходимо удалить файл, обратитесь к Организаторам, мы все сделаем!</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form action="{{ url('/upload') }}" enctype="multipart/form-data" method="post" class="dropzone" id="my-awesome-dropzone">
                        {{ csrf_field() }}
                        <div class="dz-message" data-dz-message><span>Кликните здесь мышью или перенесите файлы, чтобы загрузить</span></div>
                        <input type="hidden" name="app_kind" value="fair">
                        <input type="hidden" name="app_id" value="{{$fair->id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
