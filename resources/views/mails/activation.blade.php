<div>
    <div style="color: #74787E;">
        <div><h2>Здравствуйте, {{$nickname}}!</h2></div>
        <div><h3>Вы успешно зарегистрировались на сайте Харьковского аниме-фестиваля.</h3></div>
        <div><h3>Что бы подтвердить свою учетную запись перейдите по ссылке, нажав на кнопку</h3></div>
        <div style="text-align: center;">
            <a style="background-color: blue;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;" href="{{ url('user/activation', [$id, $confirmation_code['code']])}}">Подтверждение профиля</a>
        </div>
        <div><h3>С уважением,<br>Оргкомитет Ханифеста</h3></div>
        <div>
            <p>Если у Вас проблеми c кнопкой "Подтверждение профиля", скопируйте и вставте ссылку ниже в Ваш веб браузер:</p>
            <p> {{ url('user/activation', [$id, $confirmation_code['code']])}}</p>
        </div>
    </div>
</div>