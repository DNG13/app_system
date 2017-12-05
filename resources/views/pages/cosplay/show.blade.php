@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Косплей-шоу. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id"  class="form-control">{{ $cosplay->type->title }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">Название постановки</label>
                                <div class="col-md-6">
                                    <p id="title"  class="form-control">{{ $cosplay->title }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fandom" class="col-md-4 control-label">Источник (фендом)</label>
                                <div class="col-md-6">
                                    <p id="fandom" class="form-control">{{ $cosplay->fandom }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="length" class="col-md-4 control-label">Продолжительность(минут)</label>
                                <div class="col-md-6">
                                    <p id="length"  class="form-control">{{ $cosplay->length }}</p>
                                </div>
                            </div>

                            <div class="form-group{">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <p id="city"  class="form-control">{{ $cosplay->city }}</p>
                                </div>
                            </div>

                            @if(!$cosplay->comment==null)
                            <div class="form-group">
                                <label for="prev_part" class="col-md-4 control-label">Предыдущее участие</label>
                                <div class="col-md-6">
                                    <p id="prev_part"  class="form-control">{{ $cosplay->comment }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!$cosplay->comment==null)
                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Коментарий</label>
                                <div class="col-md-6">
                                    <p  id="comment" class="form-control">{{ $cosplay->comment }}</p>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <p  id="description" class="form-control">{{ $cosplay->description }}</p>
                                </div>
                            </div>

                            <div style="text-align:center"><strong>Участники</strong></div>
                            <div id="dynamic_field">
                                <div class="members" id="row0">
                                    @foreach($members as $member=>$attributes)
                                        @foreach($attributes as $attribute=>$data)
                                        @if($attribute=='surname')
                                                    <div class="form-group">
                                                        <label  class="col-md-4 control-label">Участник {{++$count}}: Фамилия</label>
                                                        <div class="col-md-6">
                                                            <p  id="members[{{$count}}][surname]" class="form-control name_list">{{ $data }}</p>
                                                        </div>
                                                    </div>
                                        @elseif($attribute=='first_name')
                                                    <div class="form-group">
                                                        <label  class="col-md-4 control-label">Имя</label>
                                                        <div class="col-md-6">
                                                            <p  id="members[{{$count}}][first_name]" class="form-control name_list">{{ $data }}</p>
                                                        </div>
                                                    </div>
                                        @elseif($attribute=='birthday')
                                                    <div class="form-group">
                                                        <label  class="col-md-4 control-label">Дата рождения</label>
                                                        <div class="col-md-6">
                                                            <p  id="members[{{$count}}][birthday]" class="form-control name_list">{{ date('j F, Y ', strtotime($data)) }}</p>
                                                        </div>
                                                    </div>
                                        @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/cosplay/{{ $cosplay->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
                                </div>
                            </div>
                            @if(!count($comments)==0)
                                <div style="text-align:center"><strong>Коментарии заявки</strong></div>
                                @foreach($comments as $comment)
                                    <div class="form-group">
                                        <label for="comment" class="col-md-4 control-label">
                                            <strong>{{ $comment->profile->nickname }}</strong>
                                            <small>{{ date('j/n/Y H:i', strtotime($comment->created_at ))}}</small> </label>
                                        <div class="col-md-6">
                                            <p  id="comment" class="form-control">{{ $comment->text }}</p>
                                        </div>
                                        <a href="/comment/delete?id={{ $comment->id }}&app_id={{$cosplay->id}}&app_kind=cosplay">
                                            <div class="btn btn-danger">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ url('/comment/create')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="comment" class="col-md-4 control-label">
                                        Добавить комментарий</label>
                                    <div class="col-md-6">
                                        <textarea  id="comment" class="form-control" name="text" required></textarea>
                                    </div>
                                    <input type="hidden" name="app_kind" value="cosplay">
                                    <input type="hidden" name="app_id" value="{{$cosplay->id}}">
                                    <button type="submit" class="btn btn-primary" title=" Отправить коментарий"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
