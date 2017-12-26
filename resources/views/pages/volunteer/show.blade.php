@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Волонтер. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div>
                                <label for="photo" class="col-md-4">Фото</label>
                                <div class="col-md-6">
                                    <img src="/{{ $volunteer->photo }}" id="photo" name="photo"/>
                                </div>
                            </div>

                            <div>
                                <label for="surname" class="col-md-4">Фамилия</label>
                                <div class="col-md-6">
                                    <p id="surname"> {{ $volunteer->surname}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="first_name" class="col-md-4">Имя</label>
                                <div class="col-md-6">
                                    <p id="first_name">{{ $volunteer->first_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="middle_name" class="col-md-4">Отчество</label>
                                <div class="col-md-6">
                                    <p id="middle_name">{{ $volunteer->middle_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="nickname" class="col-md-4">Никнейм</label>
                                <div class="col-md-6">
                                    <p id="nickname"> {{ $volunteer->nickname }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="type_id" class="col-md-4">Статус заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id">{{ $volunteer->status}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="birthday" class="col-md-4">Дата рождения</label>
                                <div class="col-md-6">
                                    <p id="birthday"> {{ $volunteer->birthday }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="city" class="col-md-4">Город</label>
                                <div class="col-md-6">
                                    <p id="city"> {{ $volunteer->city }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="col-md-4">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone"> {{ $volunteer->phone }}</p>
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
                                <label for="skills" class="col-md-4">Навыки</label>
                                <div class="col-md-6">
                                    <p id="skills">{{ $volunteer->skills}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="experience" class="col-md-4">Опыт работы волонтером</label>
                                <div class="col-md-6">
                                    <p id="experience">{{ $volunteer->experience }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="difficulties" class="col-md-4">Возможные затруднения</label>
                                <div class="col-md-6">
                                    <p  id="difficulties">{{ $volunteer->difficulties }}</p>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-12">
                                    <a href="/volunteer/{{ $volunteer->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
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
                                <a class="col-md-1" title="Удалить комментарий" href="/comment/delete?id={{ $comment->id }}&app_id={{$volunteer->id}}&app_kind=volunteer">
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
                                <input type="hidden" name="app_kind" value="volunteer">
                                <input type="hidden" name="app_id" value="{{$volunteer->id}}">
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
