<?php require_once(ROOT.'/views/layouts/user_header.php');?>
    <!-- document information -->
    <section>
        <div class="container">
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
                <div>
                   <div class="ann">
                    <div class="ann-title">РЕЗОЛЮЦІЯ</div>
                    <div class="ann-content">інормація ;</div>
                    <div class="info-ann">
                        <div class="ann-author">Автор : <span>Medvedv Dmytro</span></div>
                        <div class="ann-date">Дата : <span> 21.04.2021</span></div>
                    </div>
                </div> 
                </div>
            </div>
        </div>
    </section>
    <!-- announcment information -->

<?php require_once(ROOT.'/views/layouts/footer.php');?>