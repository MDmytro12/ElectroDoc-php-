<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/tamplate/css/user_show_dos.css">
    <link rel="stylesheet" href="/tamplate/css/admin_show_doc.css">
    <link rel="stylesheet" href="/tamplate/css/admin_add_doc.css">
    <link rel="stylesheet" href="/tamplate/css/admin_ch_doc.css"/>
    <link rel="stylesheet" href="/tamplate/css/admin_ch_doc2.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroDoc!</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="icon">
                <img src="/tamplate/img/icon.svg" alt="Icon!">
                <a href="cab" class='link-cab' >Мій кабінет</a>
                <a href="adminis" class='link-admin  active'>Адміністрування</a>
                <a href="log" class='link-logout' >Вихід</a>
            </div>
        </div>
    </header>

    <!-- user informatoin -->
    <section>
        <div class="container">
            <div class="user-info">
                <div class="item-1">
                    <div class="info-title">Підрозділ :  <span>СТРОЙОВА ЧАСТИНА</span> ;</div>
                    <div class="info-title">Cтатус :  <span class='status'>Адміністратор</span> ;</div>
                </div>
                <div class="info-title">Ідентефікатор користувача : <span>chief_of_English_department</span> ;</div>
            </div>
        </div>
    </section>
    <!-- user informatoin -->

    <!-- admin links --> 
    <section>
        <div class="container">
            <div class="admin-link">
                <a href="adminis" class='link-add-doc <?php if($btn_user == 'add'){ echo 'active'; } ?>'>Оприлюднити документ</a>
                <a href="ch_doc" class='link-ch-doc <?php if($btn_user == 'ch'){ echo 'active'; } ?>'>Змінити існуючі документи</a>
                <a href="del_doc" class='link-del-doc <?php if($btn_user == 'del'){ echo 'active'; } ?>'>Видалити документ зі списку </a>
            </div>
        </div>
    </section>
    <!-- admin links -->