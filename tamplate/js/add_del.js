$(document).ready(function () {
    $('.del-doc').on('click' , function () {
        let idDoc = $(this).attr('id');
        
        ajaxRequest('docDel' , idDoc );
    });
    
    $('.del-ann').on('click' , function () {
        let id = $(this).attr('id');
        
        ajaxRequest('annDel' , id );
    });
});

function ajaxRequest( paraName , data){
    
    let form = new FormData();
    form.append(paraName , data);
    
    $.ajax({
        url: 'del_doc1',
        type: 'POST',
        data: form ,
        processData: false,
        cache: false,
        contentType: false,
    });}
