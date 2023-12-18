<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Письмо</title>
</head>
<body>
<p>Добрый день, {{ $requestModel->user->name }}</p>
<p>Ваш запрос: {{ $requestModel->message }}</p>
<p>Наш ответ: {{ $requestModel->comment }}</p>
<p>Спасибо вам, что пользуетесь нашим сервисом!</p>
</body>
</html>
