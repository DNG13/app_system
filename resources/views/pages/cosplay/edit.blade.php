@extends('layouts.app')

@section('title', 'Кослей(редактировать)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Редактирование  заявки косплей-шоу</div>

                <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('cosplay.update', $cosplay->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="type_id">
                                        @foreach($types as $key=>$type)
                                            @if($key == $cosplay->type_id)
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
                                        @if(!empty($cosplay->status))
                                            <option selected value="{{$cosplay->status}}">{{$cosplay->status}}</option>
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
                                <label for="group_nick" class="col-md-4 control-label">Название команды/ник выступающего</label>

                                <div class="col-md-6">
                                    <input id="group_nick" type="text" class="form-control" name="group_nick" value="{{ $cosplay->group_nick }}" required autofocus>

                                    @if ($errors->has('group_nick'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('group_nick') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Название постановки</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $cosplay->title }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fandom') ? ' has-error' : '' }}">
                                <label for="fandom" class="col-md-4 control-label">Источник (фендом)</label>
                                <div class="col-md-6">
                                    <input id="fandom" type="text" class="form-control" name="fandom" value="{{ $cosplay->fandom }}" required autofocus>

                                    @if ($errors->has('fandom'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fandom') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('length') ? ' has-error' : '' }}">
                                <label for="length" class="col-md-4 control-label">Продолжительность(минут)</label>
                                <div class="col-md-6">
                                    <input id="length" type="number" min="0" step="0.5" class="form-control" name="length" value="{{ $cosplay->length}}" required autofocus>

                                    @if ($errors->has('length'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('length') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <input id="city" placeholder="Населенный пункт" type="text" class="form-control" name="city" value="{{ $cosplay->city }}" required autofocus>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('prev_part') ? ' has-error' : '' }}">
                                <label for="prev_part" class="col-md-4 control-label">Предыдущее участие</label>
                                <div class="col-md-6">
                                    <textarea id="prev_part" placeholder="Участие костюма/постановки в других фестивалях(с указанием на каких именно со ссылками на фото/видео. Получали ли призовые места)" class="form-control" name="prev_part" autofocus>{{ $cosplay->prev_part }}</textarea>

                                    @if ($errors->has('prev_part'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prev_part') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('props') ? ' has-error' : '' }}">
                                <label for="props" class="col-md-4 control-label">Реквизит</label>
                                <div class="col-md-6">
                                    <textarea  id="props" rows="5" class="form-control" name="props" placeholder="Ширма, столы, стулья, микрофоны, волонтёры - всё то, что не везете с собой" autofocus>{{ $cosplay->props }}</textarea>

                                    @if ($errors->has('props'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('props') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea  id="description" rows="5" class="form-control" name="description">{{ $cosplay->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label for="comment" class="col-md-4 control-label">Коментарий</label>
                                <div class="col-md-6">
                                    <textarea  id="comment" rows="5" class="form-control" name="comment" autofocus>{{ $cosplay->comment }}</textarea>

                                    @if ($errors->has('comment'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
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
                                                    <div class="col-md-6">
                                                        <input type="text" name="members[{{$count}}][first_name]" class="form-control name_list" required value="{{ $data }}"/>
                                                    </div>
                                                </div>
                                            @elseif($attribute=='character')
                                                <div class="form-group">
                                                    <label  class="col-md-4 control-label">Персонаж</label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="members[{{$count}}][character]" class="form-control name_list" required value="{{ $data }}"/>
                                                    </div>
                                                </div>
                                            @elseif($attribute=='birthday')
                                                <div class="form-group">
                                                    <label  class="col-md-4 control-label">Дата рождения</label>
                                                     <div class="col-md-3">
                                                        <input type="date" min='1899-01-01' max="{{date("Y-m-d")}}" name="members[{{$count}}][birthday]" class="form-control name_list" required value="{{ $data }}"/>
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
                                        Отправить
                                    </button>
                                </div>
                            </div>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                var postURL = "<?php echo url('cosplay/edite'); ?>";
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
                                                    '<input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/> ' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label class="col-md-4 control-label">Персонаж</label>' +
                                                '<div class="col-md-6">' +
                                                    '<input type="text" name="members['+i+'][character]" class="form-control name_list" required/>' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label  class="col-md-4 control-label">Дата рождения</label>' +
                                                '<div class="col-md-3">' +
                                                    '<input type="date"  min="1899-01-01" max="Date()"  name="members['+i+'][birthday]" class="form-control name_list" required/>' +
                                                '</div>'+
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
            <div class="panel panel-default">
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
                        <input type="hidden" name="app_kind" value="cosplay">
                        <input type="hidden" name="app_id" value="{{$cosplay->id}}">

                        {{--<input type=file name=file>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Отправить--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
