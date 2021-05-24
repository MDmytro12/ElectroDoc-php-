<?php require_once(ROOT.'/views/layouts/admin_2_header.php');?>

<!-- table for deleting documents -->
   <section>
       <div class="container">
           <div>
               <div style='margin-bottom: 40px;' class="success <?php if($deleteDoc){ echo 'active';} ?>">Документ було успішно видалено!</div>
               <div style='margin-bottom: 40px;' class="success <?php if($deleteAnn){ echo 'active';} ?>">Оголошення було успішно видалено!</div>
               
               <div class="doc-table" style="padding-bottom: 150px;">
                    <div class="head-table">
                        <div class="head-item1">Дата</div>
                        <div class="head-item2">Автор документу</div>
                    </div>
                   <?php foreach ($allDocumentInfo as $doc): ?>
                        <div class="item-table">
                            <div class="date"><?php echo Document::getCorrectDate($doc['date_publish']); ?></div>
                            <div class="name-doc"><?php echo $doc['author']; ?></div>
                            <a href='del_doc' class="edit"><img class='del-doc' src="/tamplate/img/delete.svg" id="<?php echo $doc['id']; ?>" alt=""></a>
                        </div>
                    <?php endforeach;?>
               </div>
               
               <div class="doc-table" style="padding-bottom: 150px;">
                    <div class="head-table">
                        <div class="head-item1">Дата</div>
                        <div class="head-item2">Автор оголошення</div>
                    </div>
                   <?php foreach($allAnnounceInfo as $ann): ?>
                        <div class="item-table">
                            <div class="date"><?php echo $ann['date_publish']; ?></div>
                            <div class="name-doc"><?php echo $ann['author']; ?></div>
                            <a href='del_doc' class="edit" ><img class='del-ann' id="<?php echo $ann['id']; ?>" src="/tamplate/img/delete.svg" alt=""></a>
                        </div>
                    <?php endforeach; ?>
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
       </div>
   </section>
   <!-- table for deleting documents -->
   
   <script src='/tamplate/js/jquery-3.6.0.min.js'></script>
    <script src="/tamplate/js/add_del.js"></script>

<?php require_once(ROOT.'/views/layouts/footer.php'); ?>