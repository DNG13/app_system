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

                            <div class="form-group">
                                <label for="prev_part" class="col-md-4 control-label">Предыдущее участие</label>
                                <div class="col-md-6">
                                    <p id="prev_part"  class="form-control" name="prev_part">{{ $app_cosplay->prev_part }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Коментарий</label>
                                <div class="col-md-6">
                                    <textarea  id="comment" class="form-control" name="comment">{{ $app_cosplay->comment }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Описание</label>
                                <div class="col-md-6">
                                    <textarea  id="description" class="form-control" name="description">{{ $app_cosplay->description }}</textarea>
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
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
