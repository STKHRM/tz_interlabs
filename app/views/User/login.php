<div class="page__login">
    <!-- begin .login-form-->
    <div class="login-form">
        <div class="login-form__header">
            <h1 class="login-form__title">Авторизация</h1>
        </div>
        <!-- begin .form-->
        <form action="/user/login" method="post" class="form">
            <div class="form__line">
                <label for="login" class="form__label">Логин:</label>
                <input type="text" name="login" required="required" id="login" class="form__text">
            </div>
            <div class="form__line">
                <label for="password" class="form__label">Пароль:</label>
                <input type="password" name="password" required="required" id="password" class="form__text">
            </div>
            <div class="form__controls">
                <input type="submit" value="Войти" class="button">
            </div>
        </form>
        <!-- end .form-->
    </div>
    <!-- end .login-form-->
</div>