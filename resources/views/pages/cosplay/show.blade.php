@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Косплей-шоу. Подробнее</div>

                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="type_id" class="col-md-4 control-label">Тип заявки</label>
                                <div class="col-md-6">
                                    <p id="type_id"  class="form-control" name="type_id">{{ $app_cosplay->type_id }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">Название постановки</label>
                                <div class="col-md-6">
                                    <p id="title"  class="form-control" name="title">{{ $app_cosplay->title }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fandom" class="col-md-4 control-label">Источник (фендом)</label>
                                <div class="col-md-6">
                                    <p id="fandom" class="form-control" name="fandom">{{ $app_cosplay->fandom }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="length" class="col-md-4 control-label">Продолжительность(минут)</label>
                                <div class="col-md-6">
                                    <p id="length"  class="form-control" name="length">{{ $app_cosplay->length }}</p>
                                </div>
                            </div>

                            <div class="form-group{">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <p id="city"  class="form-control" name="city">{{ $app_cosplay->city }}</p>
                                </div>
                            </div>

                            @if(!$app_cosplay->comment==null)
                            <div class="form-group">
                                <label for="prev_part" class="col-md-4 control-label">Предыдущее участие</label>
                                <div class="col-md-6">
                                    <p id="prev_part"  class="form-control" name="prev_part">{{ $app_cosplay->comment }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!$app_cosplay->comment==null)
                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Коментарий</label>
                                <div class="col-md-6">
                                    <textarea  id="comment" class="form-control" name="comment">{{ $app_cosplay->comment }}</textarea>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea  id="description" class="form-control" name="description" required>{{ $app_cosplay->description }}</textarea>
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
                                            <td><p type="text" name="members[{{$count}}][surname]" class="form-control name_list" required>{{ $data }}</p></td>
                                        </tr>
                                        @elseif($attribute=='first_name')
                                        <tr>
                                            <td><strong>Имя</strong></td>
                                            <td><p type="text" name="members[{{$count}}][first_name]" class="form-control name_list" required>{{ $data }}</p></td>
                                        </tr>
                                        @elseif($attribute=='birthday')
                                        <tr>
                                            <td><strong>Дата рождения</strong></td>
                                            <td><p type="date" name="members[{{$count}}][birthday]" class="form-control name_list" required>{{ date('j F, Y ', strtotime($data)) }}</p></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/cosplay/{{ $app_cosplay->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
