<?php require_once(ROOT.'/views/layouts/admin_2_header.php'); ?>

<!-- table with documents -->
<section>
    <div class="container">
        <div class="doc-table">
            <div class="head-table">
                <div class="head-item1">Дата</div>
                <div class="head-item2">Автор документу</div>
            </div>
            <?php foreach($allDocumentInfo as $docs):?>
                <div class="item-table">
                    <div class="date"><?php echo Document::getCorrectDate($docs['date_publish']);?></div>
                    <div class="name-doc"><?php echo $docs['author'];?></div>
                    <a href="ch_doc2" id='<?php echo $docs['id'];?>' class="edit">Редагувати</a>
                </div>
            <?php endforeach;?>
        </div>
        
        <div class="info-table">
            <div class="all-ann">
                <div class="ann-title">Всього оголошень :</div>
                <div class="count-ann"><?php echo Announce::getCountOfAllAnnounce(); ?></div>
            </div>
            <div class="all-doc">
                <div class="ann-title">Всього документів :</div>
                <div class="count-doc"><?php echo Document::getCountOfAllDocument();?></div>
            </div>
        </div>
    </div>
</section>
<!-- table with documents -->

<?php require_once(ROOT.'/views/layouts/footer.php'); ?>

