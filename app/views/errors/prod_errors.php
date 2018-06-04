<!DOCTYPE html>
<html lang="ru" class="page grid-12">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="imagetoolbar" content="no">
    <meta name="msthemecompatible" content="no">
    <meta name="cleartype" content="on">
    <meta name="HandheldFriendly" content="True">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="google" value="notranslate">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="manifest" href="/manifest.json">

    <title>Произошла ошибка: <?=$errname?></title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;amp;subset=cyrillic"
          rel="stylesheet">
    <link href="/assets/styles/app.min.css" rel="stylesheet">
</head>

<body class="page__body">
<div class="grid-12__container">
    <div class="page__section">
        <div class="error-panel">
            <h1 class="error-panel__title">Произошла ошибка: <?=$errname?></h1>
            <p>Обратитесь к администратору</p>
        </div>
    </div>
</div>

<!-- begin components-->
<script src="assets/components/jquery/dist/jquery.min.js"></script>
<script src="assets/components/table-dragger/dist/table-dragger.min.js"></script>
<!-- end components-->
<script src="assets/scripts/common.js"></script>
<div class="page__footer">
    <footer class="footer">© 2018</footer>
</div>
</body>

</html>
