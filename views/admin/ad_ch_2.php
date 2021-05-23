<?php require_once(ROOT.'/views/layouts/admin_2_header.php');?>

<!-- form for changing document on the site -->
<section>
    <div class="container">
        <div class="ch-doc">
            <form action="#" >
                <div class="edit-doc">
                    <div class="title">Редагування документу</div>
                </div>
                <div class="input-field">
                    <div class="title">Дата публікації : </div>
                    <input type="text" placeholder="21.04.2021" name="doc-date" class='input'>
                </div>
                <div class="input-field">
                    <div class="title">Автор документу : </div>
                    <input type="text" placeholder="chief_of_Dril_department" name="author" class='input'>
                </div>
                <div class="title t1">Інформація під документ : </div>
                <textarea name="doc-content" placeholder='Введи текст ...'></textarea>
                <input type="submit" name='doc-submit' value="Змінити документ">
            </form>
        </div>
    </div>
</section>
<!-- form for changing document on the site -->

<?php require_once(ROOT.'/views/layouts/footer.php'); ?>

