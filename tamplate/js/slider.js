$(document).ready(function () {
    $('.arrow-btn').on('click' , function () {
        let parentId = $(this).parent().attr('id');
        let classNames = $(this).attr('class').split(' ');
        let allImages = $('#'+parentId+' .image-items');
        let lastId = parseInt(allImages.last().attr('id'))+1;
        let allLabels = $('#'+parentId+' .img-item');
        
        
        if(classNames[0] == 'arrow-left'){
            let currentId = 0 ;
            
            allImages.each(function (item) {
                if($(this).attr('class').split(' ').length == 2 ){
                    currentId = parseInt($(this).attr('id'));
                    $(this).removeClass('active');
                }
            });
            
            allLabels.each(function (item) {
                $(this).removeClass('active');
            });
            
            let nextPosition = 0;
            
            if(currentId > 0){
                nextPosition = currentId - 1 ;
            }
            
            if(currentId == 0 ){
                nextPosition = lastId - 1 ;
            }
            
            allImages.each(function (item) {
                if(parseInt($(this).attr('id')) == nextPosition){
                    $(this).addClass('active');
                }
            });
            allLabels.each(function (item) {
                if(parseInt($(this).attr('id')) == nextPosition){
                    $(this).addClass('active');
                }
            });
        };
        if(classNames[0] == 'arrow-right'){
            let currentId = 0 ;
            let nextPosition = 0;
            
            allImages.each(function (item) {
                if($(this).attr('class').split(' ').length == 2 ){
                    currentId = parseInt($(this).attr('id'));
                    $(this).removeClass('active');
                }
            });
            
            allLabels.each(function (item) {
                $(this).removeClass('active');
            });
            
            if(currentId < lastId){
                nextPosition = currentId + 1 ;
            }
            
            if(currentId == lastId - 1 ){
                nextPosition = 0 ;
            }
            
            allImages.each(function (item) {
                if(parseInt($(this).attr('id')) == nextPosition){
                    console.log($(this).attr('id'));
                    $(this).addClass('active');
                }
            });
            
            allLabels.each(function (item) {
                if(parseInt($(this).attr('id')) == nextPosition){
                    $(this).addClass('active');
                }
            });
        };
        
    });
    
    $('.img-item').on('click' , function () {
        let currentId = parseInt($(this).attr('id'));
        let allImages = $('.image-items');
        let allLabels = $('.img-item');
        
        allImages.each(function (item) {
            $(this).removeClass('active');
        });
        allLabels.each(function (item) {
            $(this).removeClass('active');
        });
        
        allImages.each(function (item) {
            if(currentId == parseInt($(this).attr('id'))){
                $(this).addClass('active');
            }
        });
        allLabels.each(function (item) {
            if(currentId == parseInt($(this).attr('id'))){
                $(this).addClass('active');
            }
        });
        
    });
});

