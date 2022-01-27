@extends('layouts.app')

@section('title', 'Ярмарок(редагувати)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Редагування заявки на ярмарок</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('expo.update', $fair->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        Деятельность на фестивале
                        <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                            <label for="type_id" class="col-md-4 control-label">Тип заявки</label>

                            <div class="col-md-8">
                                <select id="type_id" class="form-control" name="type_id">
                                    @foreach($types as $key=>$type)
                                        @if($key == $fair->type_id)
                                            <option value="{{$key}}" selected>{{$type}}</option>
                                        @else
                                            <option value="{{$key}}">{{$type}}</option>
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

                        @if(Auth::user()->isAdmin())
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Статус заявки</label>

                            <div class="col-md-8">
                                <select class="form-control input-sm" id="status" name="status">
                                    @if(!empty($fair->status))
                                        <option selected value="{{$fair->status}}">{{$fair->getStatusText()}}</option>
                                    @endif
                                        <option value="{{\App\Models\AppFair::APP_STATUS_IN_PROCESSING}}">В обробці</option>
                                        <option value="{{\App\Models\AppFair::APP_STATUS_WAIT_USER}}">Чекає на відповідь користувача</option>
                                        <option value="{{\App\Models\AppFair::APP_STATUS_ACCEPTED}}">Прийнята</option>
                                        <option value="{{\App\Models\AppFair::APP_STATUS_REJECTED}}">Відхилено</option>
                                        <option value="{{\App\Models\AppFair::APP_STATUS_CHANGED}}">Внесені зміни</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('group_nick') ? ' has-error' : '' }}">
                            <label for="group_nick" class="col-md-4 control-label">Назва групи/нік</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control" name="group_nick" value="{{ $fair->group_nick }}" required autofocus>

                                @if ($errors->has('group_nick'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('group_nick') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                            <label for="contact_name" class="col-md-4 control-label">Контактна особа</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control" name="contact_name" value="{{ $fair->contact_name }}" required autofocus>

                                @if ($errors->has('contact_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('contact_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">Місто</label>

                            <div class="col-md-8">
                                <input id="title" type="text" placeholder="Для іногородніх - місто та дата/час прибуття" class="form-control" name="city" value="{{ $fair->city }}" required autofocus>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Телефон</label>

                            <div class="col-md-8">
                                <input id="phone" pattern='[\+]\d{3}[0-9]{9}'  placeholder="+380000000000" type="tel" class="form-control" name="phone" value="{{  $fair->phone }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('social_link') ? ' has-error' : '' }}">
                            <label for="social_link" class="col-md-4 control-label">Посилання на особисту сторінку</label>

                            <div class="col-md-8">
                                <input id="social_link" type="text" class="form-control" name="social_link" value="{{$fair->social_link }}" placeholder="tg, fb або vk для зв'язку з відповідальним за заявкою" required autofocus>

                                @if ($errors->has('social_link'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('social_link') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('group_link') ? ' has-error' : '' }}">
                            <label for="group_link" class="col-md-4 control-label">Посилання на сайт</label>

                            <div class="col-md-8">
                                 <input  id="group_link" type="text" class="form-control" name="group_link" value="{{  $fair->group_link }}" autofocus>

                                @if ($errors->has('group_link'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('group_link') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#social-panel" >
                                    Соцмережі (натисніть для заповнення)
                                </button>
                            </div>
                        </div>
                        <div id="social-panel" class="collapse social-panel">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <div class="form-group{{ $errors->has('social_links[tg]') ? ' has-error' : '' }}">
                                        <label for="social_links[tg]" class="col-md-4 control-label">Telegram</label>
                                        <div class="col-md-8">
                                            <input id="social_links[tg]" type="text" value="{{ $fair->social_links['tg'] ?? '' }}"
                                                   class="form-control" name="social_links[tg]" autofocus>
                                            @if ($errors->has('social_links[tg]'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[tg]') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('social_links[fb]') ? ' has-error' : '' }}">
                                        <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>
                                        <div class="col-md-8">
                                            <input id="social_links[fb]" type="text" value="{{ $fair->social_links['fb'] ?? '' }}"
                                                   class="form-control" name="social_links[fb]" autofocus>
                                            @if ($errors->has('social_links[fb]'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[fb]') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('social_links[insta]') ? ' has-error' : '' }}">
                                        <label for="social_links[insta]" class="col-md-4 control-label">Instagram</label>
                                        <div class="col-md-8">
                                            <input id="social_links[insta]" type="text" value="{{ $fair->social_links['insta'] ?? '' }}"
                                                   class="form-control" name="social_links[insta]" autofocus>
                                            @if ($errors->has('social_links[insta]'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[insta]') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('social_links[tumblr]') ? ' has-error' : '' }}">
                                        <label for="social_links[tumblr]" class="col-md-4 control-label">Tumbler</label>
                                        <div class="col-md-8">
                                            <input id="social_links[tumblr]" type="text" value="{{ $fair->social_links['tumblr'] ?? '' }}"
                                                   class="form-control" name="social_links[tumblr]" autofocus>
                                            @if ($errors->has('social_links[tumblr]'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('social_links[tumblr]') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#filter-panel" >
                                    Блок для стендів, ігрозони та фудкорту (натисніть для заповнення)
                                </button>
                            </div>
                        </div>
                        <div id="filter-panel" class="collapse filter-panel">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <div class="form-group{{ $errors->has('block[universe]') ? ' has-error' : '' }}">
                                        <label for="block[universe]" class="col-md-4 control-label">Вселенная</label>
                                        <div class="col-md-8">
                                            <textarea id="block[universe]" type="text"
                                                      placeholder="Наприклад: Фотостенд по «Гравіті Фоллс» або ігрова зона 'Вархаммер'. Обов'язково до заповнення стендами та ігрозонами."
                                                      class="form-control" name="block[universe]" autofocus>{{ $block->universe }}
                                            </textarea>
                                            @if ($errors->has('block[universe]'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('block[universe]') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('block[description]') ? ' has-error' : '' }}">
                                        <label for="block[description]" class="col-md-4 control-label">Короткий опис декорацій та інтерактиву</label>
                                        <div class="col-md-8">
                                            <textarea id="block[description]"
                                                      placeholder="пишіть, що відбуватиметься на стенді та дизайн стенду. Фото та план слід прикріпити через редагування заявк"
                                                      class="form-control" name="block[description]" autofocus>{{ $block->description }}
                                            </textarea>
                                            @if ($errors->has('block[description]'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('block[description]') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('block[stuff]') ? ' has-error' : '' }}">
                                        <label for="block[stuff]" class="col-md-4 control-label">Матеріали, що використовуються</label>
                                        <div class="col-md-8">
                                            <textarea id="block[stuff]"
                                                      placeholder="Обов'язково до заповнення за наявності будь-яких конструкцій та декорації"
                                                      class="form-control" name="block[stuff]" autofocus>{{ $block->stuff }}
                                            </textarea>
                                            @if ($errors->has('block[stuff]'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('block[stuff]') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('block[goods]') ? ' has-error' : '' }}">
                                        <label for="block[goods]" class="col-md-4 control-label">Перелік продукції</label>
                                        <div class="col-md-8">
                                            <textarea id="block[goods]"
                                                      placeholder="Обов'язково до заповнення фудкорту. Для великих ігрозон - список ігор"
                                                      class="form-control" name="block[goods]" autofocus>{{ $block->goods }}
                                            </textarea>
                                            @if ($errors->has('block[goods]'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('block[goods]') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('block[square]') ? ' has-error' : '' }}">
                                        <label for="block[square]" class="col-md-4 control-label">Розмір торгово-розважальної точки</label>
                                        <div class="col-md-8">
                                            <textarea id="block[square]"
                                                      placeholder="Ширина, глибина та висота в сантиметрах."
                                                      class="form-control" name="block[square]" autofocus>{{ $block->square}}
                                            </textarea>
                                            @if ($errors->has('block[square]'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('block[square]') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div style="text-align:center"><strong>Оборудование</strong></div>
                        <div>
                            <div class="form-group{{ $errors->has('equipment[table]') ? ' has-error' : '' }}">
                                <label for="equipment[table]" class="col-md-4 control-label">Кількість столів</label>

                                <div class="col-md-8">
                                    <input id="equipment[table]" type="number" min="0" class="form-control" name="equipment[table]" value="{{  $equipment->table }}" required autofocus>

                                    @if ($errors->has('equipment[table]'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('equipment[table]') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('equipment[chair]') ? ' has-error' : '' }}">
                                <label for="equipment[chair]" class="col-md-4 control-label">Кількість стільців</label>
                                <div class="col-md-8">
                                    <input id="equipment[chair]" type="number" min="0" class="form-control" name="equipment[chair]" value="{{ $equipment->chair }}"  required autofocus>

                                    @if ($errors->has('equipment[chair]'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('equipment[chair]') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('equipment[extra]') ? ' has-error' : '' }}">
                                <label for="equipment[extra]" class="col-md-4 control-label">Додаткове обладнання з розмірами</label>

                                <div class="col-md-8">
                                    <textarea id="equipment[extra]" rows="5"
                                              class="form-control" placeholder="Наприклад, банер, етажерка, ширма тощо."
                                              name="equipment[extra]"  autofocus>{{ $equipment->extra }}
                                    </textarea>

                                    @if ($errors->has('equipment[extra]'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('equipment[extra]') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('equipment[electricity]') ? ' has-error' : '' }}">
                                <label for="equipment[electricity]" class="col-md-4 control-label">Необхідність підведення електрики</label>
                                <div class="col-md-8">
                                    <select id="type_id" class="form-control" name="equipment[electricity]">
                                            <option @if($equipment->electricity == 'Нет') selected @endif value="Нет">Так</option>
                                            <option @if($equipment->electricity == 'Да') selected @endif value="Да">Ні</option>
                                    </select>
                                    @if ($errors->has('equipment[electricity]'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('equipment[electricity]') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('electrics') ? ' has-error' : '' }}">
                            <label for="electrics" class="col-md-4 control-label">Електроустаткування</label>
                            <div class="col-md-8">
                                <textarea  id="electrics"
                                           placeholder="список обладнання та інформація зі специфікації або паспорта обладнання в Вт та А"
                                           class="form-control" name="electrics"  autofocus>{{  $fair->electrics }}
                                </textarea>

                                @if ($errors->has('electrics'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('electrics') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : '' }}">
                            <label for="payment_type" class="col-md-4 control-label">Спосіб оплати</label>

                            <div class="col-md-8">
                                <select id="type_id" class="form-control" name="payment_type">
                                    <option @if( $fair->payment_type == 'наличный') selected @endif value="наличный">готівка (у день фестивалю)</option>
                                    <option @if( $fair->payment_type == 'договорной') selected @endif value="договорной">договірної (для комерційних стендів, ігрозон, фудкортів)</option>
                                    <option @if( $fair->payment_type == 'фанатский') selected @endif value="фанатский">на умовах учасника фестивалю (для фанатських стендів)</option>
                                </select>
                                @if ($errors->has('payment_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('payment_type') }}</strong>
                                    </span>
                                @endif
                                Цього року безготівковий розрахунок недоступний. На саму участь у ярмарку це ніяк не вплине. Просимо вибачення за можливі незручності
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Опис</label>
                            <div class="col-md-8">
                                <textarea  id="description" class="form-control" name="description"  autofocus required>{{  $fair->description }} </textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div style="text-align:center"><strong>Учасники</strong></div>
                        <div id="dynamic_field">
                            @foreach($members as $member=>$attributes)
                                <div class="members" id="row{{$count}}">
                                    @foreach($attributes as $attribute=>$data)
                                        @if($attribute=='surname')
                                            <div class="form-group">
                                                <label  class="col-md-4 control-label">Прізвище</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="members[{{$count}}][surname]" class="form-control name_list" required value="{{ $data }}"/>
                                                </div>
                                            </div>
                                        @elseif($attribute=='first_name')
                                            <div class="form-group">
                                                <label  class="col-md-4 control-label">Ім'я</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="members[{{$count}}][first_name]" class="form-control name_list" required value="{{ $data }}"/>
                                                </div>
                                            </div>
                                        @elseif($attribute=='duty')
                                            <div class="form-group">
                                                <label  class="col-md-4 control-label">Діяльність на фестивал</label>
                                                <div class="col-md-7">
                                                    <input type="text" name="members[{{$count}}][duty]" class="form-control name_list" required value="{{ $data }}"/>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn btn-info btn-sm" name="remove" id="btn_remove" title="Удалить участника">
                                                        <i class="fa fa-user-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <input hidden {{$count++}}>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                <button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>Додати учасника</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Зберегти
                                </button>
                            </div>
                        </div>
                    </form>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            var postURL = "<?php echo url('expo/edit'); ?>";
                            var i="<?php echo $count; ?>";
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
                                        '<label class="col-md-4 control-label">Ім`\я</label>' +
                                        '<div class="col-md-8">' +
                                        '<input type="text" name="members['+i+'][first_name]" class="form-control name_list" required/>' +
                                        '</div>' +
                                        '</div>'+
                                        '<div class="form-group">' +
                                        '<label class="col-md-4 control-label">Діяльність на фестивалі</label>' +
                                        '<div class="col-md-7">' +
                                        '<input type="text" name="members['+i+'][duty]" class="form-control name_list" required/>' +
                                        '</div>' +
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

            <div class="panel panel-default">
                <div class="panel-heading">Прикріпити файли</div>
                <div class="panel-body">
                    <button type="button" class="btn btn-info filter" data-toggle="collapse" data-target="#filter-panel1">
                        <i class="fa fa-file" aria-hidden="true"></i> Технічні обмеження
                    </button>
                    <div id="filter-panel1" class="collapse filter-panel1">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul>
                                    <li>розміри файлів не більше 20 мегабайт</li>
                                    <li>відео та великі файли (>20 мегабайт) рекомендуємо завантажувати на інші хостинги <i class="fa fa-cloud-download" aria-hidden="true"></i> (Youtube, dropbox) та залишати посилання в коментарях</li>
                                    <li>файли менше 20 мегабайт завантажуйте в систему заявок.</li>
                                    <li>завантажуючи файли на сторонні хостинги, зверніть увагу на термін зберігання файлів. Файли повинні зберігатися до дня фестивалю (включно)!</b>!</li>
                                    <li>якщо вам потрібно видалити файл, зверніться до Організаторів, ми все зробимо!</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form action="{{ url('/upload') }}" enctype="multipart/form-data" method="post" class="dropzone" id="my-awesome-dropzone">
                        {{ csrf_field() }}
                        <div class="dz-message" data-dz-message><span>Клікніть тут мишею або перенесіть файли, щоб завантажити</span></div>>
                        <input type="hidden" name="app_kind" value="fair">
                        <input type="hidden" name="app_id" value="{{$fair->id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
