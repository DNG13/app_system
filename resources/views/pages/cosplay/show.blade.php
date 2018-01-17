@extends('layouts.app')

@section('title', 'Кослей(посмотреть)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Косплей-шоу. Подробнее</div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div>
                            <label for="type_id" class="col-md-4">Тип заявки</label>
                            <div class="col-md-6">
                                <p id="type_id" >{{ $cosplay->type->title }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="group_nick" class="col-md-4">Название команды/ник выступающего</label>
                            <div class="col-md-6">
                                <p id="group_nick">{{ $cosplay->group_nick }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="title" class="col-md-4">Название постановки</label>
                            <div class="col-md-6">
                                <p id="title">{{ $cosplay->title }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="type_id" class="col-md-4">Статус заявки</label>
                            <div class="col-md-6">
                                <p id="type_id">{{ $cosplay->status}}</p>
                            </div>
                        </div>

                        <div>
                            <label for="fandom" class="col-md-4">Источник (фендом)</label>
                            <div class="col-md-6">
                                <p id="fandom">{{ $cosplay->fandom }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="length" class="col-md-4">Продолжительность(минут)</label>
                            <div class="col-md-6">
                                <p id="length">{{ $cosplay->length }}</p>
                            </div>
                        </div>

                        <div class="form-group{">
                            <label for="city" class="col-md-4">Город</label>
                            <div class="col-md-6">
                                <p id="city">{{ $cosplay->city }}</p>
                            </div>
                        </div>

                        @if(!$cosplay->prev_part==null)
                            <div>
                                <label for="prev_part" class="col-md-4">Предыдущее участие</label>
                                <div class="col-md-6">
                                    <p id="prev_part">{{ $cosplay->prev_part }}</p>
                                </div>
                            </div>
                        @endif

                        @if(!$cosplay->props==null)
                            <div>
                                <label for="props" class="col-md-4">Реквизит</label>
                                <div class="col-md-6">
                                    <p  id="props">{{ $cosplay->props }}</p>
                                </div>
                            </div>
                        @endif

                        <div>
                            <label for="description" class="col-md-4">Описание</label>
                            <div class="col-md-6">
                                <p  id="description">{{ $cosplay->description }}</p>
                            </div>
                        </div>

                        @if(!$cosplay->comment==null)
                            <div>
                                <label for="comment" class="col-md-4">Коментарий</label>
                                <div class="col-md-6">
                                    <p  id="comment">{{ $cosplay->comment }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12"><h4>Участники</h4></div>
                        <div id="dynamic_field">
                            <div class="members" id="row0">
                                @foreach($members as $member=>$attributes)
                                    @foreach($attributes as $attribute=>$data)
                                        @if($attribute=='surname')
                                            <div>
                                                <label  class="col-md-4">Участник {{++$count}}: Фамилия</label>
                                                <div class="col-md-6">
                                                    <p  id="members[{{$count}}][surname]" class="name_list">{{ $data }}</p>
                                                </div>
                                            </div>
                                        @elseif($attribute=='first_name')
                                            <div>
                                                <label  class="col-md-4">Имя</label>
                                                <div class="col-md-6">
                                                    <p  id="members[{{$count}}][first_name]" class="name_list">{{ $data }}</p>
                                                </div>
                                            </div>
                                        @elseif($attribute=='character')
                                            <div>
                                                <label  class="col-md-4">Персонаж</label>
                                                <div class="col-md-6">
                                                    <p  id="members[{{$count}}][character]" class="name_list">{{ $data }}</p>
                                                </div>
                                            </div>
                                        @elseif($attribute=='birthday')
                                            <div>
                                                <label  class="col-md-4">Дата рождения</label>
                                                <div class="col-md-6">
                                                    <p  id="members[{{$count}}][birthday]" class="name_list">{{ date('j F, Y ', strtotime($data)) }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <div class="col-md-12">
                                <a href="/cosplay/{{ $cosplay->id }}/edit" class="btn btn-info" role="button">Редактировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Файли заявки( {{count($files)}} )
                    @if(Auth::user()->isAdmin())
                        <div>
                            <a href="/create-zip?download=zip&app_id={{$cosplay->id}}&app_kind=cosplay" class="btn btn-info" >Скачать <i class="fa fa-download" aria-hidden="true"></i></a>
                        </div>
                    @endif
                </div>

                <div class="panel-body">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#filter-panel">
                            <i class="fa fa-file" aria-hidden="true"></i> Добавить файлы
                        </button>
                        <div id="filter-panel" class="collapse filter-panel">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <ul>
                                        <li>Добавить файлы можно при редактировании заявки</li>
                                        <li>Технические ограничения:</li>
                                        <ul>
                                            <li>названия файлов должны быть выполнены латиницей и не содержать пробелов (scenraio_defile.doc)</li>
                                            <li>размеры файлов не более 10 мегабайт</li>
                                            <li>видео и большие файлы (>10 мегабайт) рекомендуем загружать на другие хостинги <i class="fa fa-cloud-download" aria-hidden="true"></i> (Youtube, dropbox) и оставлять ссылку в комментариях</li>
                                            <li>файлы менее 10 мегабайт загружайте в систему заявок.</li>
                                            <li>при загрузке файлов на сторонние хостинги обратите внимание на срок хранения файлов. Файлы должны храниться до <b>30 Апреля 2018</b>!</li>
                                            <li>eсли вам необходимо удалить файл, обратитесь к Организаторам, мы все сделаем!</li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!count($files)==0)
                        @foreach($files as $file)
                            <div class="col-md-2" style="width: 225px; height:150px;">
                                <a href="/{{$file->link}}">
                                    @if($file->type == 'image')
                                        <img src="/{{$file->thumbnail_link}}">
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
                                @if(Auth::user()->isAdmin())
                                    <a title="Удалить file" href="/file/delete?id={{ $file->id }}&app_id={{$cosplay->id}}&app_kind=cosplay">
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
                <div class="panel-heading">Коментарии заявки( {{count($comments)}} )</div>
                <div class="panel-body">
                    @if(!count($comments)==0)
                        <ul class="list-group col-md-12">
                            @foreach($comments as $comment)
                                <li class="list-group-item col-md-12"  @if($comment->role)@if($comment->role->key =='admin') style="background:beige;" @endif @endif>
                                    <div>
                                        <label for="comment" class="col-md-3" style="color:darkslategrey;">
                                            <small> @if($comment->role)@if($comment->role->key =='admin')Координатор  @endif @endif
                                           {{ $comment->profile->nickname }}
                                             <br>{{ date('j/n/Y H:i', strtotime($comment->created_at ))}}</small>
                                        </label>
                                        <div class="col-md-8">
                                            <p style="font-weight:bolder" id="comment">{{ $comment->text }}</p>
                                        </div>
                                        @if(Auth::user()->isAdmin())
                                        <a class="col-md-1" title="Удалить комментарий" href="/comment/delete?id={{ $comment->id }}&app_id={{$cosplay->id}}&app_kind=cosplay">
                                            <div class="btn btn-default">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                <form method="POST" action="{{ url('/comment/create')}}">
                    {{ csrf_field() }}
                    <div>
                        <label for="comment" class="col-md-3">
                            Добавить комментарий</label>
                        <div class="col-md-7 form-group">
                            <textarea  class="form-control" style="overflow:hidden" id="comment" name="text" required></textarea>
                            <input type="hidden" name="app_kind" value="cosplay">
                            <input type="hidden" name="app_id" value="{{$cosplay->id}}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info">Отправить</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
