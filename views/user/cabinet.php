<?php require_once(ROOT.'/views/layouts/user_header.php');?>
    <!-- document information -->
    <section>
        <div class="container">
            <?php if(count($documentInfo) == 0  and count($announceInfo) == 0 ): ?>
                <div style='padding-bottom: 20px;color: #0E5B74; width: 100%; text-align:center; font-size: 40px; font-weight: 600;'>Документи та оголошення поки що не було опубліковано!</div>
            <?php endif; ?>
            <?php foreach ( $documentInfo as $item ): ?>
                <div>
                    <div class="block-doc">
                        <div class="doc-img">
                            <iframe src='<?php echo Document::getImage($item['id']);?>' frameborder="0">
                            </iframe>
                        </div>
                        <div class="doc-info">
                            <div class="list-title">Інформація про документ:</div>
                            <ul>
                                <li class="list-item"><?php echo $item['content'];?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="block-sup-doc">
                        <div class="under-doc">Додано :  <span><?php echo Document::getCorrectDate($item['date_publish']);?></span> </div>
                    </div>
                </div>  
            <?php endforeach;?>
        </div>              
    </section>
    <!-- document information -->

    <!-- announcment information -->
    <section>
        <div class="container"> 
            <div class="ann-wrapper">
                <?php foreach($announceInfo as $item):?>
                    <div>
                       <div class="ann">
                            <div class="ann-title">ОГОЛОШЕННЯ</div>
                            <div class="ann-content"><?php echo $item['content']?></div>
                            <div class="info-ann">
                                <div class="ann-author">Автор :<span><?php echo $item['author'];?></span></div>
                                <div class="ann-date">Дата :<span><?php echo Document::getCorrectDate($item['date_publish']);?></span></div>
                            </div>
                        </div> 
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <!-- announcment information -->

<?php require_once(ROOT.'/views/layouts/footer.php');?>