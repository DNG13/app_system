@extends('layouts.app')

@section('title', 'Косплей(переглянути)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Заявка на Косплей-шоу.</div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div>
                            <label for="type_id" class="col-md-4">Тип заявки</label>
                            <div class="col-md-8">
                                <p id="type_id" >{{ $cosplay->type->title }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="group_nick" class="col-md-4">Назва команди/нік виступаючого</label>
                            <div class="col-md-8">
                                <p id="group_nick">{{ $cosplay->group_nick }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="title" class="col-md-4">Назва постановки</label>
                            <div class="col-md-8">
                                <p id="title">{{ $cosplay->title }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="type_id" class="col-md-4">Статус заявки</label>
                            <div class="col-md-8">
                                <p id="type_id">{{ $cosplay->status}}</p>
                            </div>
                        </div>

                        <div>
                            <label for="fandom" class="col-md-4">Джерело (фендом)</label>
                            <div class="col-md-8">
                                <p id="fandom">{{ $cosplay->fandom }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="length" class="col-md-4">Тривалість(хвилин)</label>
                            <div class="col-md-8">
                                <p id="length">{{ $cosplay->length }}</p>
                            </div>
                        </div>

                        <div class="form-group{">
                            <label for="city" class="col-md-4">Місто</label>
                            <div class="col-md-8">
                                <p id="city">{{ $cosplay->city }}</p>
                            </div>
                        </div>

                        @if(!$cosplay->prev_part==null)
                            <div>
                                <label for="prev_part" class="col-md-4">Попередня участь</label>
                                <div class="col-md-8">
                                    <p id="prev_part">{{ $cosplay->prev_part }}</p>
                                </div>
                            </div>
                        @endif

                        @if(!$cosplay->props==null)
                            <div>
                                <label for="props" class="col-md-4">Реквізит</label>
                                <div class="col-md-8">
                                    <p  id="props">{{ $cosplay->props }}</p>
                                </div>
                            </div>
                        @endif

                        <div>
                            <label for="description" class="col-md-4">Опис</label>
                            <div class="col-md-8">
                                <p  id="description">{{ $cosplay->description }}</p>
                            </div>
                        </div>

                        @if(!$cosplay->comment==null)
                            <div>
                                <label for="comment" class="col-md-4">Примітки</label>
                                <div class="col-md-8">
                                    <p  id="comment">{{ $cosplay->comment }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12"><h4>Учасники</h4></div>
                        <div id="dynamic_field">
                            @foreach($members as $member=>$attributes)
                                <div class="members" id="row{{ ++$count}}">
                                    <div class="col-md-12"><hr></div>
                                    <div>
                                        <label  class="col-md-4">Прізвище</label>
                                        <div class="col-md-8">
                                            <p  id="members[{{$count}}][surname]" class="name_list">{{ $attributes->surname ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <label  class="col-md-4">Ім'я</label>
                                        <div class="col-md-8">
                                            <p  id="members[{{$count}}][first_name]" class="name_list">{{ $attributes->first_name ?? ''}}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <label  class="col-md-4">Персонаж</label>
                                        <div class="col-md-8">
                                            <p  id="members[{{$count}}][character]" class="name_list">{{ $attributes->character ?? ''}}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <label  class="col-md-4">Вік</label>
                                        <div class="col-md-8">
                                            <p id="members[{{$count}}][age]" class="name_list">{{ $attributes->age ?? ''}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <div style="margin-top:15px;" class="col-md-12">
                                <a href="/cosplay/{{ $cosplay->id }}/edit" class="btn btn-info" role="button">Редагувати</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Файли заявки( {{count($files)}} )
                    @if(Auth::user()->isAdmin())
                        <div>
                            <a href="/create-zip?download=zip&app_id={{$cosplay->id}}&app_kind=cosplay" class="btn btn-info" >Завантажити <i class="fa fa-download" aria-hidden="true"></i></a>
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
                                <div>{{$file->name}}</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Коментарі заявки( {{count($comments)}} )</div>
                <div class="panel-body">
                    @if(count($comments))
                        <ul class="list-group col-md-12">
                            @foreach($comments as $comment)
                                <li class="list-group-item col-md-12"  @if($comment->role && $comment->role->key =='admin') style="background:beige;" @endif>
                                    <div>
                                        <label for="comment" class="col-md-3" style="color:darkslategrey;">
                                            <small style="white-space: pre-line;">
                                                @if($comment->role && $comment->role->key =='admin')
                                                    @if($comment->avatar)
                                                        <img width="30" src="/storage/{{$comment->avatar->user_id}}/avatar"/>
                                                    @endif
                                                    Координатор
                                                @endif
                                           {{ $comment->profile->nickname }}
                                             <br>{{ date('j/n/Y H:i', strtotime($comment->created_at ))}}</small>
                                        </label>
                                        <div class="col-md-8">
                                            <p style="font-weight:bolder" id="comment">{{ $comment->text }}</p>
                                        </div>
                                        @if(Auth::user()->isAdmin())
                                        <a class="col-md-1" title="Видалити коментар" href="/comment/delete?id={{ $comment->id }}&app_id={{$cosplay->id}}&app_kind=cosplay">
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
                    @if ($cosplay->status != 'Отклонена')
                        <form method="POST" action="{{ url('/comment/create')}}">
                            {{ csrf_field() }}
                            <div>
                                <label for="comment" class="col-md-3">
                                    Додати коментар</label>
                                <div class="col-md-7 form-group">
                                    <textarea  class="form-control" style="overflow:hidden" id="comment" name="text" required></textarea>
                                    <input type="hidden" name="app_kind" value="cosplay">
                                    <input type="hidden" name="app_id" value="{{$cosplay->id}}">
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
