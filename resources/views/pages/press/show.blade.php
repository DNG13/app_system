@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Пресса. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div>
                                <label for="type_id" class="col-md-4">Тип заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id">{{ $press->type->title }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="media_name" class="col-md-4">Наименование СМИ/никнейм</label>
                                <div class="col-md-6">
                                    <p id="media_name">{{ $press->media_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="type_id" class="col-md-4">Статус заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id">{{ $press->status}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="contact_name" class="col-md-4">Контактное лицо</label>
                                <div class="col-md-6">
                                    <p id="contact_name">{{ $press->contact_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="city" class="col-md-4">Город</label>
                                <div class="col-md-6">
                                    <p id="city">{{ $press->city }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="col-md-4">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone">{{ $press->phone }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="portfolio_link" class="col-md-4">Ссылка на портфолио</label>
                                <div class="col-md-6">
                                    <p id="portfolio_link">{{ $press->portfolio_link }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="camera" class="col-md-4">Модель камеры</label>
                                <div class="col-md-6">
                                    <p id="camera">{{ $press->camera }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="members_count" class="col-md-4">Количество представителей</label>
                                <div class="col-md-6">
                                    <p id="members_count">{{ $press->members_count }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="equipment" class="col-md-4">Доп. техника</label>
                                <div class="col-md-6">
                                    <p id="equipment">{{ $press->equipment }}</p>
                                </div>
                            </div>

                            @if(!$social_links->vk==null)
                                <div>
                                    <label for="social_links[vk]" class="col-md-4">VK</label>
                                    <div class="col-md-6">
                                        <p id="social_links[vk]"> {{ $social_links->vk}}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$social_links->fb==null)
                                <div>
                                    <label for="social_links[fb]" class="col-md-4">Facebook</label>
                                    <div class="col-md-6">
                                        <p id="social_links[fb]"> {{$social_links->fb }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$social_links->sk==null)
                                <div>
                                    <label for="social_links[sk]" class="col-md-4">Skype</label>
                                    <div class="col-md-6">
                                        <p id="social_links[sk]"> {{ $social_links->fb }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!($social_links->tg)==null)
                                <div>
                                    <label for="social_links[tg]" class="col-md-4">Telegram</label>
                                    <div class="col-md-6">
                                        <p id="social_links[tg]">{{ $social_links->tg }}</p>
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
                                            @elseif($attribute=='duty')
                                                <div>
                                                    <label  class="col-md-4">Обязанности на фестивале</label>
                                                    <div class="col-md-6">
                                                        <p  id="members[{{$count}}][duty]" class="name_list">{{ $data }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <div class="col-md-12">
                                    <a href="/press/{{ $press->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="panel panel-warning">
                <div class="panel-heading">Файли заявки( {{count($files)}} )
                    @if(Auth::user()->isAdmin())
                        <div>
                            <a href="/create-zip?download=zip&app_id={{$press->id}}&app_kind=press" class="btn btn-info" >Скачать <i class="fa fa-download" aria-hidden="true"></i></a>
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
                                            <li>размеры файлов не более 10 мегабайт</li>
                                            <li>видео и большие файлы (>10 мегабайт) рекомендуем загружать на другие хостинги <i class="fa fa-cloud-download" aria-hidden="true"></i> (Youtube, dropbox) и оставлять ссылку в комментариях</li>
                                            <li>файлы менее 10 мегабайт загружайте в систему заявок.</li>
                                            <li><i class="fa fa-file-image-o" aria-hidden="true"></i> возвожные форматы картинок/фото: jpeg,jpg,png</li>
                                            <li><i class="fa fa-file-audio-o" aria-hidden="true"></i> возвожные аудио форматы: ogg, mp3, wav, wma, mid, flac, aac, alac, ac3, m4a, aif, iff, m3u, mpa, ra</li>
                                            <li><i class="fa fa-file-o" aria-hidden="true"></i> возвожные форматы документов: doc, rtf, pdf, docx, sxw, txt, odt </li>
                                            <li>при загрузке файлов на сторонние хостинги обратите внимание на срок хранения файлов. Файлы должны храниться до <b>30 Апреля 2018</b>!</li>
                                            <li>eсли вам необходимо удалить файл, обратитесь к Организаторам, мы все сделаем!</li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @if(!count($files)==0)
                        @foreach($files as $file)
                            <div class="col-md-2" style="width: 225px; height:150px;">
                                <a href="/{{$file->link}}">
                                    @if($file->type == 'image')
                                        <img src="/{{$file->thumbnail_link}}">
                                    @elseif($file->type == 'audio')
                                        <i class="fa fa-file-audio-o fa-5x" aria-hidden="true"></i>
                                    @elseif($file->type == 'document')
                                        <i class="fa fa-file-o fa-5x" aria-hidden="true"></i>
                                    @endif
                                </a>
                                @if(Auth::user()->isAdmin())
                                    <a title="Удалить file" href="/file/delete?id={{ $file->id }}&app_id={{$press->id}}&app_kind=press">
                                        <div class="btn btn-danger">
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

            <div class="panel panel-info">
                <div class="panel-heading">Коментарии заявки( {{count($comments)}} )</div>
                <div class="panel-body">
                    @if(!count($comments)==0)
                        @foreach($comments as $comment)
                            <div>
                                <label for="comment" class="col-md-3">
                                    {{ $comment->profile->nickname }}
                                    <small>{{ date('j/n/Y H:i', strtotime($comment->created_at ))}}</small> </label>
                                <div class="col-md-8">
                                    <p  id="comment">{{ $comment->text }}</p>
                                </div>
                                @if(Auth::user()->isAdmin())
                                <a class="col-md-1" title="Удалить комментарий" href="/comment/delete?id={{ $comment->id }}&app_id={{$press->id}}&app_kind=press">
                                    <div class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </div>
                                </a>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <form method="POST" action="{{ url('/comment/create')}}">
                        {{ csrf_field() }}
                        <div>
                            <label for="comment" class="col-md-3">
                                Добавить комментарий</label>
                            <div class="col-md-8 form-group">
                                <textarea  class="form-control" style="overflow:hidden" id="comment" name="text" required></textarea>
                                <input type="hidden" name="app_kind" value="press">
                                <input type="hidden" name="app_id" value="{{$press->id}}">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary" title="Добавить коментарий"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
