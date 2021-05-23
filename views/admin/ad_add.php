<?php require_once(ROOT.'/views/layouts/admin_2_header.php'); ?>

    <!-- process of adding of new document -->
    <section>
        <div class="container">
            <div class="new-doc">
                <form method='post' class="btn-download" enctype="multipart/from-data">
                    <div class='input-file'>
                       <input type="file" name='btn-img' id='down_img' >
                       <label for='down_img' id='label_img'>Завантажте документ</label>
                    </div>
                    <img src="/tamplate/img/arrow.svg" class='arrow'>
                </form>
                <div class="img">
                    <div class="img1">
                        <div class='img-wrap'>
                            <img src="/uploades/img/docs/dow_img.svg" class='img-img' id='img1'>
                        </div>
                    </div>
                </div>
                <div class="add-per">
                    <div class="per-title">
                        Позначте підрозділи , які мають право перегляду цього документу :
                    </div>
                    <ul>
                        <?php foreach($allUsersIdentef as $item):?>
                            <li class="list-item">
                                <input type="checkbox" class='li' name='<?php echo $item['id']; ?>' id='li-<?php echo $item['id'];?>' > <label for="li-<?php echo $item['id'];?>"><?php echo $item['all_name']?> ;</label>
                            </li>
                        <?php endforeach;?>
                        <li class="list-item">
                                <input type="checkbox" class='li' name='all' id='all' > <label for="all"> відзначити всі підрозділи ;</label>
                        </li>
                    </ul>
                </div>
                <div style="padding-bottom:30px;">
                    <form action="adminis" method='POST'>
                        <div class="form-title">Добавте інформацію під документ  :</div>
                        <textarea name="content" class='t-area' placeholder="Введи текст ..."></textarea>
                        <input type="submit" name='submit-del' value="Оприлюднити документ" class='input-submit'>
                    </form>
                    <div class="empty <?php if($_SESSION['empty_field']){ echo 'active'; $_SESSION['empty_field']=false;} ?>">Не залишайте текстове поле пустим!</div>
                    <div class="success <?php if($_SESSION['success']){ echo 'active';} ?>">Документ було успішно опубліковано!</div>
                </div>
            </div>
        </div>
    </section>
    <!-- process of adding of new document -->
    
    <!-- java script code -->
    <script src="/tamplate/js/jquery-3.6.0.min.js"></script>
    <script src='/tamplate/js/down_img.js'></script>
    <!-- java script code -->


<?php require_once(ROOT.'/views/layouts/footer.php');?>
