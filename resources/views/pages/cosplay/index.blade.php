@extends('layouts.app')

@section('title', 'Косплей всі заявки')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка косплей-шоу</strong></h4>
            @if(Auth::user()->isAdmin())
                В обробці: {{$count['processing']}} <br>
                Прийнято: {{$count['accepted']}} <br>
                Відхилено: {{$count['rejected']}}
            @endif
            <div style="padding-bottom: 25px;">
                <a class="btn btn-info btn pull-right"  href="{{ url('/cosplay/create')}}">Подати заяву</a>
            </div>
            <div style="display: inline-block; margin-top: 5px;">
                <form action="{{ url('/cosplay')}}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Пошук(Місто, Фендом, Назва постановки)" >
                        <span class="input-group-addon btn btn-default">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <button type="submit">скинути</button>
                            </span>
                    </div>
                </form>
            </div>
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
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    <button type="button" class="btn btn-info filter" data-toggle="collapse" data-target="#filter-panel">
                        <i class="fa fa-filter" aria-hidden="true"></i> Фільтр
                    </button>
                    <div id="filter-panel" class="collapse filter-panel">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-inline" action="{{ url('/cosplay')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <lable>За типом</lable>
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
                                        <lable>За статусом</lable>
                                        <select class="form-control input-sm" id="status" name="status">
                                            @if(!empty($data['status']))
                                                <option selected value="{{($data['status'])}}">{{($data['status'])}}</option>
                                            @else
                                                <option selected></option>
                                            @endif
                                            <option value="В обработке">В обробці</option>
                                            <option value="Ожидает ответа пользователя">Чекає на відповідь кор-ча</option>
                                            <option value="Принята">Прийнята</option>
                                            <option value="Отклонена">Відхилено</option>
                                            <option value="Внесены изменения">Внесені зміни</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <lable>За номером</lable>
                                        @if(!empty($data['ids']))
                                            <input class="form-control input-sm" type="text"  name="ids" value="{{$data['ids']}}">
                                        @else
                                            <input class="form-control input-sm" type="text"  name="ids">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <lable>За подавцем</lable>
                                        @if(!empty($data['nickname']))
                                            <input class="form-control  input-sm" type="text"  name="nickname" value="{{$data['nickname']}}">
                                        @else
                                            <input class="form-control  input-sm" type="text"  name="nickname">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info" style="margin-top: 5px;">
                                            <i class="fa fa-filter" aria-hidden="true"></i>Фільтрувати
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
                        <th><p>Подавець заявки</p> <a href="{{ $sort['user_id']['link'] }}"><i class="fa {{ $sort['user_id']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Тип заявки</p> <a href="{{ $sort['type_id']['link'] }}"><i class="fa {{ $sort['type_id']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Статус</p> <a href="{{ $sort['status']['link'] }}"><i class="fa {{ $sort['status']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Дата подання</p> <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Дата оновлення</p> <a href="{{ $sort['updated_at']['link'] }}"><i class="fa {{ $sort['updated_at']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Назва постановки</p> <a href="{{ $sort['title']['link'] }}"><i class="fa {{ $sort['title']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Назва команди/нік виступаючого</p> <a href="{{ $sort['group_nick']['link'] }}"><i class="fa {{ $sort['group_nick']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Джерело (фендом)</p> <a href="{{ $sort['fandom']['link'] }}"><i class="fa {{ $sort['fandom']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i>(хвилин)</p> <a href="{{ $sort['length']['link'] }}"><i class="fa {{ $sort['length']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Місто</p> <a href="{{ $sort['city']['link'] }}"><i class="fa {{ $sort['city']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p><i class="fa fa-users fa-2x" aria-hidden="true"></i>(людей)</p> <a href="{{ $sort['members_count']['link'] }}"><i class="fa {{ $sort['members_count']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th>Дія</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        <tr class="odd" style="{{
                        $application->status == "Отклонена" ? 'background-color: #f5ebee' :
                        ($application->status == "Принята" ? 'background-color: #dcedc8' :
                        ($application->status == "Ожидает ответа пользователя" ? 'background-color: #f5f5c4' :
                        ($application->status == "Внесены изменения" ? 'background-color: #e1f5f5' : '')))
                        }}">
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
                            <td>{{ $application->title }}</td>
                            <td>{{ $application->group_nick}}</td>
                            <td>{{ $application->fandom }}</td>
                            <td>{{ $application->length }}</td>
                            <td>{{ $application->city }}</td>
                            <td>{{ $application->members_count }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/cosplay/{{$application->id }}" title="Детальніше" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/cosplay/{{$application->id }}/edit" title="Редагувати">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            @else
                <h4>Ви не маєте заявок.</h4>
            @endif
        </div>
    </div>
@endsection