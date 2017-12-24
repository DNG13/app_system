@extends('layouts.app')
@section('title', 'All types')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Роли <a class="btn btn-info btn pull-right"  href="{{url('/role/create')}}">Добавить роль</a></strong></h4>
            @if(!count($roles)==0)
                <hr><form action="{{url('/role')}}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search" >
                        <span class="input-group-addon btn btn-info">
                        <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                    </div>
                </form>
            <hr>
                <form action="{{url('/role')}}" method="GET">
                    <table class="table table-striped" border="1">
                        <thead>
                        <tr>
                            <th><p>Тип заявки</p> <a href="{{ $sort['key']['link'] }}"><i class="fa {{ $sort['key']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Название</p> <a href="{{ $sort['title']['link'] }}"><i class="fa {{ $sort['title']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Активна</p> <a href="{{ $sort['active']['link'] }}"><i class="fa {{ $sort['active']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Дата  создания</p> <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr class="odd">
                                <td>{{ $role->key }}</td>
                                <td>{{ $role->title }}</td>
                                <td>@if($role->active)
                                        <i class="fa fa-check-square-o  fa-2x" aria-hidden="true"></i>
                                    @endif
                                </td>
                                <td>{{ date('j/n/Y H:i', strtotime($role->created_at )) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-info btn-sm" href="/role/{{$role->key }}/edit" title="Редактировать">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="/role/delete?key={{ $role->key }}" title="Удалить">
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
                    {!! $roles->links() !!}
                </div>
            @else
                <h4>У вас нет таких ролей.</h4>
            @endif
        </div>
    </div>
@endsection