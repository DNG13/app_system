@extends('layouts.app')

@section('title', 'Ролі')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Роли <a class="btn btn-info btn pull-right"  href="{{url('/role/create')}}">Додати роль</a></strong></h4>
            @if(!count($roles)==0)
                <div style="display: inline-block; margin-top: 5px;">
                    <form action="{{url('/role')}}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Пощук за ключем" >
                            <span class="input-group-addon btn btn-default">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <button type="submit">скинути</button>
                            </span>
                        </div>
                    </form>
                </div>
                <form action="{{url('/role')}}" method="GET">
                    <table class="table table-striped" border="1">
                        <thead>
                        <tr>
                            <th><p>Ключ</p> <a href="{{ $sort['key']['link'] }}"><i class="fa {{ $sort['key']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Назва</p> <a href="{{ $sort['title']['link'] }}"><i class="fa {{ $sort['title']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Активна</p> <a href="{{ $sort['active']['link'] }}"><i class="fa {{ $sort['active']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Дата створенняя</p> <a href="{{ $sort['created_at']['link'] }}"><i class="fa {{ $sort['created_at']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th>Дія</th>
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
                                        <a class="btn btn-info btn-sm" href="/role/{{$role->key }}/edit" title="Редагувати">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-info btn-sm" href="/role/delete?key={{ $role->key }}" title="Видалити">
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
                <h4>У вас немає таких ролей.</h4>
            @endif
        </div>
    </div>
@endsection