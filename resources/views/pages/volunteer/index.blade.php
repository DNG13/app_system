@extends('layouts.app')
@section('title', 'All app.')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Заявка косплей-шоу</strong></h4>
                <a class="btn btn-info btn" href="/volunteer/create">Подать заявку</a>
            <hr>
            @if(!count($volunteers)==0)
                <h5>Page {{ $volunteers->currentPage() }} of {{ $volunteers->lastPage() }}</h5>
            <div>
                <table class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th>Номер заявки</th>
                        <th>Навыки</th>
                        <th>Опыт работы волонтером</th>
                        <th>Возможные затруднения</th>
                        <th>Статус</th>
                        <th>Дата подачи</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($volunteers as $volunteer)
                        <tr class="odd">
                            <td>{{ $volunteer->id }}</td>
                            <td>{{ $volunteer->skills }}</td>
                            <td>{{ $volunteer->experience}}</td>
                            <td>{{ $volunteer->difficulties }}</td>
                            <td>{{ $volunteer->status }}</td>
                            <td>{{ date('j F, Y H:i', strtotime($volunteer->created_at )) }}</td>
                            <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/volunteer/{{$volunteer->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/volunteer/{{$volunteer->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="text-center">
                {!! $volunteers->links() !!}
            </div>
            @else
                <h4>У вас нет заявок.</h4>
            @endif
        </div>
    </div>
@endsection