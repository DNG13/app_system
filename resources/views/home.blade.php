@extends('layouts.app')

@section('title', 'Правила')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel-heading">
            <h3>Учасникам</h3>
        </div>
        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                <h4><strong>Ласкаво просимо. Ви успішно залогинись.</strong></h4>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>
                        {{ $message }}
                    </p>
                </div>
            @endif
            <p> Дорогі друзі, щоб взяти участь у фестивалі, необхідно ознайомитися з правилами та подати заявку.
                Правила та форма подання заявки відрізняється для кожної категорії. Тому рекомендуємо ознайомитися з інформацією в розділі, що вас цікавить:</p>
            <ul>
                <li>для бажаючих взяти участь у сценічній програмі фестивалю (сценки, дефіле, караоке, танці, k-pop тощо) — розділ <a href="https://khanifest.com/participant/cosplay/">«Косплей-шоу»</a>;</li>
                <li>ті, хто хоче взяти участь у ярмарку фестивалю (хендмейдери та магазини, стенди та ігрозони, художники та письменники, фудкорти та багато інших), можуть знайти інформацію у розділі <a href="https://khanifest.com/participant/fair/">«Ярмарок»</a>;</li>
                <li>фотографи та ЗМІ, які бажають отримати акредитацію, повинні ознайомитися з інформацією у розділі <a href="https://khanifest.com/participant/press/">«Преса»</a>;</li>
                <li>ті ж, хто хоче брати безпосередню участь в організації фестивалю та надавати посильну допомогу, можуть подати заявку після прочитання правил — розділ <a href="https://khanifest.com/participant/volunteers/">«Волонтерство»</a>;</li>
            </ul>
            <p>а знайти, як зв'язатися з координаторами можна у розділі <a href="https://khanifest.com/about/contact/">«Контакти»</a>.</p>
        </div>
    </div>
</div>
@endsection
