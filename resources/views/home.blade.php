@extends('layouts.app')

@section('title', 'Правила')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel-heading">
            <h3>Участникам</h3>
        </div>
        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                <h4><strong>Добро пожаловать. Вы успешно залогинились.</strong></h4>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>
                        {{ $message }}
                    </p>
                </div>
            @endif
            <p> Дорогие друзья, чтобы принять участие в фестивале необходимо ознакомиться с правилами и подать заявку.
                Правила и форма подачи заявки отличается для каждой категории. Поэтому настоятельно рекомендуем ознакомиться с информацией в интересующем вас разделе:</p>
            <ul>
                <li>для желающих принять участие в сценической программе фестиваля (сценки, дефиле, караоке, танцы, k-pop и т.д.) — раздел <a href="http://khanifest.com/?page_id=355">«Косплей-шоу»</a>;</li>
                <li>те, кто хочет принять участие в ярмарке фестиваля (хендмейдеры и магазины, стенды и игрозоны, художники и писатели, фудкорты и многие другие), могут найти информацию в разделе <a href="http://khanifest.com/?page_id=365">«Ярмарка»</a>;</li>
                <li>фотографы и сми, желающие получить аккредитацию, должны ознакомиться с информацией в разделе <a href="http://khanifest.com/?page_id=358">«Пресса»</a>;</li>
                <li>те же, кто хочет принимать непосредственное участие в организации фестиваля и оказывать посильную помощь, могут подать заявку после прочтения правил — раздел <a href="http://khanifest.com/?page_id=352">«Волонтерство»</a>;</li>
            </ul>
            <p>а найти, как связаться с координаторами можно в разделе <a href="http://khanifest.com/?page_id=459">«Контакты»</a>.</p>
        </div>
    </div>
</div>
@endsection
