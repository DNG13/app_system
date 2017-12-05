@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Пресса. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id"  class="form-control">{{ $press->type->title }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="media_name" class="col-md-4 control-label">Наименование СМИ/никнейм</label>
                                <div class="col-md-6">
                                    <p id="media_name" class="form-control">{{ $press->media_name }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_name" class="col-md-4 control-label">Контактное лицо</label>
                                <div class="col-md-6">
                                    <p id="contact_name" class="form-control">{{ $press->contact_name }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <p id="city" class="form-control">{{ $press->city }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone"  class="form-control">{{ $press->phone }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="portfolio_link" class="col-md-4 control-label">Ссылка на портфолио</label>
                                <div class="col-md-6">
                                    <p id="portfolio_link" class="form-control">{{ $press->portfolio_link }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="camera" class="col-md-4 control-label">Модель камеры</label>
                                <div class="col-md-6">
                                    <p id="camera"  class="form-control">{{ $press->camera }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="members_count" class="col-md-4 control-label">Количество представителей</label>
                                <div class="col-md-6">
                                    <p id="members_count" class="form-control">{{ $press->members_count }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="equipment" class="col-md-4 control-label">Доп. техника</label>
                                <div class="col-md-6">
                                    <p id="equipment" class="form-control">{{ $press->equipment }}</p>
                                </div>
                            </div>

                            @if(!$social_links->vk==null)
                                <div class="form-group">
                                    <label for="social_links[vk]" class="col-md-4 control-label">VK</label>
                                    <div class="col-md-6">
                                        <p id="social_links[vk]" class="form-control"> {{ $social_links->vk}}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$social_links->fb==null)
                                <div class="form-group">
                                    <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>
                                    <div class="col-md-6">
                                        <p id="social_links[fb]" class="form-control"> {{$social_links->fb }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$social_links->sk==null)
                                <div class="form-group">
                                    <label for="social_links[sk]" class="col-md-4 control-label">Skype</label>
                                    <div class="col-md-6">
                                        <p id="social_links[sk]" class="form-control"> {{ $social_links->fb }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!($social_links->tg)==null)
                                <div class="form-group">
                                    <label for="social_links[tg]" class="col-md-4 control-label">Telegram</label>
                                    <div class="col-md-6">
                                        <p id="social_links[tg]" class="form-control">{{ $social_links->tg }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/press/{{ $press->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
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
                                        <a href="/comment/delete?id={{ $comment->id }}&app_id={{$press->id}}&app_kind=press">
                                            <div class="btn btn-danger">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{url('/comment/create')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="comment" class="col-md-4 control-label">
                                        Добавить комментарий</label>
                                    <div class="col-md-6">
                                        <textarea  id="comment" class="form-control" name="text" required></textarea>
                                    </div>
                                    <input type="hidden" name="app_kind" value="press">
                                    <input type="hidden" name="app_id" value="{{$press->id}}">
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
