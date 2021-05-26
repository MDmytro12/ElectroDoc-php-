<?php

class AdminController{
    public function actionCabinet(){
        
       if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
           $adminInfo = Admin::getInfoAboutAdmin();
           $documentInfo = Document::getAllDocumentInfo();
           $announceInfo = Announce::getAllAnnounceInfo();
           $allUserInfo = User::getAllUserInfo1();
           $newMessage = User::getNewMessage();
           $doc_ann = 'doc';
           
           $userCount = 0 ;
            for($i = 0 ; $i < count($allUserInfo) ; $i++ ){
                if($allUserInfo[$i]['id'] == $_SESSION['id']){
                    $userCount = $i;
                    break;
                }
            }
            
           
           if(isset($_SESSION['success'])){
               $_SESSION['success'] = false;
           }
           
           require_once(ROOT.'/views/admin/cabinet.php');
       }else{
           header('Location: /');
       }    
    }
    
    public function actionLogout(){
        unset($_SESSION['empty_field']);
        unset($_SESSION['success']);   
        unset($_SESSION['id']);
        header('Location: /');
    }
    
    public function actionAdministrate(){
        if(User::checkLogging()){
            $adminInfo = Admin::getInfoAboutAdmin();
            $allUsersIdentef = User::getAllUserIdentef();
            $_SESSION['empty_field']=false;
            $btn_user = 'add';
            
            $allUserInfo = User::getAllUserInfo();
            
            
            if(isset($_POST['submit-del']) and !empty($_POST['submit-del'])){
                
                    $allImages = scandir($_SERVER['DOCUMENT_ROOT'].'/uploades/img/tmp/');
                    array_shift($allImages);
                    array_shift($allImages);

                    #checked Users
                    if(isset($_SESSION['checkedUser'])){
                        $checkedUsers = $_SESSION['checkedUser'];
                        unset($_SESSION['checkedUser']);
                    }else{
                        $checkedUsers = 'no';
                    }
                    
                    if( ($_POST['content']) != ''  ){
                        if(isset($_SESSION['imageCount'])){
                            $_SESSION['imageCount'] = 0;
                        }
                        #removing and deleting images 

                        $countOfDocument = Document::getCountOfAllDocument();

                        foreach($allImages as $index => $image){
                        copy($_SERVER['DOCUMENT_ROOT']."/uploades/img/tmp/$image" , $_SERVER['DOCUMENT_ROOT']."/uploades/img/docs/doc_{$countOfDocument}_{$index}.png");
                        }

                        foreach($allImages as $image){
                            unlink($_SERVER['DOCUMENT_ROOT']."/uploades/img/tmp/$image");
                        }

                        #adding document to database

                        $content = $_POST['content'];
                        
                        print_r(User::setBrowsedAddDocument($checkedUsers));
                        Document::addNewDocument(count($allImages), $content, 'chief_of_English_department' , $checkedUsers);
                        
                        
                        
                        $_SESSION['success']=true;
                      header('Location: /admin/adminis');
                }else{
                    $_SESSION['empty_field']=true;
                    foreach($allImages as $image){
                        unlink($_SERVER['DOCUMENT_ROOT']."/uploades/img/tmp/$image");
                    }
                }
                
            }
            else{
                if(!isset($_FILES['uploads']['tmp_name'])){
                    
                    $allImages = scandir($_SERVER['DOCUMENT_ROOT'].'/uploades/img/tmp');

                    array_shift($allImages);
                    array_shift($allImages);

                    if(count($allImages) > 0){
                        foreach($allImages as $image){
                            unlink($_SERVER['DOCUMENT_ROOT']."/uploades/img/tmp/{$image}");
                        }
                    }
                }  
            }
            
            require_once(ROOT.'/views/admin/ad_add.php');
        }else{
            header('Location: /');
        }
    }
    
    public function actionAddAnnounce(){
        if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
            $adminInfo = Admin::getInfoAboutAdmin();
            $doc_ann = 'ann';
            $send = false ;
            $noUserName = false;
            $newMessage = User::getNewMessage();
            
            if(isset($_POST['name']) and !empty($_POST['name']) and !empty($_POST['content'])){
                $author = $_POST['name'];
                $content = $_POST['content'];
                
                
                
                if($author == 'chif_of_drill_departure'){
                    Announce::addNewAnnounce($author, $content);
                    $send = true;
                }else{
                    $noUserName = true;
                }          
            }
            
            require_once(ROOT.'/views/admin/add_ann.php');
        }else{
            header("Location: /");
        }
    }
    
    public function actionChangeDocument(){
        if(isset($_SESSION['success'])){
               $_SESSION['success'] = false;
           }
        
           if(User::checkLogging()){
               $btn_user = 'ch';
               $allDocumentInfo = Document::getAllDocumentInfo();
               
               require_once(ROOT.'/views/admin/ad_ch.php');
           }else{
               header('Location: /');
           }
    }
    
    public function actionChangeDocument2(){
        if(isset($_SESSION['success'])){
               $_SESSION['success'] = false;
           }
        
        if(User::checkLogging()){
            $btn_user = 'ch';
            $_SESSION['is_changed'] = false;
            $error = false;
            
            if( isset($_SESSION['ch_id']) and !empty($_SESSION['ch_id'])){
                if(isset($_POST['doc-submit']) ){
                    $error = 'name';
                    $allUsersNames = User::getAllNamesUsers();
                   
                    if(in_array($_POST['author'], $allUsersNames)){
                        $error = false;
                    }
                    
                    if($_POST['doc-content'] == ''){
                        $error = 'content';
                    }
                    
                    if($_POST['doc-date'] == ''){
                        $error = 'date' ;
                    }

                    if($error == false){
                        Document::changeDocumentById($_SESSION['ch_id'], $_POST['doc-date'], $_POST['author'], $_POST['doc-content']);
                        $_SESSION['is_changed'] = true;
                        header('Location: /admin/ch_doc');
                    }
            }}
            $documentInfo = Document::getInfoById($_SESSION['ch_id']);
            
            require_once(ROOT.'/views/admin/ad_ch_2.php');
            }else{
            header('Location: /');
        }
    }
    
    public function actionChangeDocument3(){
        if(isset($_SESSION['success'])){
               $_SESSION['success'] = false;
        }
      
        $_SESSION['ch_id'] = $_POST['idDoc'];
    }
    
    public function actionDeleteDocument(){
        if(isset($_SESSION['success'])){
               $_SESSION['success'] = false;
           }
        if(User::checkLogging()){
            $btn_user = 'del';
            $deleteAnn = false ;
            $deleteDoc = false ;
            
            
            
            if(isset($_SESSION['ad'])){
                Announce::deleteAnnounceById($_SESSION['ad']);
                unset($_SESSION['ad']);
                $deleteAnn = true ; 
            }
            
            if(isset($_SESSION['dd'])){
                User::setBrowsedDeleteDocument($_SESSION['dd']);
                Document::deleteDocumentById($_SESSION['dd']);
                unset($_SESSION['dd']);
                $deleteDoc = true ;
            }
            
            
            
            $allDocumentInfo = Document::getAllDocumentInfo();
            $allAnnounceInfo = Announce::getAllAnnounceInfo();
            
            require_once(ROOT.'/views/admin/ad_del.php');
        }else{
            header('Location: /');
        }
    }
    
    public function actionUpload(){
        $typesOfImage = ['image/jpeg' , 'image/png' , 'image/bmp' , 'image/jpg'];
        
       if(isset($_FILES['uploads']['tmp_name']) and !empty($_FILES['uploads'])){
           
           if($_FILES['uploads']['size'] != 0  and in_array($_FILES['uploads']['type'] , $typesOfImage)){
              
               if(is_uploaded_file($_FILES['uploads']['tmp_name'])){
                   
                   if(isset($_SESSION['imageCount'])){
                       $_SESSION['imageCount'] = (int)$_SESSION['imageCount'] + 1 ;
                       $imageCount = (int)$_SESSION['imageCount'];
                   }else{
                       $_SESSION['imageCount'] = 0;
                       $imageCount = $_SESSION['imageCount'] ; 
                   }
                    
                   move_uploaded_file($_FILES['uploads']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/uploades/img/tmp/doc_'.$imageCount.'.jpg');
                    
                   $allFiles = scandir($_SERVER['DOCUMENT_ROOT'].'/uploades/img/tmp');
                   $countOfFile = count($allFiles) - 2 ;
                   
                   if($countOfFile > 1){
                       
                       $arrayOfImages = [];
                       
                       foreach($allFiles as $image){ 
                           if($image != '.' and $image != '..'){
                             array_push($arrayOfImages,'/uploades/img/tmp'.$image);  
                           }
                       }
                       
                       $arrayOfImages = json_encode($arrayOfImages);
                       
                       echo $arrayOfImages;
                   }else{
                       echo '/uploades/img/tmp/doc_'.$imageCount.'.jpg';
                   }
               }
               
           }
       }
    }
    
    public function actionCheckedUsers(){
        if(isset($_POST['checkedUser'])){
            $_SESSION['checkedUser'] = $_POST['checkedUser'];
        }
    }
    
    public function actionDeleteImage(){
        $deleteImage = $_POST['deleteImage'];
        
        $allImages = scandir($_SERVER['DOCUMENT_ROOT'].'/uploades/img/tmp');
        array_shift($allImages);
        array_shift($allImages);
        
        if(count($allImages) == 0){
            header('Location: /');
        }else{
            $deleteImage = $_SERVER['DOCUMENT_ROOT'].'/uploades/img/tmp/'.$allImages[$deleteImage];
            unlink($deleteImage);
            
            $eachImages = scandir($_SERVER['DOCUMENT_ROOT'].'/uploades/img/tmp');
            array_shift($eachImages);
            array_shift($eachImages);
            $newImages = [];
            
            if(count($eachImages) == 0){
                echo '/uploades/img/docs/dow_img.svg';
            }else{
                
                foreach ($eachImages as $image){
                    array_push($newImages , '/uploades/img/tmp/'.$image);
                };
                
                echo json_encode($newImages);
            }
        }
    }
    
    public function actionDeleteDocument1(){
        
        if(isset($_POST['docDel']) and !empty($_POST['docDel'])){
            $_SESSION['dd'] = $_POST['docDel'];
            
            $allUserInfo = User::getAllUserInfo1();
            $allDocumentInfo = Document::getAllDocumentInfo();
            
            #this user and document 
            $thisDocument = Document::getInfoById($_SESSION['dd']);
            
            $documentCount = 0 ;
            for($i = 0 ; $i < count($allDocumentInfo) ;$i++  ){
                if($allDocumentInfo[$i]['id'] == $_SESSION['dd']){
                    $documentCount = $i ; 
                }
            }
            
            $db = Db::getConnection();
            
            foreach($allUserInfo as $user){
                if( (int)explode(',' , $user['browsed'])[$documentCount] == 0 ){
                    $sql = "update users set new = new - 1 where id = {$user['id']} ";
                    $db->query($sql);
                    echo $user['identef'];
                }
            }
            
        }
        
        if(isset($_POST['annDel']) and !empty($_POST['annDel'])){
            $_SESSION['ad'] = $_POST['annDel'];
        }
        
    }
    
    public function actionBrowsed(){
        
        if(isset($_POST['browsedCount'])){
            $db = Db::getConnection();
            $idBr = $_POST['browsedCount'];
            $allDocumentInfo = Document::getAllDocumentInfo();
            $user = User::getUserById($_SESSION['id']);
            
            #delete 1 from new 
            
            User::subOneFromNew($_SESSION['id'], '-');
            
            #get users browsed
            
            $user['browsed'] = explode(',',$user['browsed']);
            
            $count = 0;
            for($i = 0 ; $i < count($allDocumentInfo) ; $i++){
                if($allDocumentInfo[$i]['id'] == $idBr ){
                    $count = $i;
                    break;
                }
            }
            
            $user['browsed'][$count] = 1;
            
            $user['browsed'] = implode(',' , $user['browsed']);
            $id = $db->real_escape_string($_SESSION['id']);
            
            $browsed = $db->real_escape_string($user['browsed']);
            $sql = "update users set browsed = '$browsed' where id = $id ";
            
            $db->query($sql);
            
            #get document browsed
            
            $document = false ;
            for($i = 0 ; $i < count($allDocumentInfo) ; $i++){
                if($allDocumentInfo[$i]['id']  == $idBr ){
                    $document = $allDocumentInfo[$i];
                }
            }
            
            $allUserInfo = User::getAllUserInfo1();
            $count = 0;
            
            for($i =  0; $i < count($allUserInfo) ; $i++){
                if($allUserInfo[$i]['id'] == $_SESSION['id']){
                    $count = $i;
                }
            }   
            
            $document['browsed'] = json_decode($document['browsed']);
            
            $document['browsed'][$count] = 1;
            
            $document['browsed'] = json_encode($document['browsed']);
            $document = $db->real_escape_string(trim($document['browsed']));
            
            $sql = "update docs set browsed = '$document' where id = $idBr  ";
            
            $db->query($sql);
            $db->close();
            
            
            echo $idBr ;
        }else{
            echo 'false';
        }
    }
}

