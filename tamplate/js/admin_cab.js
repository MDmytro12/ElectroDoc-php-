$(document).ready(function () {
    $(document).scroll(function () {
        let allDocs = $('.iframe');
        
        if(allDocs.length >= 1){
            let hotPoints = [];
            let stop = false;
            
            allDocs.each(function () {
                hotPoints.push(parseInt($(this).offset()['top']+$(this).height()/2));
            });
            
            if(hotPoints.length == 1){
                hotPoints[hotPoints.length-1] = hotPoints[hotPoints.length-1] - 700;
            }else{
                hotPoints[hotPoints.length-1] = hotPoints[hotPoints.length-1] - 200;
            }
            
            
            for(let i =0 ; i < hotPoints.length ; i++){
                if( $(document).scrollTop() > hotPoints[i] ){
                      $('.iframe').each(function (index) {
                          let id = $(this).attr('id');
                          ajaxRequest(id);
                          $('#'+id+' #'+id).removeClass('iframe');
                          console.log($('#'+id+' #'+id).attr('class'));
                          return false;
                        });
                }
                break;
            };
            
        }
        
    });
});
function ajaxRequest(id , i){
    let form = new FormData() ;
    form.append('browsedCount',id);
    
    $.ajax({
        url: 'br',
        type: 'POST',
        data: form ,
        processData: false,
        cache: false,
        contentType: false,
        success: function (res) {
            if(res != 'false'){
                $('#'+res+' .br').removeClass('active');
                $('#'+res+' .br1').addClass('active');
                console.log($('#'+res+'  .br'));
                let count = parseInt($('.count-mesage').text().slice(2));
                count = count -1;
                if(count == 0){
                    $('.count-mesage').html(count);
                }else{
                    $('.count-mesage').html('+ '+count);
                }
            }
        }
    })
}
// scrollHieght height hieght of all page 