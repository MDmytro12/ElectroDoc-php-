$("#down_img").change(function (){
    var fileData = $('#down_img').prop('files')[0].name;
    
    var data = {
        nameImage : fileData , 
    };
    
//    $post('admin/adminis',)
    
    console.log($('#down_img').val());
});



