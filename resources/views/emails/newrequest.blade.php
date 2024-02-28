<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новая Заявка</title>
    <style>
        /* Стили для контейнера */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            font-family: Arial, sans-serif;
        }

        /* Стили для заголовка */
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Стили для текстового блока */
        p {
            line-height: 1.5;
        }

        /* Стили для кнопки */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Новая Заявка</h1>
    <p>Добрый день, <strong>{{ $details['name'] }}</strong>!</p>
    <p>Вы получили заявку от ` {{ $details['user_name'] }} </p>
    <p>Номер телефона ` {{ $details['user_phone'] }} </p>
    <p>Эл.почта ` {{ $details['user_email'] }} </p>
    <p>Тур  ` {{$details['title']}}</p>
    <p>Курорт  ` {{$details['kurort']}}</p>
    <p>Дата начала  ` {{$details['date_start']}}</p>
    <p>Дата завершения  ` {{$details['date_end']}}</p>
    <p>Количество ночей ` {{$details['date_end']}}</p>
    <p>Количество ночей ` {{$details['night_count']}}</p>
    <p>Цена ` {{$details['price']}}</p>
    <p>Цена с скидкой ` {{$details['new_price']}}</p>
    <p>С уважением,<br>CorolTravel Team</p>
</div>
</body>
</html>
