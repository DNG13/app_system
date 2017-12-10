<div>
    <div><h2>Здравствуйте, {{$nickname}}!</h2></div>
    <div style="color: #74787E;">
        <div><h2>Вы успешно зарегистрировались на сайте Харьковского аниме-фестиваля.</h2></div>
        <div><h2>Что бы подтвердить свою учетную запись перейдите по ссылке, нажав на кнопку</h2></div>
        <div style="text-align: center;">
            <a style="background-color: blue;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;" href="{{ url('user/activation', $conformation_code)}}">Подтверждение профиля</a></div>
    </div>
    <div><h2>С уважением,<br>Оргкомитет Ханифеста</h2></div>
    <div><p>Если у Вас проблеми кнопкой "Подтверждение профиля",</p>
        <p> скопируйте и вставте ссылку ниже в Ваш веб браузер:</p>
        <p> {{ url('user/activation', $conformation_code)}}</p>
    </div>
</div>