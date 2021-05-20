<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/tamplate/css/user_show_dos.css">
    <link rel="stylesheet" href="/tamplate/css/admin_show_doc.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroDoc!</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="icon">
                <img src="/tamplate/img/icon.svg" alt="Icon!">
                <a href="cab" class='link-cab active' >Мій кабінет</a>
                <a href="adminis" class='link-admin '>Адміністрування</a>
                <a href="log" class='link-logout' >Вихід</a>
            </div>
        </div>
    </header>

    <!-- user informatoin -->
    <section>
        <div class="container">
            <div class="user-info">
                <div class="item-1">
                    <div class="info-title"><?php echo $adminInfo['type_unit']?> :  <span><?php echo $adminInfo['name_unit']; ?></span> ;</div>
                    <div class="info-title">Cтатус :  <span class='status'>Адміністратор</span> ;</div>
                </div>
                <div class="info-title">Ідентефікатор користувача : <span><?php echo $adminInfo['identef']; ?></span> ;</div>
            </div>
        </div>
    </section>
    <!-- user informatoin -->

    <!-- user buttons -->
    <section>
        <div class="container">
            <div class="user-btn">
                <a href="cab" class='btn-doc active'>Документи</a>
                <a href="add_ann" class='btn-ann'>Додати оголошення</a>
            </div>
            
        </div>
    </section>
    <!-- user buttons -->