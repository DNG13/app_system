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
                                    <p id="type_id">{{ $fair->type_id }}</p>
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
                                <label for="logo" class="col-md-4">Логотип</label>
                                <div class="col-md-6">
                                    <img src="/{{  $fair->logo }}" id="logo" name="logo"/>
                                </div>
                            </div>

                            <div>
                                <label for="contact_name" class="col-md-4">Контактное лицо</label>
                                <div class="col-md-6">
                                    <p id="contact_name">{{ $fair->contact_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="col-md-4">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone">{{ $fair->phone }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="members_count" class="col-md-4">Количество представителей</label>
                                <div class="col-md-6">
                                    <p id="members_count">{{ $fair->members_count }}</p>
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

                            <div>
                                <label for="square" class="col-md-4">Площадь(м²)</label>
                                <div class="col-md-6">
                                    <p id="square">{{ $fair->square }}</p>
                                </div>
                            </div>

                            <div >
                                <label for="payment_type" class="col-md-4">Способ оплаты</label>
                                <div class="col-md-6">
                                    <p id="square">{{ $fair->payment_type }}</p>
                                </div>
                            </div>

                            <div>
                                @if(!$equipment->chair==null)
                                    <div>
                                        <label for="equipment[chair]" class="col-md-4">Оборудование: Количество стульев</label>
                                        <div class="col-md-6">
                                            <p id="equipment[chair]">{{ $equipment->chair }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if(!$equipment->table==null)
                                        <div>
                                            <label for="equipment[table]" class="col-md-4">Количество столов</label>
                                            <div class="col-md-6">
                                                <p id="equipment[table]">{{ $equipment->table }}</p>
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

                                    @if(!$equipment->extra==null)
                                    <div>
                                        <label for="equipment[extra]" class="col-md-4">Дополнительное оборудование с размерами</label>
                                        <div class="col-md-6">
                                            <p id="equipment[extra]">{{ $equipment->extra }}</p>
                                        </div>
                                    </div>
                                    @endif
                            </div>

                            <div>
                                <label for="description" class="col-md-4">Описание</label>
                                <div class="col-md-6">
                                    <p id="description">{{ $fair->description }}</p>
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
