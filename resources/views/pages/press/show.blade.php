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
                                    <p id="type_id"  class="form-control" name="type_id">{{ $press->type_id }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="media_name" class="col-md-4 control-label">Наименование СМИ/никнейм</label>
                                <div class="col-md-6">
                                    <p id="media_name" class="form-control" name="media_name" >{{ $press->media_name }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_name" class="col-md-4 control-label">Контактное лицо</label>
                                <div class="col-md-6">
                                    <p id="contact_name" class="form-control" name="contact_name">{{ $press->contact_name }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city" class="col-md-4 control-label">Город</label>
                                <div class="col-md-6">
                                    <p id="city" class="form-control" name="city">{{ $press->city }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Телефон</label>
                                <div class="col-md-6">
                                    <p id="phone"  class="form-control" name="phone">{{ $press->phone }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="portfolio_link" class="col-md-4 control-label">Ссылка на портфолио</label>
                                <div class="col-md-6">
                                    <p id="portfolio_link" class="form-control" name="portfolio_link">{{ $press->portfolio_link }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="camera" class="col-md-4 control-label">Модель камеры</label>
                                <div class="col-md-6">
                                    <p id="camera"  class="form-control" name="camera">{{ $press->camera }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="members_count" class="col-md-4 control-label">Количество представителей</label>
                                <div class="col-md-6">
                                    <p id="members_count" min="1" class="form-control" name="members_count">{{ $press->members_count }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="equipment" class="col-md-4 control-label">Доп. техника</label>
                                <div class="col-md-6">
                                    <textarea  id="equipment" rows="5" class="form-control" name="equipment">{{ $press->equipment }}</textarea>
                                </div>
                            </div>

                            @if(!$social_links->vk==null)
                                <div class="form-group">
                                    <label for="social_links[vk]" class="col-md-4 control-label">VK</label>
                                    <div class="col-md-6">
                                        <p id="social_links[vk]" class="form-control" name="social_links[vk]"> {{ $social_links->vk}}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$social_links->fb==null)
                                <div class="form-group">
                                    <label for="social_links[fb]" class="col-md-4 control-label">Facebook</label>
                                    <div class="col-md-6">
                                        <p id="social_links[fb]" class="form-control" name="social_links[fb]"> {{$social_links->fb }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$social_links->sk==null)
                                <div class="form-group">
                                    <label for="social_links[sk]" class="col-md-4 control-label">Skype</label>
                                    <div class="col-md-6">
                                        <p id="social_links[sk]" class="form-control" name="social_links[sk]" > {{ $social_links->fb }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(!($social_links->tg)==null)
                                <div class="form-group">
                                    <label for="social_links[tg]" class="col-md-4 control-label">Telegram</label>
                                    <div class="col-md-6">
                                        <p id="social_links[tg]" class="form-control" name="social_links[tg]">{{ $social_links->tg }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/press/{{ $press->id }}/edit" class="btn btn-primary" role="button">Редактировать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
