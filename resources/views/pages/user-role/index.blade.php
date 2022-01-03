@extends('layouts.app')

@section('title', 'Ролі користувачів')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Ролі користувачів</strong></h4>
            <div style="display: inline-block; margin-top: 5px;">
                <form action="{{url('/user-role')}}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Пошук за користувачем" >
                        <span class="input-group-addon btn btn-default">
                            <button type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                            <button type="submit">скинути</button>
                        </span>
                    </div>
                </form>
            </div>
            <form action="{{url('/user-role')}}" method="GET">
                    <table class="table table-striped" border="1">
                        <thead>
                        <tr>
                            <th><p>ID</p> <a href="{{ $sort['id']['link'] }}"><i class="fa {{ $sort['id']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Пользователь</p><a href="{{ $sort['nickname']['link'] }}"><i class="fa {{ $sort['nickname']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th><p>Роль</p><a href="{{ $sort['key']['link'] }}"><i class="fa {{ $sort['key']['icon'] }}" aria-hidden="true"></i></a></th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="odd">
                                <td>
                                    {{$user->id }}
                                </td>
                                <td>
                                    <a  class="btn btn-info btn-sm" title="Профиль" href="{{ url('/profile/' . $user->id) }}">
                                        {{ $user->nickname }}
                                    </a>
                                </td>
                                <td>@if($user->key) {{$user->key}}@endif</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-info btn-sm" href="/user-role/{{$user->id}}/edit" title="Редагувати">
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
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection