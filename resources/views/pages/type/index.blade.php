@extends('layouts.app')
@section('title', 'All types')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Типи заявок <a class="btn btn-info btn pull-right"  href="{{url('/type/create')}}">Добавить тип</a></strong></h4>
            @if(!count($types)==0)
                <div style="display: inline-block; margin-top: 5px;">
                    <form action="{{url('/type')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Поиск по типу, по названию заявки" >
                            <span class="input-group-addon btn btn-default">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <button type="submit">сбросить</button>
                            </span>
                        </div>
                    </form>
                </div>
                <form action="{{url('/type')}}" method="GET">
                    <table class="table table-striped" border="1">
                        <thead>
                        <tr>
                            <th><p>ID</p> <a href="{{ $sort['id']['link'] }}"><i class="fa {{ $sort['id']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Автор</p> <a href="{{ $sort['user_id']['link'] }}"><i class="fa {{ $sort['user_id']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Тип заявки</p> <a href="{{ $sort['app_type']['link'] }}"><i class="fa {{ $sort['app_type']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Название</p> <a href="{{ $sort['title']['link'] }}"><i class="fa {{ $sort['title']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Дата  создания</p> <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $type)
                            <tr class="odd">
                                <td>{{ $type->id }}</td>
                                @if(!$type->user_id==null)
                                    <td>{{ $type->profile->nickname }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $type->app_type }}</td>
                                <td>{{ $type->title }}</td>
                                <td>{{ date('j/n/Y H:i', strtotime($type->created_at )) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-info btn-sm" href="/type/{{$type->id }}/edit" title="Редактировать">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-info btn-sm" href="/type/delete?id={{ $type->id }}" title="Удалить">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </form>
                <div class="text-center">
                    {!! $types->links() !!}
                </div>
            @else
                <h4>У вас нет таких типов заявок.</h4>
            @endif
        </div>
    </div>
@endsection