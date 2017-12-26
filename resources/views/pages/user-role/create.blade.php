@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить роль пользователю</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('user-role.index') }}">
                        {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Название</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                <label for="key" class="col-md-4 control-label">Ключ</label>

                                <div class="col-md-6">
                                    <input id="key" type="text" class="form-control" name="key" required autofocus>
                                    @if ($errors->has('key'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('key') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Отправить
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