<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php \App\Core\base\View::getMetaData() ?>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <?=$content?>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php
        foreach ($scripts as $script) {
            echo $script;
        }
    ?>
</body>
</html>