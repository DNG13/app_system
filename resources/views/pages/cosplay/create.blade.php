@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Новая заявка косплей-шоу</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/cosplay/store')}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-6">
                                    <select id="type_id" class="form-control" name="type_id">
                                        @foreach($types as $key=>$type)
                                            <option value="{{$key}}">{{$type}}</option>
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
                                    <input id="length" type="number" min="0" step="0.5" class="form-control" name="length" value="{{ old('length') }}" required autofocus>

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
                                    <textarea id="prev_part" rows="5" class="form-control" placeholder="Участие костюма/постановки в других фестивалях(с указанием на каких именно со ссылками на фото/видео. Получали ли призовые места)" name="prev_part" autofocus> {{ old('prev_part') }}</textarea>

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

                            <div style="text-align:center"><strong>Участники</strong></div>
                            <div id="dynamic_field">
                                <div class="members" id="row0">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Участник : Фамилия</label>
                                        <div class="col-md-6">
                                            <input type="text" name="members[0][surname]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Имя</label>
                                        <div class="col-md-6">
                                            <input type="text" name="members[0][first_name]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Дата рождения</label>
                                        <div class="col-md-6">
                                            <input type="date" min='1899-01-01' max="{{date("Y-d-m")}}" name="members[0][birthday]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i>Добавить участника</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Отправить
                                    </button>
                                    <p>Нажимая кнопку “Отправить” Вы подтверждаете, что ознакомились с <a href="/home">правилами фестиваля</a></p>
                                </div>
                            </div>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                var postURL = "<?php echo url('cosplay/create'); ?>";
                                var i=1;

                                $('#add').click(function(){
                                    $('#dynamic_field').append(
                                    ' <div class="members" id="row'+i+'">' +
                                        ' <div class="form-group">'+
                                            '<label  class="col-md-4 control-label">Участник : Фамилия</label>'+
                                            '<div class="col-md-6"> ' +
                                                '<input type="text" name="members['+i+'][surname]" class="form-control name_list" required/>' +
                                            '</div>' +
                                        '</div>'+
                                        '<div class="form-group"> ' +
                                            '<label class="col-md-4 control-label">Имя</label>' +
                                            ' <div class="col-md-6"> ' +
                                                '<input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/> ' +
                                            '</div>' +
                                        ' </div>' +
                                        ' <div class="form-group"> ' +
                                            '<label  class="col-md-4 control-label">Дата рождения</label>' +
                                            ' <div class="col-md-3"> ' +
                                                '<input type="date"  min="1899-01-01" max="Date()" name="members['+i+'][birthday]" class="form-control name_list" required/>' +
                                            '</div>'+
                                            '<div class="col-md-1">'+
                                                '<a class="btn btn-info btn-sm" name="remove" id="btn_remove" title="Удалить участника"> <i class="fa fa-user-times" aria-hidden="true"></i> </a>' +
                                            ' </div>' +
                                        ' </div>' +
                                    ' </div>'
                                    );
                                    i++;
                                });
                                $(document).on('click', '#btn_remove', function(){
                                    $(this).closest('.members').remove();
                                    i--;
                                });

                                $('#submit').click(function(){
                                    $.ajax({
                                        url:postURL,
                                        method:"POST",
                                        data:$('#add_name').serialize(),
                                        type:'json'
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
        </div>
    </div>
@endsection
