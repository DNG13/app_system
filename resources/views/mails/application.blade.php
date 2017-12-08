<div>
    <div style="text-align: center;"><h2>{{ config('app.name') }}</h2></div>
    <div style="color: #74787E;">
        <div><h3>Поздравляем, Ваша заявка успешно отправлена!.</h3></div>
        <div><h4>Обращаем Ваше внимание, что общение с координаторами происходит непосредственно в системе заявок,
                а не через электронную почту фестиваля.
                Не забывайте, что все правила находятся на нашем сайте:
            </h4></div>
        <div style="text-align: center;">
            <a style="background-color: blue;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;" href="{{ url('/')}}">Правила</a></div>
        <div><h4>Убедительно просим изучить их во избежание недоразумений.</h4></div>
        <div><h4>Просмотреть статус своей заявки можно по ссылке: {{ url('/cosplay')}}</h4></div>
    </div>
    <div><h3>С уважением,<br>Оргкомитет Ханифеста</h3></div>
    <div><p>Если у Вас проблеми кнопкой "Правила",</p>
        <p> скопируйте и вставте ссылку ниже в Ваш веб браузер:</p>
        <p> {{ url('/')}}</p>
    </div>
</div>