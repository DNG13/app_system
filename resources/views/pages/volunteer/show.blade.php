@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Волонтер. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="photo" class="col-md-4 control-label">Фото</label>
                                <div class="col-md-6">
                                    <img src="/{{ $volunteer->photo }}" id="photo" name="photo"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="surname" class="col-md-4 control-label">Фамилия</label>
                                <div class="col-md-6">
                                    <p id="surname" class="form-control"> {{ $volunteer->surname}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="first_name" class="col-md-4 control-label">Имя</label>
                                <div class="col-md-6">
                                    <p id="first_name" class="form-control">{{ $volunteer->first_name }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nickname" class="col-md-4 control-label">Никнейм</label>
                                <div class="col-md-6">
                                    <p id="nickname" class="form-control"> {{ $volunteer->nickname }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="birthday" class="col-md-4 control-label">Дата рождения</label>
                                <div class="col-md-6">
                                    <p id="birthday" class="form-control"> {{ $volunteer->birthday }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <p id="city" class="form-control"> {{ $volunteer->city }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone" class="form-control"> {{ $volunteer->phone }}</p>
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
                                <label for="skills" class="col-md-4 control-label">Навыки</label>
                                <div class="col-md-6">
                                    <p id="skills" class="form-control">{{ $volunteer->skills}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="experience" class="col-md-4 control-label">Опыт работы волонтером</label>
                                <div class="col-md-6">
                                    <p id="experience" class="form-control">{{ $volunteer->experience }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="difficulties" class="col-md-4 control-label">Возможные затруднения</label>
                                <div class="col-md-6">
                                    <p  id="difficulties"  class="form-control">{{ $volunteer->difficulties }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/volunteer/{{ $volunteer->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
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
                                        <a href="/comment/delete?id={{ $comment->id }}&app_id={{$volunteer->id}}&app_kind=volunteer">
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
                                    <input type="hidden" name="app_kind" value="volunteer">
                                    <input type="hidden" name="app_id" value="{{$volunteer->id}}">
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
