<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  href='./tamplate/css/login.css'>
        <title>ElectroDoc!</title>
    </head>
<body>
<header>
    <div class="container">
        <div class="icon">
            <img src="./tamplate/img/icon.svg" alt="Icon!">
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="login">
            <form action="/" method='POST' >
                <div class="login-title">Авторизація</div>
                <div class="input-title">Ваш ідентефікатор :</div>
                <input type="text" maxlength="30" name='login' placeholder="Введи ідентифікатор" class='input-login'>
                <div class="input-title">Ваш пароль  :</div>
                <input type="password" name='password' maxlength="16" placeholder="Введи пароль" class='input-password'>
                <input type="submit" name='submit' value="Увійти">
            </form>
        </div>
        <div class="error <?php if($resultOfCheck == 'error_input'){ echo 'active';}?>">Пароль або ідентефікатор введено не вірно !</div>
        <div class="error <?php if($resultOfCheck == 'no_user'){ echo 'active'; }?>">Не існує такого профілю!</div>
        <div class="error <?php if($resultOfCheck == 'empty_field'){ echo 'active';}?>">Не залишайте поля пустими!</div>
    </div>

</section>