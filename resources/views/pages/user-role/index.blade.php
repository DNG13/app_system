@extends('layouts.app')
@section('title', 'All types')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Роли пользователей</strong></h4>
            @if(!count($roles)==0)
                <hr><form action="{{url('/user-role')}}" method="GET">
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
                <form action="{{url('/user-role')}}" method="GET">
                    <table class="table table-striped" border="1">
                        <thead>
                        <tr>
                            <th><p>Пользователь</p> <a href="{{ $sort['user_id']['link'] }}"><i class="fa {{ $sort['user_id']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Роль</p> <a href="{{ $sort['key']['link'] }}"><i class="fa {{ $sort['key']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr class="odd">
                                <td>
                                    <a  class="btn btn-info btn-sm" title="Профиль" href="{{ url('/profile/' . $role->user_id) }}">
                                        {{ $role->user_id }}
                                    </a>
                                </td>
                                <td>{{ $role->key }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-info btn-sm" href="/use-role/{{$role->key }}/edit" title="Редактировать">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
                <h4>У вас нет пользователей с ролями.</h4>
            @endif
        </div>
    </div>
@endsection