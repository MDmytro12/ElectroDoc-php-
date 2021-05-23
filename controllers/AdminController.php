<?php

class AdminController{
    public function actionCabinet(){
        
       if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
           $adminInfo = Admin::getInfoAboutAdmin();
           $documentInfo = Document::getAllDocumentInfo();
           $announceInfo = Announce::getAllAnnounceInfo();
           $doc_ann = 'doc';
           
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
            
            require_once(ROOT.'/views/admin/ad_ch_2.php');
        }else{
            header('Location: /');
        }
    }
    
    public function actionDeleteDocument(){
        if(isset($_SESSION['success'])){
               $_SESSION['success'] = false;
           }
        echo 'Delete document!';
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
    
}

