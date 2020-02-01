@extends('layouts.app')

@section('title', 'Персса(редактировать)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Редактирование  заявки персса</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('press.update', $press->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-8">
                                    <select id="type_id" class="form-control" name="type_id">
                                        @foreach($types as $key=>$type)
                                            @if($key == $press->type_id)
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
                                        @if(!empty($press->status))
                                            <option selected value="{{$press->status}}">{{$press->status}}</option>
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

                            <div class="form-group{{ $errors->has('media_name') ? ' has-error' : '' }}">
                                <label for="media_name" class="col-md-4 control-label">Наименование СМИ/никнейм</label>

                                <div class="col-md-8">
                                    <input id="media_name" type="text" class="form-control" name="media_name" value="{{ $press->media_name }}" required autofocus>

                                    @if ($errors->has('media_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('media_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="contact_name" class="col-md-4 control-label">Контактное лицо</label>
                                <div class="col-md-8">
                                    <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ $press->contact_name }}" required autofocus>

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
                                    <input id="city" placeholder="Населенный пункт" type="text" class="form-control" name="city" value="{{ $press->city }}" required autofocus>

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
                                    <input id="phone" pattern='[\+]\d{3}[0-9]{9}'  placeholder="+380000000000" type="tel" class="form-control" name="phone" value="{{ $press->phone }}" required autofocus>

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
                                    <input id="social_link" type="text" class="form-control" name="social_link" value="{{$press->social_link }}" placeholder="vk, fb или tg для связи с ответственным по заявке" required autofocus>

                                    @if ($errors->has('social_link'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('social_link') }}</strong>
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
                                                <input id="social_links[vk]" type="text" value="{{ $press->social_links['vk'] ?? '' }}"
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
                                                <input id="social_links[fb]" type="text" value="{{ $press->social_links['fb'] ?? '' }}"
                                                       class="form-control" name="social_links[fb]" autofocus>
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
                                                <input id="social_links[insta]" type="text" value="{{ $press->social_links['insta'] ?? '' }}"
                                                       class="form-control" name="social_links[insta]" autofocus>
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
                                                <input id="social_links[tg]" type="text" value="{{ $press->social_links['tg'] ?? '' }}"
                                                       class="form-control" name="social_links[tg]" autofocus>
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
                                                <input id="social_links[tumblr]" type="text" value="{{ $press->social_links['tumblr'] ?? '' }}"
                                                       class="form-control" name="social_links[tumblr]" autofocus>
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

                            <div class="form-group{{ $errors->has('prev_part') ? ' has-error' : '' }}">
                                <label for="prev_part" class="col-md-4 control-label">Предыдущее участие</label>
                                <div class="col-md-8">
                                    <textarea id="prev_part"  class="form-control" placeholder="Ваше участие в качестве СМИ в фестивалях. Желательно со ссылками на фото/видео/статьи" name="prev_part" autofocus>{{ $press->prev_part }}</textarea>

                                    @if ($errors->has('prev_part'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prev_part') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('portfolio_link') ? ' has-error' : '' }}">
                                <label for="portfolio_link" class="col-md-4 control-label">Ссылка на портфолио</label>

                                <div class="col-md-8">
                                    <input id="portfolio_link" type="text" class="form-control" name="portfolio_link" value="{{ $press->portfolio_link }}" required autofocus>

                                    @if ($errors->has('portfolio_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('portfolio_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('camera') ? ' has-error' : '' }}">
                                <label for="camera" class="col-md-4 control-label">Модель камеры</label>
                                <div class="col-md-8">
                                    <input id="camera" type="text" class="form-control" name="camera" value="{{ $press->camera }}" autofocus>

                                    @if ($errors->has('camera'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('camera') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('equipment') ? ' has-error' : '' }}">
                                <label for="equipment" class="col-md-4 control-label">Доп. техника</label>
                                <div class="col-md-8">
                                    <textarea  id="equipment" rows="5" class="form-control" name="equipment"  autofocus required>{{ $press->equipment }}</textarea>

                                    @if ($errors->has('equipment'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('equipment') }}</strong>
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
                                                    <label  class="col-md-4 control-label">Фамилия</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="members[{{$count}}][surname]" class="form-control name_list" required value="{{ $data }}"/>
                                                    </div>
                                                </div>
                                            @elseif($attribute=='first_name')
                                                <div class="form-group">
                                                    <label  class="col-md-4 control-label">Имя</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="members[{{$count}}][first_name]" class="form-control name_list" required value="{{ $data }}"/>
                                                    </div>
                                                </div>
                                            @elseif($attribute=='duty')
                                                <div class="form-group">
                                                    <label  class="col-md-4 control-label">Деятельность на фестивале</label>
                                                    <div class="col-md-7">
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
                                var postURL = "<?php echo url('expo/edit'); ?>";
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
                                        '<input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/>' +
                                        '</div>' +
                                        '</div>'+
                                        '<div class="form-group">' +
                                        '<label class="col-md-4 control-label">Деятельность на фестивале</label>' +
                                        '<div class="col-md-7">' +
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
                                    <li>при загрузке файлов на сторонние хостинги обратите внимание на срок хранения файлов. Файлы должны храниться до <b>дня фестиваля (включительно)</b>!</li>
                                    <li>eсли вам необходимо удалить файл, обратитесь к Организаторам, мы все сделаем!</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form action="{{ url('/upload') }}" enctype="multipart/form-data" method="post" class="dropzone" id="my-awesome-dropzone">
                        {{ csrf_field() }}
                        <div class="dz-message" data-dz-message><span>Кликните здесь мышью или перенесите файлы, чтобы загрузить</span></div>
                        <input type="hidden" name="app_kind" value="press">
                        <input type="hidden" name="app_id" value="{{$press->id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection