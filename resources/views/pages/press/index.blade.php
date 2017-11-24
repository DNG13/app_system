@extends('layouts.app')
@section('title', 'All app.')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка пресса</strong></h4>
                <a class="btn btn-info btn" href="/press/create">Подать заявку</a>
            <hr>
            @if(!count($press)==0)
                <h5>Page {{ $press->currentPage() }} of {{ $press->lastPage() }}</h5>
            <div>
                <table class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th>Номер заявки</th>
                        <th>Податель заявки</th>
                        <th>Тип заявки</th>
                        <th>Статус</th>
                        <th>Дата подачи</th>
                        <th>Дата обновления</th>
                        <th>Наименование СМИ/никнейм</th>
                        <th>Контактное лицо</th>
                        <th>Телефон</th>
                        <th>Город</th>
                        <th>Количество участников</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($press as $item)
                        <tr class="odd">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->type_id }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ date('j F, Y H:i', strtotime($item->created_at )) }}</td>
                            <td>{{ date('j F, Y H:i', strtotime($item->updated_at )) }}</td>
                            <td>{{ $item->media_name }}</td>
                            <td>{{ $item->contact_name}}</td>
                            <td>{{ $item->phone}}</td>
                            <td>{{ $item->city }}</td>
                            <td>{{ $item->members_count }}</td>
                            <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/press/{{$item->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/press/{{$item->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="text-center">
                {!! $press->links() !!}
            </div>
            @else
                <h4>У вас нет заявок.</h4>
            @endif
        </div>
    </div>
@endsection