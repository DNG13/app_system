@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="skills" class="col-md-4 control-label">Навыки</label>
                                <div class="col-md-6">
                                    <p id="skills" type="text" class="form-control" name="skills" >{{ $volunteer->skills}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="experience" class="col-md-4 control-label">Опыт работы волонтером</label>
                                <div class="col-md-6">
                                    <p id="experience" rows="5" class="form-control" name="experience" autofocus>{{ $volunteer->experience }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="difficulties" class="col-md-4 control-label">Возможные затруднения</label>
                                <div class="col-md-6">
                                    <p  id="difficulties" rows="5" class="form-control" name="difficulties"  autofocus >{{ $volunteer->difficulties }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/volunteer/{{ $volunteer->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
