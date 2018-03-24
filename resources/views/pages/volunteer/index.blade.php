@extends('layouts.app')

@section('title', 'Волонтерство все заявки')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка волонтерство</strong></h4>
            @if(Auth::user()->isAdmin())
                В обработке:{{$count['processing']}} Принято:{{$count['accepted']}} Отклонено:{{$count['rejected']}}
            @endif
            <div style="padding-bottom: 25px;">
                <a class="btn btn-info btn pull-right"  href="{{url('/volunteer/create')}}">Подать заявку</a>
            </div>
            <div style="display: inline-block; margin-top: 5px;">
                <form action="{{url('/volunteer')}}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Поиск(Ник, город,  статус, навыки)" >
                        <span class="input-group-addon btn btn-default">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <button type="submit">сбросить</button>
                            </span>
                    </div>
                </form>
            </div>
            @if(!count($applications )==0)
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>
                            {{ $message }}
                        </p>
                    </div>
                @endif
                @if ($message = Session::get('warning'))
                    <div class="alert alert-warning">
                        <p>
                            {{ $message }}
                        </p>
                    </div>
                @endif
                <table class="table table-striped" border="1" style="margin-top: 5px;">
                        <thead>
                        <tr>
                            <th><p>Номер заявки</p> <a href="{{ $sort['id']['link'] }}"><i class="fa {{ $sort['id']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Податель заявки</p> <a href="{{ $sort['user_id']['link'] }}"><i class="fa {{ $sort['user_id']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Статус</p> <a href="{{ $sort['status']['link'] }}"><i class="fa {{ $sort['status']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Дата подачи</p> <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Дата обновления</p> <a href="{{ $sort['updated_at']['link'] }}"><i class="fa {{ $sort['updated_at']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Ник</p> <a href="{{ $sort['nickname']['link'] }}"><i class="fa {{ $sort['nickname']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Telegram</p> <i class="fa fa-telegram fa-2x" aria-hidden="true"></i></th>
                            <th><p>Город</p> <a href="{{ $sort['city']['link'] }}"><i class="fa {{ $sort['city']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Возможные затруднения</p> <a href="{{ $sort['difficulties']['link'] }}"><i class="fa {{ $sort['difficulties']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Дата роджения</p> <a href="{{ $sort['birthday']['link'] }}"><i class="fa {{ $sort['birthday']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr class="odd">
                                <td>{{ $application->id }}</td>
                                <td>
                                    @if(Auth::user()->isAdmin())
                                        <a  class="btn btn-info btn-sm" title="Профиль" href="{{ url('/profile/' . $application->user_id) }}">
                                            {{ $application->profile->nickname }}
                                        </a>
                                    @else
                                        {{ $application->profile->nickname }}
                                    @endif
                                </td>
                                <td>{{ $application->status }}</td>
                                <td>{{ date('j/n/Y H:i', strtotime($application->created_at )) }}</td>
                                <td>{{ date('j/n/Y H:i', strtotime($application->updated_at )) }}</td>
                                <td>{{ $application->nickname }}</td>
                                <td>{{ $application->social_links['tg']}}</td>
                                <td>{{ $application->city }}</td>
                                <td>{{ $application->difficulties }}</td>
                                <td>{{ date('j/n/Y', strtotime($application->birthday )) }}</td>
                                <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/volunteer/{{$application->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/volunteer/{{$application->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div>
                                </td>
                            </tr>
                        </tbody>
                     @endforeach
                    </table>
            @else
                <h4>У вас нет заявок.</h4>
            @endif
        </div>
    </div>
@endsection