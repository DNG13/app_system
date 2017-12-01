@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ярмарка. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id"  class="form-control" name="type_id">{{ $fair->type_id }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="group_nick" class="col-md-4 control-label">Hазвание группы/ник</label>
                                <div class="col-md-6">
                                    <p id="title" class="form-control" name="group_nick">{{ $fair->group_nick }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="logo" class="col-md-4 control-label">Логотип</label>
                                <div class="col-md-6">
                                    <img src="/{{  $fair->logo }}" id="logo" name="logo"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_name" class="col-md-4 control-label">Контактное лицо</label>
                                <div class="col-md-6">
                                    <p id="title" class="form-control" name="contact_name">{{ $fair->contact_name }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone" class="form-control" name="phone">{{ $fair->phone }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="members_count" class="col-md-4 control-label">Количество представителей</label>
                                <div class="col-md-6">
                                    <p id="members_count" class="form-control" name="members_count">{{ $fair->members_count }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="social_link" class="col-md-4 control-label">Ссылка на личную страницу в соцсети</label>
                                <div class="col-md-6">
                                    <p id="social_link"  class="form-control" name="social_link">{{ $fair->social_link }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="group_link" class="col-md-4 control-label">Ссылка на сайт или группу в соцсетях</label>
                                <div class="col-md-6">
                                    <p id="group_link" class="form-control" name="group_link">{{ $fair->group_link }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="square" class="col-md-4 control-label">Площадь(м²)</label>
                                <div class="col-md-6">
                                    <p id="square" class="form-control" name="square">{{ $fair->square }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="payment_type" class="col-md-4 control-label">Способ оплаты</label>
                                <div class="col-md-6">
                                    <p id="square" class="form-control" name="payment_type">{{ $fair->payment_type }}</p>
                                </div>
                            </div>

                            <div>
                                @if(!$equipment->chair==null)
                                    <div class="form-group">
                                        <label for="equipment[chair]" class="col-md-4 control-label">Оборудование: Количество стульев</label>
                                        <div class="col-md-6">
                                            <p id="equipment[chair]" class="form-control" name="payment_type">{{ $equipment->chair }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if(!$equipment->table==null)
                                        <div class="form-group">
                                            <label for="equipment[table]" class="col-md-4 control-label">Количество столов</label>
                                            <div class="col-md-6">
                                                <p id="equipment[table]" class="form-control" name="payment_type">{{ $equipment->table }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!$equipment->electricity==null)
                                    <div class="form-group">
                                        <label for="equipment[electricity]" class="col-md-4 control-label">Надобность подведения электричества</label>
                                        <div class="col-md-6">
                                            <p id="equipment[electricity]" class="form-control" name="payment_type">{{ $equipment->electricity }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if(!$equipment->extra==null)
                                    <div class="form-group">
                                        <label for="equipment[extra]" class="col-md-4 control-label">Дополнительное оборудование с размерами</label>
                                        <div class="col-md-6">
                                            <p id="equipment[extra]" class="form-control" name="payment_type">{{ $equipment->extra }}</p>
                                        </div>
                                    </div>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <p id="description" class="form-control" name="payment_type">{{ $fair->description }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/fair/{{ $fair->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
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
                                        <a href="/comment/delete?id={{ $comment->id }}&app_id={{$fair->id}}&app_kind=fair">
                                            <div class="btn btn-danger">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="/comment/create">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="comment" class="col-md-4 control-label">
                                        Добавить комментарий</label>
                                    <div class="col-md-6">
                                        <textarea  id="comment" class="form-control" name="text" required></textarea>
                                    </div>
                                    <input type="hidden" name="app_kind" value="fair">
                                    <input type="hidden" name="app_id" value="{{$fair->id}}">
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
