@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Ярмарка. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div>
                                <label for="type_id" class="col-md-4">Тип заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id">{{ $fair->type->title }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="group_nick" class="col-md-4">Hазвание группы/ник</label>
                                <div class="col-md-6">
                                    <p id="group_nick">{{ $fair->group_nick }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="type_id" class="col-md-4">Статус заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id">{{ $fair->status}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="contact_name" class="col-md-4">Контактное лицо</label>
                                <div class="col-md-6">
                                    <p id="contact_name">{{ $fair->contact_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="city" class="col-md-4">Город</label>
                                <div class="col-md-6">
                                    <p id="city">{{ $fair->city }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="col-md-4">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone">{{ $fair->phone }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="social_link" class="col-md-4">Ссылка на личную страницу в соцсети</label>
                                <div class="col-md-6">
                                    <p id="social_link">{{ $fair->social_link }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="group_link" class="col-md-4">Ссылка на сайт или группу в соцсетях</label>
                                <div class="col-md-6">
                                    <p id="group_link">{{ $fair->group_link }}</p>
                                </div>
                            </div>

                            @if(!$fair->square==null)
                                <div>
                                    <label for="square" class="col-md-4">Размер торгово-развлекательной точки</label>
                                    <div class="col-md-6">
                                        <p id="square">{{ $fair->square }}</p>
                                    </div>
                                </div>
                            @endif

                            <div>
                                @if(!$equipment->table==null)
                                    <div>
                                        <label for="equipment[table]" class="col-md-4">Оборудование: Количество столов</label>
                                        <div class="col-md-6">
                                            <p id="equipment[table]">{{ $equipment->table }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if(!$equipment->chair==null)
                                    <div>
                                        <label for="equipment[chair]" class="col-md-4">Количество стульев</label>
                                        <div class="col-md-6">
                                            <p id="equipment[chair]">{{ $equipment->chair }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if(!$equipment->extra==null)
                                        <div>
                                            <label for="equipment[extra]" class="col-md-4">Дополнительное оборудование с размерами</label>
                                            <div class="col-md-6">
                                                <p id="equipment[extra]">{{ $equipment->extra }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!$equipment->electricity==null)
                                    <div>
                                        <label for="equipment[electricity]" class="col-md-4">Надобность подведения электричества</label>
                                        <div class="col-md-6">
                                            <p id="equipment[electricity]">{{ $equipment->electricity }}</p>
                                        </div>
                                    </div>
                                    @endif
                            </div>

                            <div >
                                <label for="payment_type" class="col-md-4">Способ оплаты</label>
                                <div class="col-md-6">
                                    <p id="square">{{ $fair->payment_type }}</p>
                                </div>
                            </div>
                            <div>
                                <label for="description" class="col-md-4">Описание</label>
                                <div class="col-md-6">
                                    <p id="description">{{ $fair->description }}</p>
                                </div>
                            </div>

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
                                    <a href="/fair/{{ $fair->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>

            <div class="panel panel-warning">
                <div class="panel-heading">Файли заявки( {{count($files)}} )
                    @if(Auth::user()->isAdmin())
                        <div>
                            <a href="/create-zip?download=zip&app_id={{$fair->id}}&app_kind=fair" class="btn btn-info" >Скачать <i class="fa fa-download" aria-hidden="true"></i></a>
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
                                        <i class="fa fa-file-text-o fa-5x" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-file-o fa-5x" aria-hidden="true"></i>
                                    @endif
                                </a>
                                @if(Auth::user()->isAdmin())
                                    <a title="Удалить file" href="/file/delete?id={{ $file->id }}&app_id={{$fair->id}}&app_kind=fair">
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
                                <a class="col-md-1" title="Удалить комментарий" href="/comment/delete?id={{ $comment->id }}&app_id={{$fair->id}}&app_kind=fair">
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
                                <input type="hidden" name="app_kind" value="fair">
                                <input type="hidden" name="app_id" value="{{$fair->id}}">
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
