<div>
    <div style="color: #74787E;">
        <div><h2>Здравствуйте, {{$nickname}}!</h2></div>
        <div><h3>Произошли изменения в завке "{{$title}}"</h3></div>
        <div><h4>Чтобы просмотреть заявку и добавить комментарии перейдите по ссылке, нажав на кнопку</h4></div>
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
        <div><h3>С уважением,<br>Оргкомитет Ханифеста</h3></div>
        <div>
            <p>Если у Вас проблеми c кнопкой "Заявка", скопируйте и вставте ссылку ниже в Ваш веб браузер:</p>
            <p> {{  url($page)}}</p>
        </div>
    </div>
</div>