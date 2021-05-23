$(document).ready(
        function () {
            $('.li').on('click' , function () {
                if($(this).attr('name') == 'all'){
                    
                    if($(this).prop('checked') == false){
                        $('.li').prop('checked' , false);
                        $('.li + label').css('color' ,'#000000');
                    }
                    else{
                        $('.li').prop('checked' , true);
                        $('.li + label').css('color' ,'#C05F39');
                    }
                };
                
                let id = $(this).attr('name');
                
                if($(this).prop('checked')){
                    $('#li-'+id+' + label').css('color' ,'#C05F39');
                }else{
                    $('#li-'+id+' + label').css('color' ,'#000000');
                }
            });
            
            $('#down_img').change( function () {
                
                let typeOfImage = ['image/jpeg' , 'image/png','image/jpg'] ;
                
                if(typeof $('#down_img').prop('files')[0] == 'undefined'){
                    return false;
                }
                
                let resultOfCheck = false;
                typeOfImage.forEach((item) => {
                    if(item === $('#down_img').prop('files')[0].type) {
                        resultOfCheck = true;
                    }
                });
                
                if(resultOfCheck == false){
                    return false;
                }
                
                let file = $('#down_img')[0].files;
                let form = new FormData();
                
                form.append('uploads',file[0]);
                
                $.ajax({
                    url : 'down',
                    type : 'post',
                    data : form ,
                    cache : false,
                    processData : false ,
                    contentType : false,
                    success : function (data) {
                        // clear images
                        
                        $('.img-img').detach();
                        $('.wrapper').detach();
                        
                        // add images
                        let parentItem = $('.img1');
                        
                        if(data[0] == '['){
                            let images = JSON.parse(data);
                            let count = 0;
                            
                            Object.values(images).forEach((item) => {
                                
                                parentItem.append($('<div>',{
                                    class: 'wrapper',
                                    id: 'w-'+count,
                                }));
                                
                                $('#w-'+count).append($('<a>',{
                                    class: 'delete',
                                    id: count,
                            //        href: 'del_img/'+count,
                                    html: '&#215'
                                }));
                                
                               $('#w-'+count).append($('<img>' , {
                                    class: 'img-img',
                                    src: item.replace('tmp' , 'tmp/')
                                }));
                                
                                count+=1;
                            });
                        }else{
                            
                            
                            parentItem.append($('<div>',{
                                    class: 'wrapper'
                                }));
                                
                            $('.wrapper').append($('<a>',{
                                class: 'delete',
                                id: 0,
                             //   href: 'del_img/'+0,
                                html: '&#215'
                            }));
                                
                            let childItem = $('.wrapper').last();
                            
                            childItem.append($('<img>',{
                                class: 'img-img',
                                src: data.replace('\/','/').replace('tmp','tmp/')
                            }));
                        }
                    },
                 });
                
            });
            
            $('input[name=submit-del]').on('click' , function () {
                let checkedUsers = $('input:checked');
                let masiveIdentef = [] ;
                
                $('input:checked').each(function (index , value){
                    if($(this).attr('name') != 'all'){
                        masiveIdentef.push($(this).attr('name'));
                    };
                });
                
                let form = new FormData();
                form.append('checkedUser' , JSON.stringify(masiveIdentef));
                
                $.ajax({
                        url: 'ch_user',
                        type: 'post' ,
                        data: form,
                        cache: false,
                        processData: false,
                        contentType: false
                        });
                
            });
           
           $(document).on('click' , '.delete' , function () {
               let numberOfImage = $(this).attr('id');
               
               let form = new FormData();
               form.append('deleteImage' , numberOfImage);
  
               $.ajax({
                   url: 'del_img',
                   type: 'POST',
                   processData: false,
                   cache: false,
                   data: form,
                   contentType: false,
                   success: function (response) {
                       
                       if(response[0] == '['){
                           response = JSON.parse(response);
                           
                           $('.wrapper').detach();
                           
                           let count = 0 ;
                           let parentItem = $('.img1');
                           
                           response.forEach((item) => {
                               parentItem.append($('<div>',{
                                    class: 'wrapper',
                                    id: 'w-'+count,
                                }));
                                
                                $('#w-'+count).append($('<a>',{
                                    class: 'delete',
                                    id: count,
                                    html: '&#215'
                                }));
                                
                               $('#w-'+count).append($('<img>' , {
                                    class: 'img-img',
                                    src: item.replace('tmp' , 'tmp/')
                                }));
                                
                                count+=1;
                           });
                       }else{
                           //deleting
                            $('.wrapper').detach();
                           //adding 
                           $('.img-wrap').append($('<img>' , {
                               class: 'img-img',
                               src: response
                           }));
                       }
                   }
               });
               
           });
        });



                