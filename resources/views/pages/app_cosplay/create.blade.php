@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Новая заявка</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('app_cosplay.index') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="type_id" value="{{ old('type_id') }}">
                                        @foreach($app_types as $key=>$app_type)
                                            <option value="{{$key}}">{{$app_type}}</option>
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
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

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
                                    <input id="fandom" type="text" class="form-control" name="fandom" value="{{ old('fandom') }}" required autofocus>

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
                                    <input id="length" type="number" class="form-control" name="length" value="{{ old('length') }}" required autofocus>

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
                                    <input id="city" placeholder="Населенный пункт" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>

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
                                    <input id="prev_part" type="text" class="form-control" name="prev_part" value="{{ old('prev_part') }}" autofocus>

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
                                    <textarea  id="comment" rows="5" class="form-control" name="comment"  autofocus>{{ old('comment') }}</textarea>

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
                                    <textarea  id="description" rows="5" class="form-control" name="description"  autofocus required>{{ old('description') }}</textarea>

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
                                    <tr><td>Участник: №1</td><td></td>
                                    <tr>
                                        <td><strong>Фамилия</strong></td>
                                        <td><input type="text" name="members[0][surname]" class="form-control name_list" required/></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Имя</strong></td>
                                        <td><input type="text" name="members[0][first_name]" class="form-control name_list" required/></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Дата рождения</strong></td>
                                        <td><input type="date" name="members[0][birthday]" class="form-control name_list" required/></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Никнейм</strong></td>
                                        <td><input type="text" name="members[0][nickname]" class="form-control name_list" /></td>
                                    </tr>
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
                                var i=1;

                                $('#add').click(function(){
                                    $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">' +
                                        '<tr><td>Участник: № ' +(i+1)+ '</td></tr><tr><td><strong>Фамилия</strong></td> ' +
                                            '<td><input type="text" name="members['+i+'][surname]" class="form-control name_list" required/></td> </tr> ' +
                                        '<tr> <td><strong>Имя</strong></td>' +
                                            ' <td><input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/></td> </tr>' +
                                        ' <tr> <td><strong>Дата рождения</strong></td>' +
                                            ' <td><input type="date" name="members['+i+'][birthday]" class="form-control name_list" required/></td> </tr>' +
                                        ' <tr> <td><strong>Никнейм</strong></td> ' +
                                            '<td><input type="text" name="members['+i+'][nickname]" class="form-control name_list" /></td> </tr>' +
                                        ' <tr>');
                                    i++;
                                });

                                $(document).on('click', '.btn_remove', function(){
                                    var button_id = $(this).attr("id");
                                    $('#row'+button_id+'').remove();
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
                                        success:function(data)
                                        {
                                            if(data.error){
                                                printErrorMsg(data.error);
                                            }else{
                                                i=1;
                                                $('.dynamic-added').remove();
                                                $('#add_name')[0].reset();
                                            }
                                        }
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
