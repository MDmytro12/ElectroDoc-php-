<?php require_once(ROOT.'/views/layouts/admin_2_header.php');?>

<!-- form for changing document on the site -->
<section>
    <div class="container">
        <div class="ch-doc">
            <div style='padding-bottom: 50px;'>
                <form action="ch_doc2" method='post' >
                    <div class="edit-doc">
                        <div class="title">Редагування документу</div>
                    </div>
                    <div class="input-field">
                        <div class="title">Дата публікації : </div>
                        <input type="text" placeholder="<?php echo Document::getCorrectDate($documentInfo['date_publish']);?>" name="doc-date" class='input' value="<?php echo Document::getCorrectDate($documentInfo['date_publish']);?>">
                    </div>
                    <div class="input-field">   
                        <div class="title">Автор документу : </div>
                        <input type="text" placeholder="<?php echo $documentInfo['author']; ?>" name="author" class='input' value="<?php echo $documentInfo['author']; ?>">
                    </div>
                    <div class="title t1">Інформація під документ : </div>
                    <textarea name="doc-content" placeholder='Введи текст ...'><?php echo $documentInfo['content']; ?></textarea>
                    <input type="submit" name='doc-submit' value="Змінити документ">
                </form>
                <div class="error <?php if($error){ echo 'active'; } ?>">Дані було введено не коректно!</div>
                <div class="success <?php if($is_changed){ echo 'active';} ?>">Документ було успішно змінено!</div>
            </div>
        </div>
    </div>
</section>
<!-- form for changing document on the site -->

<script src='/tamplate/js/jquery-3.6.0.min.js'></script>
<script src="/tamplate/js/ch_doc_2.js"></script>
<?php require_once(ROOT.'/views/layouts/footer.php'); ?>

