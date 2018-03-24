@extends('layouts.app')

@section('title', 'Волонтерство(посмотреть)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Волонтерство. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div>
                                <label for="photo" class="col-md-4">Фото</label>
                                <div class="col-md-8">
                                    <img src="/storage/{{ $volunteer->id }}/volunteers" id="photo" name="photo"/>
                                </div>
                            </div>

                            <div>
                                <label for="surname" class="col-md-4">Фамилия</label>
                                <div class="col-md-8">
                                    <p id="surname"> {{ $volunteer->surname}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="first_name" class="col-md-4">Имя</label>
                                <div class="col-md-8">
                                    <p id="first_name">{{ $volunteer->first_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="middle_name" class="col-md-4">Отчество</label>
                                <div class="col-md-8">
                                    <p id="middle_name">{{ $volunteer->middle_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="nickname" class="col-md-4">Никнейм</label>
                                <div class="col-md-8">
                                    <p id="nickname"> {{ $volunteer->nickname }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="type_id" class="col-md-4">Статус заявки</label>
                                <div class="col-md-8">
                                    <p id="type_id">{{ $volunteer->status}}</p>
                                </div>
                            </div>

                            <div>
                                <label for="birthday" class="col-md-4">Дата рождения</label>
                                <div class="col-md-8">
                                    <p id="birthday"> {{ $volunteer->birthday }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="city" class="col-md-4">Город</label>
                                <div class="col-md-8">
                                    <p id="city"> {{ $volunteer->city }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="col-md-4">Телефон</label>
                                <div class="col-md-8">
                                    <p id="phone"> {{ $volunteer->phone }}</p>
                                </div>
                            </div>

                            <div>
                                <label for="skills" class="col-md-4">Навыки</label>
                                <div class="col-md-8">
                                    <p id="skills">{{ $volunteer->skills}}</p>
                                </div>
                            </div>

                            @if(!($volunteer->experience)==null)
                                <div>
                                    <label for="experience" class="col-md-4">Опыт работы волонтером</label>
                                    <div class="col-md-8">
                                        <p id="experience">{{ $volunteer->experience }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!($volunteer->difficulties)==null)
                                <div>
                                    <label for="difficulties" class="col-md-4">Возможные затруднения</label>
                                    <div class="col-md-8">
                                        <p  id="difficulties">{{ $volunteer->difficulties }}</p>
                                    </div>
                                </div>
                            @endif
                            @if(!is_null($social_links))
                                <div class="col-md-12"><h4>Соцсети</h4></div>
                                <div class="col-md-12"><hr></div>
                            @endif
                            @if(is_null($social_links['vk']))
                                <div>
                                    <label for="social_links[vk]" class="col-md-4">VK</label>
                                    <div class="col-md-8">
                                        <p id="social_links[vk]"> {{ $social_links['vk']}}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!is_null($social_links['fb']))
                                <div>
                                    <label for="social_links[fb]" class="col-md-4">Facebook</label>
                                    <div class="col-md-8">
                                        <p id="social_links[fb]"> {{$social_links['fb'] }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!is_null($social_links['sk']))
                                <div>
                                    <label for="social_links[sk]" class="col-md-4">Skype</label>
                                    <div class="col-md-8">
                                        <p id="social_links[sk]"> {{ $social_links['sk'] }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!is_null($social_links['tg']))
                                <div>
                                    <label for="social_links[tg]" class="col-md-4">Telegram</label>
                                    <div class="col-md-8">
                                        <p id="social_links[tg]">{{ $social_links['tg'] }}</p>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <div class="col-md-12">
                                    <a href="/volunteer/{{ $volunteer->id }}/edit" class="btn btn-info" role="button">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="panel panel-default">
                <div class="panel-heading">Комментарии заявки( {{count($comments)}} )</div>
                <div class="panel-body">
                    @if(!count($comments)==0)
                        <ul class="list-group col-md-12">
                            @foreach($comments as $comment)
                                <li class="list-group-item col-md-12"  @if($comment->role)@if($comment->role->key =='admin') style="background:beige;" @endif @endif>
                                    <div>
                                        <label for="comment" class="col-md-3" style="color:darkslategrey;">
                                            <small> @if($comment->role)@if($comment->role->key =='admin')@if($comment->avatar)<img width="30" src="/storage/{{$comment->avatar->user_id}}/avatar"/>@endif Координатор  @endif @endif
                                                {{ $comment->profile->nickname }}
                                                <br>{{ date('j/n/Y H:i', strtotime($comment->created_at ))}}</small>
                                        </label>
                                        <div class="col-md-8">
                                            <p style="font-weight:bolder" id="comment">{{ $comment->text }}</p>
                                        </div>
                                        @if(Auth::user()->isAdmin())
                                            <a class="col-md-1" title="Удалить комментарий" href="/comment/delete?id={{ $comment->id }}&app_id={{$volunteer->id}}&app_kind=volunteer">
                                                <div class="btn btn-default">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="POST" action="{{ url('/comment/create')}}">
                        {{ csrf_field() }}
                        <div>
                            <label for="comment" class="col-md-3">
                                Добавить комментарий</label>
                            <div class="col-md-7 form-group">
                                <textarea  class="form-control" style="overflow:hidden" id="comment" name="text" required></textarea>
                                <input type="hidden" name="app_kind" value="volunteer">
                                <input type="hidden" name="app_id" value="{{$volunteer->id}}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Отправить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
