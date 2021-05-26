<?php require_once(ROOT.'/views/layouts/user_header.php');?>
    <!-- document information -->
    <section>
        <div class="container">
            <?php if((count($documentInfo) == 0  and count($announceInfo) == 0 ) or in_array((int)$_SESSION['id'], $whosee)==false and count($announceInfo) == 0): ?>
                <div style='padding-bottom: 20px;color: #0E5B74; width: 100%; text-align:center; font-size: 40px; font-weight: 600;'>Документів та оголошень поки що не було опубліковано!</div>
            <?php endif; ?>
            <?php foreach($documentInfo as $item):?>
                <?php if(in_array($_SESSION['id'],json_decode($item['who_see']))): ?>
                    <div>
                        <div class="block-doc">
                            <div class="doc-img" id='<?php echo $item['id'] ;?>'>
                                <?php if((int)$item['img_path'] > 1):?>
                                    <div class='arrow-left arrow-btn'>&#8249</div>
                                    <div class='arrow-right arrow-btn'>&#8250</div>
                                <?php endif;?>
                                <?php if((int)$item['img_path'] <= 1): ?>
                                    <div class='iff <?php if((int)json_decode($item['browsed'])[$userCount] == 0 ){ echo 'iframe';} ?>'  id='<?php echo $item['id']; ?>'>
                                        <img class='image-items active' id='0' src='<?php print_r(Document::getImage($item['id'])); ?>' />
                                    </div>
                                <?php endif;?>
                                <?php if((int)$item['img_path'] > 1 ):?>
                                    <div  class='iff <?php if((int)json_decode($item['browsed'])[$userCount] == 0 ){ echo 'iframe';} ?>' id='<?php echo $item['id']; ?>'>
                                        <?php $firstClass = true ;?>
                                        <?php $count = 0 ; ?>
                                        <?php foreach(Document::getImage($item['id']) as $image):?>
                                            <?php if($count == 0):?>
                                                <img class='image-items active' id='<?php echo $count; ?>' src='<?php echo $image;?>' />
                                            <?php endif; ?>
                                            <?php if($count > 0):?>
                                                <img class='image-items' id='<?php echo $count; ?>' src='<?php echo $image;?>' />
                                            <?php endif; ?>
                                            <?php $count = $count + 1 ; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif;?>
                                <?php if((int)$item['img_path'] > 1 ):?>
                                    <div class='img-count'>
                                        <?php $count = 0 ; ?>
                                        <?php for($i = 0 ; $i < (int)$item['img_path'] ; $i++ ): ?>
                                            <?php if($i == 0 ):?>
                                                <div class='img-item active' id='<?php echo $count; ?>'></div>
                                            <?php endif; ?>
                                            <?php if($i > 0): ?>
                                                <div class='img-item' id='<?php echo $count; ?>'></div>
                                            <?php endif; ?> 
                                            <?php $count = $count + 1; ?>
                                        <?php endfor;?>
                                    </div>
                                <?php endif;?>
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
                <?php endif ?>
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
    <script src='/tamplate/js/slider.js'></script>
    
<?php require_once(ROOT.'/views/layouts/footer.php');?>