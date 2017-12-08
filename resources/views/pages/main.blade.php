@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="entry-title">Добро пожаловать в систему заявок Харьковского фендом-фестиваля Ханифест!</h2>
                    </div>
                    <div class="panel-body">
                            <p>Фендомные мероприятия в нашем городе проходят с 2006 года. Не станет исключением и 2017-й!</p>
                            <p>В этом году Ханифест открывает еще больше дверей и пройдет в формате экспо. Фестиваль мультифендомный: аниме, игры, кино и прочее - мы рады всем!</p>
                            <p>Фестиваль пройдет 22 апреля 2017. Тема фестиваля в этом году -
                                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"><b>Online</b></a>.
                                Это не только котики и ЛоЛ, онлайн - это фильмы и игры, инстаграм и вирусы, облака и Доктор Кто?, анонимусы и не очень, мемы и шерлокнутые, холиворы и не очень.<br/><br/>
                                Хотя мы-то с вами знаем, что в первую очередь - это
                                <a href="https://www.youtube.com/watch?v=QH2-TGUlwu4" target="_blank">котики</a>.
                            </p>
                            <p>Ждем вас весной!</p>
                            <p>P.S.<br/><a href="{{url('/home')}}" target="_blank">Правила подачи заявок</a></p>
                            <p>Ходор!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
