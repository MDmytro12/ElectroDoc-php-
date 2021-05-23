$(document).ready(function () {
    $('.edit').on('click' , function () {
        let form = new FormData();
        let id = $(this).attr('id');
        
        form.append('idDoc' , id);
        
        $.ajax({
            url: 'ch_doc3',
            type: 'post',
            data: form,
            processData: false ,
            cache: false ,
            contentType : false,
            success: function (response) {
                console.log(response);
            }
        });
    });
});


