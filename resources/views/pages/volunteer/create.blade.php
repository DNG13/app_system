@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Волонтер</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('volunteer.index') }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                                <label for="skills" class="col-md-4 control-label">Навыки</label>

                                <div class="col-md-6">
                                    <input id="skills" type="text" class="form-control" name="skills" value="{{ old('skills') }}" required autofocus>

                                    @if ($errors->has('skills'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skills') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
                                <label for="experience" class="col-md-4 control-label">Опыт работы волонтером</label>
                                <div class="col-md-6">
                                    <textarea  id="experience" rows="5" class="form-control" placeholder="Год, название фестиваля, должность" name="experience" required autofocus>{{ old('experience') }}</textarea>

                                    @if ($errors->has('experience'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('experience') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('difficulties') ? ' has-error' : '' }}">
                                <label for="difficulties" class="col-md-4 control-label">Возможные затруднения</label>
                                <div class="col-md-6">
                                    <textarea  id="difficulties" rows="5" class="form-control" name="difficulties"  autofocus >{{ old('difficulties') }}</textarea>

                                    @if ($errors->has('difficulties'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('difficulties') }}</strong>
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
