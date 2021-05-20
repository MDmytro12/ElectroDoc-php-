<?php require_once(ROOT.'/views/layouts/admin_2_header.php'); ?>

    <!-- process of adding of new document -->
    <section>
        <div class="container">
            <div class="new-doc">
                <form method='post' class="btn-download" enctype="multipart/from-data">
                    <div class='input-file'>
                       <input type="file" name='btn-img' id='down_img' >
                       <label for='down_img'>Завантажте документ</label>
                    </div>
                    <img src="/tamplate/img/arrow.svg" class='arrow'>
                </form>
                <div class="img">
                    <div class="img1">
                        <img src="/uploades/img/docs/doc.png" class='img-img'>
                    </div>
                </div>                
                <div class="add-per">
                    <div class="per-title">
                        Позначте підрозділи , які мають право перегляду цього повідомлення :
                    </div>
                    <ul>
                        <li class="list-item">
                            <input type="checkbox" name='ksn' id='li-1' > <label for="li-1">кафедра суспільних наук ;</label>
                        </li>
                        <li class="list-item">
                            <input type="checkbox" name='ksn' id='li-2' > <label for="li-2">кафедра суспільних наук ;</label> 
                        </li>
                        <li class="list-item">
                            <input type="checkbox" name='ksn' id='li-3' > <label for="li-3">Відзначити всі підрозділи.</label> </li>
                        </li>
                    </ul>
                </div>
                <form action="#" method='POST'>
                    <div class="form-title">Добавте інформацію під документ  :</div>
                    <textarea name="content" class='t-area' placeholder="Введи текст ..."></textarea>
                    <input type="submit" value="Оприлюднити документ" class='input-submit'>
                </form>
            </div>
        </div>
    </section>
    <!-- process of adding of new document -->
    
    <!-- java script code -->
    <script src="/tamplate/js/jquery-3.6.0.min.js"></script>
    <script src='/tamplate/js/down_img.js'></script>
    <!-- java script code -->


<?php require_once(ROOT.'/views/layouts/footer.php');?>
