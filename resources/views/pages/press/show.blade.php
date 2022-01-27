@extends('layouts.app')

@section('title', 'Преса(переглянути)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Преса. Детальніше</div>

                <div class="panel-body">
                        <div class="form-horizontal">

                            <div>
                                <label for="type_id" class="col-md-4">Тип заявки</label>
                                <div class="col-md-8">
                                    <p id="type_id">{{ $press->type->title }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="media_name" class="col-md-4">Найменування ЗМІ/нікнейм</label>
                                <div class="col-md-8">
                                    <p id="media_name">{{ $press->media_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="type_id" class="col-md-4">Статус заявки</label>
                                <div class="col-md-8">
                                    <p id="type_id">{{ $press->getStatusText()}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="contact_name" class="col-md-4">Контактна особа</label>
                                <div class="col-md-8">
                                    <p id="contact_name">{{ $press->contact_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="city" class="col-md-4">Місто</label>
                                <div class="col-md-8">
                                    <p id="city">{{ $press->city }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="col-md-4">Телефон</label>
                                <div class="col-md-8">
                                    <p id="phone">{{ $press->phone }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="social_link" class="col-md-4">Посилання на особисту сторінку</label>
                                <div class="col-md-8">
                                    <p id="social_link">{{ $press->social_link }}</p>
                                </div>
                            </div>

                            @if((!empty($press->social_links)))
                                <div class="col-md-12"><h4>Соцмережі</h4></div>
                                <div class="col-md-12"><hr></div>

                                @if((!empty($press->social_links['tg'])))
                                    <div>
                                        <label for="social_links['tg']" class="col-md-4">Telegram</label>
                                        <div class="col-md-8">
                                            <p id="social_links['tg']">{{ $press->social_links['tg'] }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if((!empty($press->social_links['fb'])))
                                    <div>
                                        <label for="social_links['fb']" class="col-md-4">Facebook</label>
                                        <div class="col-md-8">
                                            <p id="social_links['fb']">{{ $press->social_links['fb'] }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if((!empty($press->social_links['insta'])))
                                    <div>
                                        <label for="social_links['insta']" class="col-md-4">Instagram</label>
                                        <div class="col-md-8">
                                            <p id="social_links['insta']">{{ $press->social_links['insta'] }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if((!empty($press->social_links['tumblr'])))
                                    <div>
                                        <label for="social_links['tumblr']" class="col-md-4">Tumbler</label>
                                        <div class="col-md-8">
                                            <p id="social_links['tumblr']">{{ $press->social_links['tumblr'] }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12"><hr></div>
                            @endif

                            @if(!$press->prev_part==null)
                                <div>
                                    <label for="prev_part" class="col-md-4">Попередня участь</label>
                                    <div class="col-md-8">
                                        <p id="prev_part">{{ $press->prev_part }}</p>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <label for="portfolio_link" class="col-md-4">Посилання на портфоліо</label>
                                <div class="col-md-8">
                                    <p id="portfolio_link">{{ $press->portfolio_link }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="camera" class="col-md-4">Модель камери</label>
                                <div class="col-md-8">
                                    <p id="camera">{{ $press->camera }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="equipment" class="col-md-4">Дод. техника</label>
                                <div class="col-md-8">
                                    <p id="equipment">{{ $press->equipment }}</p>
                                </div>
                            </div>

                            <div class="col-md-12"><h4>Учасники</h4></div>
                            <div id="dynamic_field">
                                @foreach($members as $member=>$attributes)
                                    <div class="members" id="row{{ ++$count}}">
                                        <div class="col-md-12"><hr></div>
                                        @foreach($attributes as $attribute=>$data)
                                            @if($attribute=='surname')
                                                <div>
                                                    <label  class="col-md-4">Прізвище</label>
                                                    <div class="col-md-8">
                                                        <p  id="members[{{$count}}][surname]" class="name_list">{{ $data }}</p>
                                                    </div>
                                                </div>
                                            @elseif($attribute=='first_name')
                                                <div>
                                                    <label  class="col-md-4">Ім'я</label>
                                                    <div class="col-md-8">
                                                        <p  id="members[{{$count}}][first_name]" class="name_list">{{ $data }}</p>
                                                    </div>
                                                </div>
                                            @elseif($attribute=='duty')
                                                <div>
                                                    <label  class="col-md-4">Діяльність на фестивалі</label>
                                                    <div class="col-md-8">
                                                        <p  id="members[{{$count}}][duty]" class="name_list">{{ $data }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            <div>
                                <div class="col-md-12">
                                    <a href="/press/{{ $press->id }}/edit" class="btn btn-info" role="button">Редагувати</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Файли заявки( {{count($files)}} )
                    @if(Auth::user()->isAdmin())
                        <div>
                            <a href="/create-zip?download=zip&app_id={{$press->id}}&app_kind=press" class="btn btn-info" >Завантажити <i class="fa fa-download" aria-hidden="true"></i></a>
                        </div>
                    @endif
                </div>

                <div class="panel-body">
                    <div>
                        <button type="button" class="btn btn-info filter" data-toggle="collapse" data-target="#filter-panel">
                            <i class="fa fa-file" aria-hidden="true"></i> Додати файли
                        </button>
                        <div id="filter-panel" class="collapse filter-panel">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <ul>
                                        <li>Додати файли можна під час редагування заявки</li>
                                        <li>Технічні обмеження:</li>
                                        <ul>
                                            <li>розміри файлів не більше 20 мегабайт</li>
                                            <li>відео та великі файли (>20 мегабайт) рекомендуємо завантажувати на інші хостинги <i class="fa fa-cloud-download" aria-hidden="true"></i> (Youtube, dropbox) та залишати посилання в коментарях</li>
                                            <li>файли менше 20 мегабайт завантажуйте в систему заявок.</li>
                                            <li>завантажуючи файли на сторонні хостинги, зверніть увагу на термін зберігання файлів. Файли повинні зберігатися до дня фестивалю (включно)!</b>!</li>
                                            <li>якщо вам потрібно видалити файл, зверніться до Організаторів, ми все зробимо!</li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!count($files)==0)
                        @foreach($files as $file)
                            <div class="col-md-2" style="width: 225px; height:150px;">
                                <a href="/storage/{{$file->name}}">
                                    @if($file->type == 'image')
                                        <img  src="/storage/{{$file->id}}/thumbnail">
                                    @elseif($file->type == 'audio')
                                        <i class="fa fa-file-audio-o fa-5x" aria-hidden="true"></i>
                                    @elseif($file->type == 'video')
                                        <i class="fa fa-file-video-o fa-5x" aria-hidden="true"></i>
                                    @elseif($file->type == 'document')
                                        <i class="ffa fa-file-text-o fa-5x" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-file-o fa-5x" aria-hidden="true"></i>
                                    @endif
                                </a>
                                @if(Auth::user()->isAdmin())
                                    <a title="Удалить file" href="/file/delete?id={{ $file->id }}&app_id={{$press->id}}&app_kind=press">
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
                <div class="panel-heading">Коментарі заявки( {{count($comments)}} )</div>
                <div class="panel-body">
                    @if(!count($comments)==0)
                        <ul class="list-group col-md-12">
                            @foreach($comments as $comment)
                                <li class="list-group-item col-md-12"  @if($comment->role)@if($comment->role->key =='admin') style="background:beige;" @endif @endif>
                                    <div>
                                        <label for="comment" class="col-md-3" style="color:darkslategrey;">
                                            <small style="white-space: pre-line;"> @if($comment->role)@if($comment->role->key =='admin')@if($comment->avatar)<img width="30" src="/storage/{{$comment->avatar->user_id}}/avatar"/>@endif Координатор  @endif @endif
                                                {{ $comment->profile->nickname }}
                                                <br>{{ date('j/n/Y H:i', strtotime($comment->created_at ))}}</small>
                                        </label>
                                        <div class="col-md-8">
                                            <p style="font-weight:bolder" id="comment">{{ $comment->text }}</p>
                                        </div>
                                        @if(Auth::user()->isAdmin())
                                            <a class="col-md-1" title="Видалити коментар" href="/comment/delete?id={{ $comment->id }}&app_id={{$press->id}}&app_kind=press">
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
                        @if ($press->status != \App\Models\AppPress::APP_STATUS_REJECTED)
                    <form method="POST" action="{{ url('/comment/create')}}">
                            {{ csrf_field() }}
                            <div>
                                <label for="comment" class="col-md-3">
                                    Додати коментар</label>
                                <div class="col-md-7 form-group">
                                    <textarea  class="form-control" style="overflow:hidden" id="comment" name="text" required></textarea>
                                    <input type="hidden" name="app_kind" value="press">
                                    <input type="hidden" name="app_id" value="{{$press->id}}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-info">Відправити</button>
                                </div>
                            </div>
                        </form>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection
