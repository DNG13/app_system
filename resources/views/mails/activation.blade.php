<div>
    <div style="color: #74787E;">
        <div><h2>Вітання, {{$nickname}}!</h2></div>
        <div><h3>Ви успішно зареєструвалися на сайті Харківського фендом-фестивалю.</h3></div>
        <div><h3>Щоб підтвердити свій обліковий запис, перейдіть за посиланням, натиснувши кнопку</h3></div>
        <div style="text-align: center;">
            <a style="background-color: blue;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;" href="{{ url('user/activation', [$id, $confirmation_code])}}">Підтвердження профілю</a>
        </div>
        <div><h3>З повагою,<br>Оргкомітет фестивалю Ханіфест</h3></div>
        <div>
            <p>Якщо у Вас проблеми з кнопкою "Підтвердження профілю", скопіюйте та вставте посилання нижче у Ваш веб-браузер:</p>
            <p> {{ url('user/activation', [$id, $confirmation_code])}}</p>
        </div>
    </div>
</div>