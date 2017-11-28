@extends('layouts.app')
@section('title', 'All app.')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка косплей-шоу <a class="btn btn-info btn pull-right"  href="/cosplay/create">Подать заявку</a></strong></h4>
                    <hr><form action="/cosplay" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search" >
                            <span class="input-group-addon btn btn-info">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                        </form>
            @if(!count($applications)==0)
                <h5>Page {{ $applications->currentPage() }} of {{ $applications->lastPage() }}</h5>
                <form action="/cosplay" method="GET">
                <table class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th><p>Номер заявки <a href="{{ $sort['id']['link'] }}"><i class="fa {{ $sort['id']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Податель заявки <a href="{{ $sort['user_id']['link'] }}"><i class="fa {{ $sort['user_id']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Тип заявки <a href="{{ $sort['type_id']['link'] }}"><i class="fa {{ $sort['type_id']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Статус <a href="{{ $sort['status']['link'] }}"><i class="fa {{ $sort['status']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Дата подачи <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Дата обновления <a href="{{ $sort['updated_at']['link'] }}"><i class="fa {{ $sort['updated_at']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Название постановки <a href="{{ $sort['title']['link'] }}"><i class="fa {{ $sort['title']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Источник (фендом) <a href="{{ $sort['fandom']['link'] }}"><i class="fa {{ $sort['fandom']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Продолжи- тельность <a href="{{ $sort['length']['link'] }}"><i class="fa {{ $sort['length']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Город <a href="{{ $sort['city']['link'] }}"><i class="fa {{ $sort['city']['icon'] }}" aria-hidden="true"></i></a></p></th>
                        <th><p>Количество участников <a href="{{ $sort['members_count']['link'] }}"><i class="fa {{ $sort['members_count']['icon'] }}" aria-hidden="true"></i></a></p></th>
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
                            <td>{{ $application->title }}</td>
                            <td>{{ $application->fandom }}</td>
                            <td>{{ $application->length }}</td>
                            <td>{{ $application->city }}</td>
                            <td>{{ $application->members_count }}</td>
                            <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/cosplay/{{$application->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/cosplay/{{$application->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </form>
            <div class="text-center">
                {!! $applications->links() !!}
            </div>
            @else
                <h4>У вас нет заявок.</h4>
            @endif
        </div>
    </div>
@endsection