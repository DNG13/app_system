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

                            <div>
                                <div class="col-md-12">
                                    <a href="/press/{{ $press->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
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
