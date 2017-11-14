@extends('layouts.app')
@section('title', 'All app.')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка ярмарка</strong></h4>
                <a class="btn btn-info btn" href="/fair/create">Подать заявку</a>
            <hr>
            @if(!count($fairs)==0)
                <h5>Page {{ $fairs->currentPage() }} of {{ $fairs->lastPage() }}</h5>
            <div>
                <table class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th>Номер заявки</th>
                        <th>Податель заявки</th>
                        <th>Тип заявки</th>
                        <th>Hазвание творческой группы/ник</th>
                        <th>Контактное лицо</th>
                        <th>Телефон</th>
                        <th>Площадь(м²)</th>
                        <th>Количество представителей</th>
                        <th>Описание</th>
                        <th>Дата подачи</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fairs as $fair)
                        <tr class="odd">
                            <td>{{ $fair->id }}</td>
                            <td>{{ $fair->user_id }}</td>
                            <td>{{ $fair->type_id }}</td>
                            <td>{{ $fair->group_nick }}</td>
                            <td>{{ $fair->contact_name }}</td>
                            <td>{{ $fair->phone }}</td>
                            <td>{{ $fair->square }}</td>
                            <td>{{ $fair->members_count }}</td>
                            <td>{{ $fair->description }}</td>
                            <td>{{ date('j F, Y H:i', strtotime($fair->created_at )) }}</td>
                            <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/app_fair/{{$fair->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/app_fair/{{$fair->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="text-center">
                {!! $fairs->links() !!}
            </div>
            @else
                <h4>У вас нет заявок.</h4>
            @endif
        </div>
    </div>
@endsection