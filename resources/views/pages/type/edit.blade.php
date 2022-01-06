@extends('layouts.app')

@section('title', 'Редагуватиь тип')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редагуватиь тип заявки</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('type.update', $type->id)  }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">Тип заявки</label>
                                <div class="col-md-6">
                                    <select id="type" class="form-control" name="type">
                                        <option value="cosplay" @if($type->app_type == 'cosplay') selected @endif >Косплей</option>
                                        <option value="fair" @if($type->app_type == 'fair' ) selected @endif >Ярмарок</option>
                                        <option value="press" @if($type->app_type == 'press') selected @endif >Преса</option>
                                        <option value="volunteer" @if($type->app_type == 'volunteer') selected @endif >Волонтери</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Ідентифікатор</label>
                                <div class="col-md-6">
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ $type->slug }}" required >

                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Назвае</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $type->title }}" required autofocus >

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
                                        Зберегти
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