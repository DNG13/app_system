 @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактировать роль</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('user-role.update', $user->user_id)}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Пользователь</label>
                                <div class="col-md-6">
                                    <p>{{$user->nickname}}</p>

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                <label for="key" class="col-md-4 control-label">Вибрать роли</label>

                                <div class="col-md-6">
                                    <input type="hidden"  name="key">
                                    @foreach( $roles as $key => $title )
                                        <div class="checkbox">
                                            <label>
                                                @if(!is_null($userRoles))
                                                    @if(in_array($key, $userRoles))
                                                        <input type="checkbox" value="{{ $key }}" name="key[]" checked="checked"> {{ $title }}
                                                    @else
                                                        <input type="checkbox" value="{{ $key }}" name="key[]">{{ $title }}
                                                    @endif
                                                @else
                                                    <input type="hidden"  value="0" name="key[]"/>
                                                    <input type="checkbox" value="{{ $key }}" name="key[]">
                                                {{ $title }}
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                    <input hidden name="id" value=" {{$user->user_id}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection