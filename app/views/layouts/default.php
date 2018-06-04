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

    <?if(!empty($title)):?>
        <title><?=$title?></title>
    <?else:?>
        <title>Page Title</title>
    <?endif;?>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;amp;subset=cyrillic"
          rel="stylesheet">
    <link href="/assets/styles/app.min.css" rel="stylesheet">
</head>

<body class="page__body">
<div class="page__header">
    <!-- begin .header-->
    <header class="header">
        <div class="grid-12__container">
            <div class="grid-12__row">
                <div class="grid-12__col grid-12__col_size_4">
                    <div class="header__logo">
                        <!-- begin .logo-->
                        <a class="logo" href="/">
                            <img src="/assets/images/logo.svg" alt="..." class="logo__image" />
                        </a>
                        <!-- end .logo-->
                    </div>
                </div>
                <div class="grid-12__col grid-12__col_size_8">
                    <?if(!empty($authorizedUser['id'])):?>
                        <div class="header__user">
                            Вы вошли как:
                            <b><?=$authorizedUser['login'];?></b>
                            <a href="/user/logout" class="button">Выйти</a>
                        </div>
                    <?else:?>
                        <div class="header__user">
                            <a href="/user/login" class="button">Войти</a>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </header>
    <!-- end .header-->
</div>
<div class="page__notifications">
    <!-- begin .notifications-->
    <div class="notifications">
        <?if(!empty($_SESSION['messages'])):?>
            <?foreach ($_SESSION['messages'] as $key => $message):?>
                <div class="notifications__item">
                    <div class="alert alert_style_<?=$message['type']?>">
                        <?=$message['text']?> <?unset($_SESSION['messages'][$key])?>
                        <button class="alert__close js-alert-close">&#215;</button>
                    </div>
                </div>
            <?endforeach;?>
        <?endif;?>
    </div>
    <!-- end .notifications-->
</div>

<main class="page__content">
    <div id="content" class="grid-12__container">
        <?=$content?>
    </div>
</main>
<div class="page__modal" id="entryFormWrapper">
    <div class="page__modal-overlay">
        <div class="page__modal-content">
            <div class="page__panel">
                <!-- begin .entry-form-->
                <div class="entry-form">
                    <!-- begin .panel-->
                    <div class="panel">
                        <div class="panel__header">
                            <h2 class="panel__title" data-title="Добавить нового пользователя">Добавить нового пользователя</h2>
                        </div>
                        <!-- begin .form-->
                        <form action="/data/add" class="form js-ajax-entry-form" id="entryForm">
                            <div class="grid-12__container">
                                <div class="grid-12__row">
                                    <div class="grid-12__col grid-12__col_size_4">
                                        <div class="form__line">
                                            <label for="full_name" class="form__label">Имя:</label>
                                            <input type="text" name="full_name" id="full_name" class="form__text" required>
                                        </div>
                                    </div>
                                    <div class="grid-12__col grid-12__col_size_4">
                                        <div class="form__line">
                                            <label for="email" class="form__label">E-mail:</label>
                                            <input type="email" name="email" id="email" class="form__text">
                                        </div>
                                    </div>
                                    <div class="grid-12__col grid-12__col_size_4">
                                        <div class="form__line">
                                            <label for="sort" class="form__label">Сортировка:</label>
                                            <input type="number" name="sort" id="sort" class="form__text">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid-12__row">
                                    <div class="grid-12__col">
                                        <div class="form__line">
                                            <label for="address" class="form__label">Адрес:</label>
                                            <textarea type="address" name="address" id="address" class="form__textarea"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid-12__row">
                                    <div class="grid-12__col">
                                        <div class="form__controls">
                                            <div class="form__control">
                                                <button type="button" class="button button_style_default js-close-modal">Отменить</button>
                                            </div>
                                            <div class="form__control">
                                                <input type="submit" value="Сохранить" class="button">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id">
                        </form>
                        <!-- end .form-->
                        <button type="button" class="panel__close js-close-modal">Закрыть</button>
                    </div>
                    <!-- end .panel-->
                </div>
                <!-- end .entry-form-->
            </div>
        </div>
    </div>
</div>
<!-- begin components-->
<script src="/assets/components/jquery/dist/jquery.min.js"></script>
<script src="/assets/components/table-dragger/dist/table-dragger.min.js"></script>
<!-- end components-->
<script src="/assets/scripts/common.js"></script>
<div class="page__footer">
    <footer class="footer">© 2018</footer>
</div>
</body>

</html>
