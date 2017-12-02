@extends('layouts.app')
@section('title', 'All app.')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка ярмарка <a class="btn btn-info btn pull-right"  href="/fair/create">Подать заявку</a></strong></h4>
            <hr>
            <form action="/fair" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Поиск(Контактное лицо, Название(Ник))" >
                    <span class="input-group-addon btn btn-info">
                        <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div>
            </form>
            <hr>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel">
                    <i class="fa fa-filter" aria-hidden="true"></i> Фильтр
                </button>
                <div id="filter-panel" class="collapse filter-panel">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-inline" action="/cosplay" method="POST">
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
                                    @if(!empty($data['id']))
                                        <input class="form-control input-sm" type="text"  name="id" value="{{$data['id']}}">
                                    @else
                                        <input class="form-control input-sm" type="text"  name="id">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <lable >По подателю</lable>
                                    @if(!empty($data['user_id']))
                                        <input class="form-control  input-sm" type="text"  name="id" value="{{$data['user_id']}}">
                                    @else
                                        <input class="form-control  input-sm "type="text"  name="user_id">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-filter" aria-hidden="true"></i>Фильтрувати
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @if(!count($applications )==0)
                <table class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th><p>Номер заявки</p> <a href="{{ $sort['id']['link'] }}"><i class="fa {{ $sort['id']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Податель заявки</p> <a href="{{ $sort['user_id']['link'] }}"><i class="fa {{ $sort['user_id']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Тип заявки</p> <a href="{{ $sort['type_id']['link'] }}"><i class="fa {{ $sort['type_id']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Статус</p> <a href="{{ $sort['status']['link'] }}"><i class="fa {{ $sort['status']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Дата подачи</p> <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Дата обновления</p> <a href="{{ $sort['updated_at']['link'] }}"><i class="fa {{ $sort['updated_at']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Название</p> <a href="{{ $sort['group_nick']['link'] }}"><i class="fa {{ $sort['group_nick']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Контактное лицо</p> <a href="{{ $sort['contact_name']['link'] }}"><i class="fa {{ $sort['contact_name']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>Телефон</p> <a href="{{ $sort['phone']['link'] }}"><i class="fa {{ $sort['phone']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p>S (м²)</p> <a href="{{ $sort['square']['link'] }}"><i class="fa {{ $sort['square']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th><p><i class="fa fa-users fa-2x" aria-hidden="true"></i>(человек)</p> <a href="{{ $sort['members_count']['link'] }}"><i class="fa {{ $sort['members_count']['icon'] }}" aria-hidden="true"></i></a></th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        <tr class="odd">
                            <td>{{ $application->id }}</td>
                            <td>{{ $application->profile->nickname }}</td>
                            <td>{{ $application->type->title }}</td>
                            <td>{{ $application->status }}</td>
                            <td>{{ date('j/n/Y H:i', strtotime($application->created_at )) }}</td>
                            <td>{{ date('j/n/Y H:i', strtotime($application->updated_at )) }}</td>
                            <td>{{ $application->group_nick }}</td>
                            <td>{{ $application->contact_name }}</td>
                            <td>{{ $application->phone }}</td>
                            <td>{{ $application->square }}</td>
                            <td>{{ $application->members_count }}</td>
                            <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/fair/{{$application->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/fair/{{$application->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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