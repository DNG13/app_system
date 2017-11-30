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
                                    <p id="type_id"  class="form-control" name="type_id">{{ $cosplay->type->title }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">Название постановки</label>
                                <div class="col-md-6">
                                    <p id="title"  class="form-control" name="title">{{ $cosplay->title }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fandom" class="col-md-4 control-label">Источник (фендом)</label>
                                <div class="col-md-6">
                                    <p id="fandom" class="form-control" name="fandom">{{ $cosplay->fandom }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="length" class="col-md-4 control-label">Продолжительность(минут)</label>
                                <div class="col-md-6">
                                    <p id="length"  class="form-control" name="length">{{ $cosplay->length }}</p>
                                </div>
                            </div>

                            <div class="form-group{">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <p id="city"  class="form-control" name="city">{{ $cosplay->city }}</p>
                                </div>
                            </div>

                            @if(!$cosplay->comment==null)
                            <div class="form-group">
                                <label for="prev_part" class="col-md-4 control-label">Предыдущее участие</label>
                                <div class="col-md-6">
                                    <p id="prev_part"  class="form-control" name="prev_part">{{ $cosplay->comment }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!$cosplay->comment==null)
                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Коментарий</label>
                                <div class="col-md-6">
                                    <p  id="comment" class="form-control" name="comment">{{ $cosplay->comment }}</p>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <p  id="description" class="form-control" name="description" required>{{ $cosplay->description }}</p>
                                </div>
                            </div>

                            <div style="text-align:center"><strong><h4>Участники</h4></strong></div>
                            <div id="dynamic_field">
                                <div class="members" id="row0">
                                    @foreach($members as $member=>$attributes)
                                        @foreach($attributes as $attribute=>$data)
                                        @if($attribute=='surname')
                                                    <div class="form-group">
                                                        <label  class="col-md-4 control-label">Участник {{++$count}}: Фамилия</label>
                                                        <div class="col-md-6">
                                                            <p  name="members[{{$count}}][surname]" class="form-control name_list" required>{{ $data }}</p>
                                                        </div>
                                                    </div>
                                        @elseif($attribute=='first_name')
                                                    <div class="form-group">
                                                        <label  class="col-md-4 control-label">Имя</label>
                                                        <div class="col-md-6">
                                                            <p  name="members[{{$count}}][first_name]" class="form-control name_list" required>{{ $data }}</p>
                                                        </div>
                                                    </div>
                                        @elseif($attribute=='birthday')
                                                    <div class="form-group">
                                                        <label  class="col-md-4 control-label">Дата рождения</label>
                                                        <div class="col-md-6">
                                                            <p  name="members[{{$count}}][birthday]" class="form-control name_list" required>{{ date('j F, Y ', strtotime($data)) }}</p>
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
                                <div style="text-align:center"><strong><h4>Коментарии заявки</h4></strong></div>
                                @foreach($comments as $comment)
                                    <div class="form-group">
                                        <label for="comment" class="col-md-4 control-label">
                                            <strong>{{ $comment->profile->nickname }}</strong>
                                            <small><p>{{ date('j/n/Y H:i', strtotime($comment->created_at ))}}</p></small> </label>
                                        <div class="col-md-6">
                                            <p  id="comment" class="form-control" name="comment" required>{{ $comment->text }}</p>
                                        </div>
                                        <form method="POST" action="{{ route('comment/delete') }}">
                                            {{ csrf_field() }}
                                            <button type="submit"  class="btn btn-danger" title='Удалить'><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            <input type="hidden" name="id" value="{{ $comment->id }}">
                                            <input type="hidden" name="app_id" value="{{$cosplay->id}}">
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('comment/create') }}">
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
