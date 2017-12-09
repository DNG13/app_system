@extends('layouts.app')

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

                        @if(!$cosplay->comment==null)
                            <div>
                                <label for="prev_part" class="col-md-4">Предыдущее участие</label>
                                <div class="col-md-6">
                                    <p id="prev_part">{{ $cosplay->comment }}</p>
                                </div>
                            </div>
                        @endif

                        @if(!$cosplay->comment==null)
                            <div>
                                <label for="comment" class="col-md-4">Коментарий</label>
                                <div class="col-md-6">
                                    <p  id="comment">{{ $cosplay->comment }}</p>
                                </div>
                            </div>
                        @endif

                        <div>
                            <label for="description" class="col-md-4">Описание</label>
                            <div class="col-md-6">
                                <p  id="description">{{ $cosplay->description }}</p>
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
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/cosplay/{{ $cosplay->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">Коментарии заявки( количество {{count($comments)}} )</div>
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
                            <a class="col-md-1" title="Удалить комментарий" href="/comment/delete?id={{ $comment->id }}&app_id={{$cosplay->id}}&app_kind=cosplay">
                                <div class="btn btn-danger">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                <form method="POST" action="{{ url('/comment/create')}}">
                    {{ csrf_field() }}
                    <div>
                        <label for="comment" class="col-md-3">
                            Добавить комментарий</label>
                        <div class="col-md-8">
                            <textarea  id="comment" cols="100" name="text" required></textarea>
                            <input type="hidden" name="app_kind" value="cosplay">
                            <input type="hidden" name="app_id" value="{{$cosplay->id}}">
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
