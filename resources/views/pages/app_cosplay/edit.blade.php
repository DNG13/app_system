@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование  заявки</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('app_cosplay.update', $app_cosplay->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="type_id">
                                        @foreach($app_types as $key=>$app_type)
                                            @if($key == $app_cosplay->type_id)
                                                <option value="{{$key}}" selected>{{$app_type}}</option>
                                            @else
                                                <option value="{{$key}}">{{$app_type}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('type_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Название постановки</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $app_cosplay->title }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fandom') ? ' has-error' : '' }}">
                                <label for="fandom" class="col-md-4 control-label">Источник (фендом)</label>
                                <div class="col-md-6">
                                    <input id="fandom" type="text" class="form-control" name="fandom" value="{{ $app_cosplay->fandom }}" required autofocus>

                                    @if ($errors->has('fandom'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fandom') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('length') ? ' has-error' : '' }}">
                                <label for="length" class="col-md-4 control-label">Продолжительность(минут)</label>
                                <div class="col-md-6">
                                    <input id="length" type="number" class="form-control" name="length" value="{{ $app_cosplay->length}}" required autofocus>

                                    @if ($errors->has('length'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('length') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <input id="city" placeholder="Населенный пункт" type="text" class="form-control" name="city" value="{{ $app_cosplay->city }}" required autofocus>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('prev_part') ? ' has-error' : '' }}">
                                <label for="prev_part" class="col-md-4 control-label">Предыдущее участие</label>
                                <div class="col-md-6">
                                    <input id="prev_part" type="text" class="form-control" name="prev_part" value="{{ $app_cosplay->prev_part }}" autofocus>

                                    @if ($errors->has('prev_part'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prev_part') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label for="comment" class="col-md-4 control-label">Коментарий</label>
                                <div class="col-md-6">
                                    <textarea  id="comment" rows="5" class="form-control" name="comment" autofocus>{{ $app_cosplay->comment }}</textarea>

                                    @if ($errors->has('comment'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea  id="description" rows="5" class="form-control" name="description">{{ $app_cosplay->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div style="text-align:center"><strong><h4>Участники</h4></strong></div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_field">
                                    @foreach($members as $member=>$attributes)
                                        <tr><td>Участник: {{++$count}}</td><td></td>
                                        @foreach($attributes as $attribute=>$data)
                                            @if($attribute=='surname')
                                                <tr>
                                                    <td><strong>Фамилия</strong></td>
                                                    <td><input type="text" name="members[{{$count}}][surname]" class="form-control name_list" required value="{{ $data }}"/></td>
                                                </tr>
                                            @elseif($attribute=='first_name')
                                                <tr>
                                                    <td><strong>Имя</strong></td>
                                                    <td><input type="text" name="members[{{$count}}][first_name]" class="form-control name_list" required value="{{ $data }}"/></td>
                                                </tr>
                                            @elseif($attribute=='birthday')
                                                <tr>
                                                    <td><strong>Дата рождения</strong></td>
                                                    <td><input type="date" name="members[{{$count}}][birthday]" class="form-control name_list" required value="{{ $data }}"/></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </table>
                                <button type="button" name="add" id="add" class="btn btn-success">Добавить участника</button>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Отправить
                                    </button>
                                </div>
                            </div>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                var postURL = "<?php echo url('app_cosplay/create'); ?>";
                                var i="<?php echo $app_cosplay->members_count?>";
                                i++;
                                $('#add').click(function(){
                                    $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">' +
                                        '<tr><td>Участник: № ' +(i)+ '</td></tr><tr><td><strong>Фамилия</strong></td> ' +
                                        '<td><input type="text" name="members['+i+'][surname]" class="form-control name_list" required/></td> </tr> ' +
                                        '<tr> <td><strong>Имя</strong></td>' +
                                        ' <td><input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/></td> </tr>' +
                                        ' <tr> <td><strong>Дата рождения</strong></td>' +
                                        '<td><input type="date" name="members['+i+'][birthday]" class="form-control name_list" required/></td> </tr>' +
                                        ' <tr>');
                                    i++;
                                });

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $('#submit').click(function(){
                                    $.ajax({
                                        url:postURL,
                                        method:"POST",
                                        data:$('#add_name').serialize(),
                                        type:'json',
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
