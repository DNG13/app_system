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
                                    <p id="surname" class="form-control" name="surname"> {{ $volunteer->surname}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="first_name" class="col-md-4 control-label">Имя</label>
                                <div class="col-md-6">
                                    <p id="first_name" class="form-control" name="first_name">{{ $volunteer->first_name }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nickname" class="col-md-4 control-label">Никнейм</label>
                                <div class="col-md-6">
                                    <p id="nickname" class="form-control" name="nickname"> {{ $volunteer->nickname }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="birthday" class="col-md-4 control-label">Дата рождения</label>
                                <div class="col-md-6">
                                    <p id="birthday" class="form-control" name="birthday"> {{ $volunteer->birthday }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <p id="city" class="form-control" name="city"> {{ $volunteer->city }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone" class="form-control" name="phone" > {{ $volunteer->phone }}</p>
                                </div>
                            </div>

                            @if(!$social_links->vk==null)
                                <div class="form-group">
                                    <label for="social_links[vk]" class="col-md-4 control-label">VK</label>
                                    <div class="col-md-6">
                                        <p id="social_links[vk]" class="form-control" name="social_links[vk]"> {{ $social_links->vk}}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$social_links->fb==null)
                                <div class="form-group">
                                    <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>
                                    <div class="col-md-6">
                                        <p id="social_links[fb]" class="form-control" name="social_links[fb]"> {{$social_links->fb }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$social_links->sk==null)
                                <div class="form-group">
                                    <label for="social_links[sk]" class="col-md-4 control-label">Skype</label>
                                    <div class="col-md-6">
                                        <p id="social_links[sk]" class="form-control" name="social_links[sk]" > {{ $social_links->fb }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!($social_links->tg)==null)
                                <div class="form-group">
                                    <label for="social_links[tg]" class="col-md-4 control-label">Telegram</label>
                                    <div class="col-md-6">
                                        <p id="social_links[tg]" class="form-control" name="social_links[tg]">{{ $social_links->tg }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="skills" class="col-md-4 control-label">Навыки</label>
                                <div class="col-md-6">
                                    <p id="skills" type="text" class="form-control" name="skills" >{{ $volunteer->skills}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="experience" class="col-md-4 control-label">Опыт работы волонтером</label>
                                <div class="col-md-6">
                                    <p id="experience" rows="5" class="form-control" name="experience" autofocus>{{ $volunteer->experience }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="difficulties" class="col-md-4 control-label">Возможные затруднения</label>
                                <div class="col-md-6">
                                    <p  id="difficulties" rows="5" class="form-control" name="difficulties"  autofocus >{{ $volunteer->difficulties }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/volunteer/{{ $volunteer->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
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
                                        <a href="/comment/delete?id={{ $comment->id }}&app_id={{$volunteer->id}}&app_kind=volunteer">
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
