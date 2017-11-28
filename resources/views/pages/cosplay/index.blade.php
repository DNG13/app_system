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
            @if(!count($app_cosplays)==0)
                <h5>Page {{ $app_cosplays->currentPage() }} of {{ $app_cosplays->lastPage() }}</h5>
                <form action="/cosplay" method="GET">
                <table class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th>
                            <p>Номер заявки</p>
                            <div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'id' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'id' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div >
                        </th>
                        <th>
                            <p>Податель заявки</p>
                            <div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'user_id' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'user_id' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div >
                        </th>
                        <th>
                            <p>Тип заявки</p>
                            <div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'type_id' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'type_id' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div >
                        </th>
                        <th>
                            <p>Статус</p>
                            <div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'status' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'status' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div >
                        </th>
                        <th>
                            <p>Дата подачи</p>
                            <div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'created_at' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'created_at' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div >
                        </th>
                        <th><p>Дата обновления</p><div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'updated_at' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'updated_at' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div ></th>
                        <th><p>Название постановки</p><div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'title' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'title' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div ></th>
                        <th><p>Источник (фендом)</p><div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'fandom' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'fandom' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div ></th>
                        <th><p>Продолжи- тельность</p><div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'length' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'length' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div ></th>
                        <th><p>Город</p><div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'city' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'city' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div ></th>
                        <th><p>Количество участников</p><div class="btn-group-vertical">
                                <button type="hidden" class="btn btn-info" name = 'members_count' value = "asc">
                                    <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                                </button>
                                <button type="hidden"  class="btn btn-info" name = 'members_count' value ="desc">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </button>
                            </div ></th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($app_cosplays as $app_cosplay)
                        <tr class="odd">
                            <td>{{ $app_cosplay->id }}</td>
                            <td>{{ $app_cosplay->user_id }}</td>
                            <td>{{ $app_cosplay->type_id }}</td>
                            <td>{{ $app_cosplay->status }}</td>
                            <td>{{ date('j/n/Y H:i', strtotime($app_cosplay->created_at )) }}</td>
                            <td>{{ date('j/n/Y H:i', strtotime($app_cosplay->updated_at )) }}</td>
                            <td>{{ $app_cosplay->title }}</td>
                            <td>{{ $app_cosplay->fandom }}</td>
                            <td>{{ $app_cosplay->length }}</td>
                            <td>{{ $app_cosplay->city }}</td>
                            <td>{{ $app_cosplay->members_count }}</td>
                            <td><div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="/cosplay/{{$app_cosplay->id }}" title="Подробнее" >
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="/cosplay/{{$app_cosplay->id }}/edit" title="Редактировать">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </form>
            <div class="text-center">
                {!! $app_cosplays->links() !!}
            </div>
            @else
                <h4>У вас нет заявок.</h4>
            @endif
        </div>
    </div>
@endsection