@extends('layouts.app')
@section('title', 'All types')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h4><strong>Роли пользователей</strong></h4>
                <form action="{{url('/user-role')}}" method="GET">
                    <table class="table table-striped" border="1">
                        <thead>
                        <tr>
                            <th><p>Пользователь</p></th>
                            <th><p>Роль</p></th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="odd">
                                <td>
                                    <a  class="btn btn-info btn-sm" title="Профиль" href="{{ url('/profile/' . $user->profile->user_id) }}">
                                        {{ $user->profile->nickname }}
                                    </a>
                                </td>
                                <td>@foreach($user->roles as $role){{ $role->key }}<br>@endforeach</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-info btn-sm" href="/user-role/{{$user->profile->user_id}}/edit" title="Редактировать">
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