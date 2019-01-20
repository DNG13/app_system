@extends('layouts.app')

@section('title', 'Косплей(редактировать)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Редактирование заявки на косплей-шоу</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('cosplay.update', $cosplay->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-8">
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

                                <div class="col-md-8">
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

                                <div class="col-md-8">
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

                                <div class="col-md-8">
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
                                <div class="col-md-8">
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
                                <div class="col-md-8">
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
                                <div class="col-md-8">
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
                                <div class="col-md-8">
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
                                <div class="col-md-8">
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
                                <div class="col-md-8">
                                    <textarea  id="description" rows="5" class="form-control" name="description">{{ $cosplay->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label for="comment" class="col-md-4 control-label">Примечания</label>
                                <div class="col-md-8">
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
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Фамилия</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[{{$count}}][surname]" class="form-control name_list" required value="{{ $attributes->surname ?? ''}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Имя</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[{{$count}}][first_name]" class="form-control name_list" required value="{{ $attributes->first_name ?? ''}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Персонаж</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[{{$count}}][character]" class="form-control name_list" required value="{{ $attributes->character ?? ''}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Возраст (полных лет)</label>
                                        <div class="col-md-3">
                                            <input type="number" step="1" min="0" max="150" name="members[{{$count}}][age]" class="form-control name_list" required value="{{ $attributes->age ?? '' }}"/>
                                        </div>
                                        <div class="col-md-1">
                                            <a class="btn btn-info btn-sm" name="remove" id="btn_remove" title="Удалить участника">
                                                <i class="fa fa-user-times" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <input hidden {{$count++}}>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-8">
                                    <button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>Добавить участника</button>
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

                    <script type="text/javascript">
                        $(document).ready(function(){
                            var postURL = "<?php echo url('cosplay/edite'); ?>";
                            var i="<?php echo $count; ?>";
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
                                                    '<input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/> ' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label class="col-md-4 control-label">Персонаж</label>' +
                                                '<div class="col-md-8">' +
                                                    '<input type="text" name="members['+i+'][character]" class="form-control name_list" required/>' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label  class="col-md-4 control-label">Возраст (полных лет)</label>' +
                                                '<div class="col-md-3">' +
                                                    '<input type="number" step="1" min="0" max="150" name="members['+i+'][age]" class="form-control name_list" required/>' +
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

                        });
                    </script>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Файлы заявки( {{count($files)}} )
                    @if(Auth::user()->isAdmin())
                        <div>
                            <a href="/create-zip?download=zip&app_id={{$cosplay->id}}&app_kind=cosplay" class="btn btn-info" >Скачать <i class="fa fa-download" aria-hidden="true"></i></a>
                        </div>
                    @endif
                </div>

                <div class="panel-body">
                    @if(!count($files)==0)
                        @foreach($files as $file)
                            <div class="col-md-2" style="width: 225px; height:150px;">
                                <a href="/storage/{{$file->name}}">
                                    @if($file->type == 'image')
                                        <img  src="/storage/{{$file->id}}/thumbnail">
                                    @elseif($file->type == 'audio')
                                        <i class="fa fa-file-audio-o fa-5x" aria-hidden="true"></i>
                                    @elseif($file->type == 'document')
                                        <i class="fa fa-file-text-o fa-5x" aria-hidden="true"></i>
                                    @elseif($file->type == 'video')
                                        <i class="fa fa-file-video-o fa-5x" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-file-o fa-5x" aria-hidden="true"></i>
                                    @endif
                                </a>
                                @if(Auth::user()->isAdmin() || Auth::user()->id == $cosplay->user_id)
                                    <a title="Удалить" href="/file/delete?id={{ $file->id }}&app_id={{$cosplay->id}}&app_kind=cosplay">
                                        <div class="btn btn-default">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                @endif
                                <div>{{$file->name}}</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Прикрепить файлы</div>
                <div class="panel-body">
                    <button type="button" class="btn btn-info filter" data-toggle="collapse" data-target="#filter-panel">
                        <i class="fa fa-file" aria-hidden="true"></i> Технические ограничения
                    </button>
                    <div id="filter-panel" class="collapse filter-panel">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul>
                                    <li>размеры файлов не более 20 мегабайт</li>
                                    <li>видео и большие файлы (>20 мегабайт) рекомендуем загружать на другие хостинги <i class="fa fa-cloud-download" aria-hidden="true"></i> (Youtube, dropbox) и оставлять ссылку в комментариях</li>
                                    <li>файлы менее 20 мегабайт загружайте в систему заявок.</li>
                                    <li>при загрузке файлов на сторонние хостинги обратите внимание на срок хранения файлов. Файлы должны храниться до <b>21 Апреля 2019</b>!</li>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
