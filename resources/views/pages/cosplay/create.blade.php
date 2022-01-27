@extends('layouts.app')

@section('title', 'Косплей (створити)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">Нова заявка косплей-шоу</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/cosplay/store')}}" id="mainForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="temp_id" value="{{$tempId}}">
                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                                <div class="col-md-8">
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

                            <div class="form-group{{ $errors->has('group_nick') ? ' has-error' : '' }}">
                                <label for="group_nick" class="col-md-4 control-label">Назва команди/нік виступаючого</label>

                                <div class="col-md-8">
                                    <input id="group_nick" type="text" class="form-control" name="group_nick" value="{{ old('group_nick') }}" required autofocus>

                                    @if ($errors->has('group_nick'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('group_nick') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Назва постановки</label>

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="для одиночного та парного дефіле – імена персонажів, а для k-pop, танцю та караоке – назва треку" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fandom') ? ' has-error' : '' }}">
                                <label for="fandom" class="col-md-4 control-label">Джерело (фендом)</label>
                                <div class="col-md-8">
                                    <input id="fandom" type="text" class="form-control" name="fandom" value="{{ old('fandom') }}" required autofocus placeholder="Використовуйте кирилицю лише в тому випадку, якщо це оригінальна назва джерела">

                                    @if ($errors->has('fandom'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fandom') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('length') ? ' has-error' : '' }}">
                                <label for="length" class="col-md-4 control-label">Тривалість(хвилин)</label>
                                <div class="col-md-8">
                                    <input id="length" type="number" min="0" step="0.5" class="form-control" name="length" value="{{ old('length') }}" required autofocus>

                                    @if ($errors->has('length'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('length') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Місто</label>
                                <div class="col-md-8">
                                    <input id="city" placeholder="Населений пункт" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('prev_part') ? ' has-error' : '' }}">
                                <label for="prev_part" class="col-md-4 control-label">Попередня участь</label>
                                <div class="col-md-8">
                                    <textarea id="prev_part" rows="5" class="form-control" placeholder="Участь костюма/постановки в інших фестивалях (із зазначенням яких саме з посиланнями на фото/відео. Чи отримували призові місця)" name="prev_part" autofocus> {{ old('prev_part') }}</textarea>

                                    @if ($errors->has('prev_part'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prev_part') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('props') ? ' has-error' : '' }}">
                                <label for="props" class="col-md-4 control-label">Реквізит</label>
                                <div class="col-md-8">
                                    <textarea  id="props" rows="5" class="form-control" name="props"  placeholder="Ширма, столи, стільці, мікрофони, волонтери - все те, що не везете із собою" autofocus>{{ old('props') }}</textarea>

                                    @if ($errors->has('props'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('props') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Опис</label>
                                <div class="col-md-8">
                                    <textarea  id="description" rows="5" class="form-control" name="description"  autofocus required>{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label for="comment" class="col-md-4 control-label">Примітки</label>
                                <div class="col-md-8">
                                    <textarea  id="comment" rows="5" class="form-control" name="comment"  autofocus>{{ old('comment') }}</textarea>

                                    @if ($errors->has('comment'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div style="text-align:center"><strong>Учасники</strong></div>
                            <div id="dynamic_field">
                                <div class="members" id="row0">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Прізвище</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[0][surname]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Ім'я</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[0][first_name]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Персонаж</label>
                                        <div class="col-md-8">
                                            <input type="text" name="members[0][character]" class="form-control name_list" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label">Вік (повних років)</label>
                                        <div class="col-md-3">
                                            <input type="number" step="1" min="0" max="150" name="members[0][age]" class="form-control name_list" required/>
                                        </div>
                                        <div class="col-md-5"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-8">
                                    <button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>Додати учасника</button>
                                </div>
                            </div>
                        </form>

                        <div class="panel panel-default">
                            <div class="panel-heading">Прикріпити файли</div>
                            <div class="panel-body">
                                <button type="button" class="btn btn-info filter" data-toggle="collapse" data-target="#filter-panel">
                                    <i class="fa fa-file" aria-hidden="true"></i> Технічні обмеження
                                </button>
                                <div id="filter-panel" class="collapse filter-panel">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <ul>
                                                <li>розміри файлів не більше 20 мегабайт</li>
                                                <li>відео та великі файли (>20 мегабайт) рекомендуємо завантажувати на інші хостинги <i class="fa fa-cloud-download" aria-hidden="true"></i> (Youtube, dropbox) та залишати посилання в коментарях</li>
                                                <li>файли менше 20 мегабайт завантажуйте до системи заявок.</li>
                                                <li>при завантаженні файлів на сторонні хостинги зверніть увагу на термін зберігання файлів. Файли повинні зберігатися до <b>дня фестивалю (включно)</b>!</li>
                                                <li>якщо вам потрібно видалити файл, зверніться до Організаторів, ми все зробимо!</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ url('/upload') }}" enctype="multipart/form-data" method="post" class="dropzone" id="my-awesome-dropzone">
                                    {{ csrf_field() }}
                                    <div class="dz-message" data-dz-message><span>Клацніть тут мишею або перенесіть файли, щоб завантажити</span></div>
                                    <input type="hidden" name="app_kind" value="cosplay">
                                    <input type="hidden" name="temp_id" value="{{$tempId}}">
                                </form>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-success" onclick="submitForm()">
                                    Відправити
                                </button>
                                <p>Натискаючи кнопку “Відправити” Ви підтверджуєте, що ознайомилися з <a href="https://khanifest.com/visitors/main-rules/">правилами фестивалю</a> та даєте згоду на обробку даних оргкомітетом фестивалю.</p>
                            </div>
                        </div>

                        <script type="text/javascript">
                            function submitForm() {
                                $('#mainForm').submit();
                            }

                            $(document).ready(function(){
                                var postURL = "<?php echo url('cosplay/create'); ?>";
                                var i=1;

                                $('#add').click(function(){
                                    $('#dynamic_field').append(
                                    '<div class="col-md-12"><hr></div>' +
                                    '<div class="members" id="row'+i+'">' +
                                        '<div class="form-group">'+
                                            '<label  class="col-md-4 control-label">Прізвище</label>'+
                                            '<div class="col-md-8">' +
                                                '<input type="text" name="members['+i+'][surname]" class="form-control name_list" required/>' +
                                            '</div>' +
                                        '</div>'+
                                        '<div class="form-group">' +
                                            '<label class="col-md-4 control-label">Ім\'я</label>' +
                                            '<div class="col-md-8">' +
                                                '<input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="form-group">' +
                                            '<label class="col-md-4 control-label">Персонаж</label>' +
                                            '<div class="col-md-8">' +
                                                '<input type="text" name="members['+i+'][character]" class="form-control name_list" required/>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="form-group">' +
                                            '<label  class="col-md-4 control-label">Вік (повних років)</label>' +
                                            '<div class="col-md-3">' +
                                                '<input type="number" step="1" min="0" max="150" name="members['+i+'][age]" class="form-control name_list" required/>' +
                                            '</div>'+
                                            '<div class="col-md-1">'+
                                                '<a class="btn btn-info btn-sm" name="remove" id="btn_remove" title="Видалити користувача"><i class="fa fa-user-times" aria-hidden="true"></i> </a>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>'
                                    );
                                    i++;
                                });
                                $(document).on('click', '#btn_remove', function(){
                                    $(this).closest('.members').remove();
                                    i--;
                                });
                            });
                        </script>
                    </div>
                </div>
        </div>
    </div>
@endsection
