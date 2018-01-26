@extends('layouts.app')

@section('title', 'Пресса все заявки')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка пресса</strong></h4>
            <div>
                <a class="btn btn-info btn pull-right"  href="{{url('/press/create')}}">Подать заявку</a>
            </div>
            @if(Auth::user()->isAdmin())
                В обработке:{{$count['processing']}} Принято:{{$count['accepted']}} Отклонено:{{$count['rejected']}}
            @endif
            @if(!count($applications)==0)
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
                <div style="display: inline-block; margin-top: 5px;">
                   <form action="{{url('/press')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Поиск(Контактное лицо, город, Название СМИ)" >
                            <span class="input-group-addon btn btn-default">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <button type="submit">сбросить</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#filter-panel">
                        <i class="fa fa-filter" aria-hidden="true"></i> Фильтр
                    </button>
                    <div id="filter-panel" class="collapse filter-panel">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-inline" action="{{url('/press')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <lable>По типу</lable>
                                        <select  class="form-control  input-sm" id="type_id" name="type_id">
                                            <option ></option>
                                            @foreach($types as $key=>$type)
                                                @if(!empty($data['type_id']) && $data['type_id'] == $key)
                                                    <option selected value="{{$key}}">{{$type}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$type}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <lable >По статусу</lable>
                                        <select class="form-control input-sm" id="status" name="status">
                                            @if(!empty($data['status']))
                                                <option selected value="{{($data['status'])}}">{{($data['status'])}}</option>
                                            @else
                                                <option selected></option>
                                            @endif
                                            <option value="В обработке">В обработке</option>
                                            <option value="Ожидает ответа пользователя">Ожидает ответа пол-ля</option>
                                            <option value="Принята">Принята</option>
                                            <option value="Отклонена">Отклонена</option>
                                            <option value="Внесены изменения">Внесены изменения</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <lable >По номеру</lable>
                                        @if(!empty($data['ids']))
                                            <input class="form-control input-sm" type="text"  name="ids" value="{{$data['ids']}}">
                                        @else
                                            <input class="form-control input-sm" type="text"  name="ids">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <lable >По подателю</lable>
                                        @if(!empty($data['nickname']))
                                            <input class="form-control  input-sm" type="text"  name="nickname" value="{{$data['nickname']}}">
                                        @else
                                            <input class="form-control  input-sm "type="text"  name="nickname">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info" style="margin-top: 5px;">
                                            <i class="fa fa-filter" aria-hidden="true"></i>Фильтровать
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped" border="1" style="margin-top: 5px;">
                    <thead>
                    <tr>
                        <th><p>Номер заявки</p> <a href="{{ $sort['id']['link'] }}"><i class="fa {{ $sort['id']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Податель заявки</p> <a href="{{ $sort['user_id']['link'] }}"><i class="fa {{ $sort['user_id']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Тип заявки</p> <a href="{{ $sort['type_id']['link'] }}"><i class="fa {{ $sort['type_id']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Статус</p> <a href="{{ $sort['status']['link'] }}"><i class="fa {{ $sort['status']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Дата подачи</p> <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Дата обновления</p> <a href="{{ $sort['updated_at']['link'] }}"><i class="fa {{ $sort['updated_at']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Название СМИ</p> <a href="{{ $sort['media_name']['link'] }}"><i class="fa {{ $sort['media_name']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Контактное лицо</p> <a href="{{ $sort['contact_name']['link'] }}"><i class="fa {{ $sort['contact_name']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Телефон</p> <a href="{{ $sort['phone']['link'] }}"><i class="fa {{ $sort['phone']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Город</p> <a href="{{ $sort['city']['link'] }}"><i class="fa {{ $sort['city']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p><i class="fa fa-users fa-2x" aria-hidden="true"></i>(человек)</p> <a href="{{ $sort['members_count']['link'] }}"><i class="fa {{ $sort['members_count']['icon'] }}" aria-hidden="true"></i></a></th>
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
                            <td>{{ $application->type->title }}</td>
                            <td>{{ $application->status }}</td>
                            <td>{{ date('j/n/Y H:i', strtotime($application->created_at )) }}</td>
                            <td>{{ date('j/n/Y H:i', strtotime($application->updated_at )) }}</td>
                            <td>{{ $application->media_name }}</td>
                            <td>{{ $application->contact_name }}</td>
                            <td>{{ $application->phone }}</td>
                            <td>{{ $application->city }}</td>
                            <td>{{ $application->members_count }}</td>
                            <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/press/{{$application->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/press/{{$application->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            <div class="text-center">
                {!! $applications->links() !!}
            </div>
            @else
                <h4>У вас нет заявок.</h4>
            @endif
        </div>
    </div>
@endsection