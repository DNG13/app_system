@extends('layouts.app')

@section('title', 'Додати тип')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Додати новий тип заявки</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('type.index') }}">
                        {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="type">
                                            <option value="cosplay">Косплей</option>
                                            <option value="fair">Ярмарок</option>
                                            <option value="press">Преса</option>
                                            <option value="volunteer">Волонтери</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Ідентифікатор (унікальна коротка технічна англомовна назва)</label>
                                <div class="col-md-6">
                                    <input id="slug" type="text" class="form-control" name="slug" required>

                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Назва</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-info">
                                        Відправити
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