<?php require_once(ROOT.'/views/layouts/user_header.php');?>
    <!-- document information -->
    <section>
        <div class="container">
            <?php if(count($documentInfo) == 0  and count($announceInfo) == 0 or in_array((int)$_SESSION['id'], $whosee) == false): ?>
                <div style='padding-bottom: 20px;color: #0E5B74; width: 100%; text-align:center; font-size: 40px; font-weight: 600;'>Документи та оголошення поки що не було опубліковано!</div>
            <?php endif; ?>
            <?php foreach($documentInfo as $item):?>
                <?php if(in_array((string)$_SESSION['id'],json_decode($item['who_see']) )  ): ?>
                    <div>
                        <div class="block-doc">
                            <div class="doc-img">
                                <iframe class='<?php if((int)json_decode($item['browsed'])[$userCount] == 0 ){ echo 'iframe';} ?>' src='<?php echo Document::getImage($item['id']);?>' id='<?php echo $item['id']; ?>' frameborder="0">
                                </iframe>[$userCount] 
                                <div class='br <?php if((int)json_decode($item['browsed'])[$userCount] == 0 ){ echo 'active';} ?>'>Не переглянуто</div>
                                <div class='br1 <?php if((int)json_decode($item['browsed'])[$userCount] == 1 ){ echo 'active';} ?>'>Переглянуто</div>
                            </div>
                            <div class="doc-info">
                                <div class="list-title">Інформація про документ:</div>
                                <ul>
                                    <li class="list-item"><?php echo $item['content']; ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="block-sup-doc">
                            <div class="under-doc">Додано :  <span><?php echo Document::getCorrectDate($item['date_publish'])?></span> </div>
                        </div>
                    </div>
                <?php endif;?>
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
    
    <script src='/tamplate/js/jquery-3.6.0.min.js'></script>
    <script src='/tamplate/js/admin_cab.js'></script>

<?php require_once(ROOT.'/views/layouts/footer.php');?>