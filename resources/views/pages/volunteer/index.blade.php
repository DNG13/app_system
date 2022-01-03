@extends('layouts.app')

@section('title', 'Волонтерство всі заявки')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка волонтерство</strong></h4>
            @if(Auth::user()->isAdmin())
                В обработке: {{$count['processing']}} <br>
                Принято: {{$count['accepted']}} <br>
                Отклонено: {{$count['rejected']}}
            @endif
            <div style="padding-bottom: 25px;">
                <a class="btn btn-info btn pull-right"  href="{{url('/volunteer/create')}}">Подати заявку</a>
            </div>
            <div style="display: inline-block; margin-top: 5px;">
                <form action="{{url('/volunteer')}}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Пошук(Нік, місто, статус, навички)" >
                        <span class="input-group-addon btn btn-default">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <button type="submit">скинути</button>
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
                            <th><p>Подавець заявки</p> <a href="{{ $sort['user_id']['link'] }}"><i class="fa {{ $sort['user_id']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Статус</p> <a href="{{ $sort['status']['link'] }}"><i class="fa {{ $sort['status']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Дата подання</p> <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Дата оновлення</p> <a href="{{ $sort['updated_at']['link'] }}"><i class="fa {{ $sort['updated_at']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Нік</p> <a href="{{ $sort['nickname']['link'] }}"><i class="fa {{ $sort['nickname']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Telegram</p> <i class="fa fa-telegram fa-2x" aria-hidden="true"></i></th>
                            <th><p>Місто</p> <a href="{{ $sort['city']['link'] }}"><i class="fa {{ $sort['city']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Можливі труднощі</p> <a href="{{ $sort['difficulties']['link'] }}"><i class="fa {{ $sort['difficulties']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Вік</p> <a href="{{ $sort['age']['link'] }}"><i class="fa {{ $sort['age']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th>Дея</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr class="odd"  style="{{
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
                                <td>{{ $application->status }}</td>
                                <td>{{ date('j/n/Y H:i', strtotime($application->created_at )) }}</td>
                                <td>{{ date('j/n/Y H:i', strtotime($application->updated_at )) }}</td>
                                <td>{{ $application->nickname }}</td>
                                <td>{{ $application->telegram }}</td>
                                <td>{{ $application->city }}</td>
                                <td>{{ $application->difficulties }}</td>
                                <td>{{ $application->age }}</td>
                                <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/volunteer/{{$application->id }}" title="Детальніше" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/volunteer/{{$application->id }}/edit" title="Редагувати">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
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