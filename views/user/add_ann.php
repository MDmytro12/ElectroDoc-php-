    <?php require_once(ROOT.'/views/layouts/user_header.php');?>

<!-- adding a new announce -->  
<section>
    <div class="container">
        <div class="add-ann-wrapper">
            <form action='add_ann' method='post' class="add-ann">
                <div class="ann-title">
                    ОГОЛОШЕННЯ
                </div>
                <div class="input">
                    <div class ='input-author'>Автор :</div>
                    <input type="text" name='name' maxlength="255" placeholder="Введи ідентифікатор автора оголошення">
                </div>
                <div class="input-author">Текст оголошення :</div>
                <textarea name="content" placeholder="Введи текст оголошення ..."></textarea>
                <input type="submit" name='submit' class='input-submit' value='Оприлюднити оголошення'>
                <div class='ann_done <?php if($send ){ echo 'active'; } ?>'>Дане оголошення було оприлюднено!</div>
                <div class='ann_error <?php if($noUserName   ){ echo 'active'; } ?> '>Не існує такого ідентифікатора користувача!</div>
            </form>
        </div>
    </div>
</section>
<!-- adding a new announce -->
<?php require_once(ROOT.'/views/layouts/footer.php');?>