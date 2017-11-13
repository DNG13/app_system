@extends('layouts.app')
@section('title', 'All app.')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка косплей-шоу</strong></h4>
                <a class="btn btn-info btn" href="/app_cosplay/create">Подать заявку</a>
            <hr>
            @if(!count($app_cosplays)==0)
                <h5>Page {{ $app_cosplays->currentPage() }} of {{ $app_cosplays->lastPage() }}</h5>
            <div>
                <table class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th>Номер заявки</th>
                        <th>Податель заявки</th>
                        <th>Тип заявки</th>
                        <th>Название постановки</th>
                        <th>Источник (фендом)</th>
                        <th>Продолжи- тельность</th>
                        <th>Город</th>
                        <th>Количество участников</th>
                        <th>Статус</th>
                        <th>Дата подачи</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($app_cosplays as $app_cosplay)
                        <tr class="odd">
                            <td>{{ $app_cosplay->id }}</td>
                            <td>{{ $app_cosplay->user_id }}</td>
                            <td>{{ $app_cosplay->type_id }}</td>
                            <td>{{ $app_cosplay->title }}</td>
                            <td>{{ $app_cosplay->fandom }}</td>
                            <td>{{ $app_cosplay->length }}</td>
                            <td>{{ $app_cosplay->city }}</td>
                            <td>{{ $app_cosplay->members_count }}</td>
                            <td>{{ $app_cosplay->status }}</td>
                            <td>{{ date('j F, Y H:i', strtotime($app_cosplay->created_at )) }}</td>
                            <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="app_cosplay/{{$app_cosplay->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/app_cosplay/{{$app_cosplay->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="text-center">
                {!! $app_cosplays->links() !!}
            </div>
            @else
                <h4>У вас нет заявок.</h4>
            @endif
        </div>
    </div>
@endsection