<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/tamplate/css/user_show_dos.css">
    <link rel="stylesheet" href="/tamplate/css/user_add_ann.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroDoc!</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="icon">
                <a href='cab'><img src="/tamplate/img/icon.svg" alt="Icon!"></a>
                <a href="cab" class='link-cab active'>Мій кабінет</a>
                <a href="log" class='link-logout'>Вихід</a>
            </div>
        </div>
    </header>

    <!-- user informatoin -->
    <section>
        <div class="container">
            <div class="user-info">
                <div class="item-1">
                    <div class="info-title"><?php echo $userInfo['type_unit']; ?> :  <span><?php echo $userInfo['name_unit'];?></span> ;</div>
                    <div class="info-title">Cтатус :  <span class='status'>Користувач</span> ;</div>
                </div>
                <div class="info-title">Ідентефікатор користувача : <span><?php echo $userInfo['identef'];?></span> ;</div>
            </div>
        </div>
    </section>
    <!-- user informatoin -->

    <!-- user buttons -->
    <section>
        <div class="container">
            <div class="user-btn">
                <a href="cab" class='btn-doc  <?php if($doc_ann == 'doc'){ echo 'active'; }?>'>Документи</a>
                <a href="add_ann" class='btn-ann  <?php if($doc_ann['user_btn'] == 'ann' ){ echo 'active'; }?>'>Додати оголошення</a>
            </div>
            
        </div>
    </section>
    <!-- user buttons -->
