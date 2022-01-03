<div>
    <div style="color: #74787E;">
        <div><h2>Вітання, {{$nickname}}!</h2></div>
        <div><h3>Нову заявку "{{$title}}" успішно відправлено!</h3></div>
        <div><h4>Щоб переглянути заявку та додати коментарі, перейдіть за посиланням, натиснувши на кнопку</h4></div>
        <div style="text-align: center;">
            <a style="background-color: blue;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;" href=" {{ url($page)}}">Заявка</a>
        </div>
        <div><h3>З повагою,<br>Оргкомітет фестивалю Ханіфест</h3></div>
        <div>
            <p>Якщо у Вас проблеми з кнопкою "Заявка", скопіюйте та вставте посилання нижче у Ваш веб-браузер:</p>
            <p> {{  url($page)}}</p>
        </div>
    </div>
</div>