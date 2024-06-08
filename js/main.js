jQuery(document).ready(function($){
    // replace the reply comment form under the comment related
    if($('#reply-title')){
        let parent = $('#respond #reply-title a').attr('href');
        $(parent).after($('#respond'))
    }

    // custom ajax form
    $('#success-message').hide();
    $('#enquiry').submit(function(e){
        e.preventDefault();

        var form        = $('#enquiry').serialize();
        var formdata    = new FormData;
        
        formdata.append('action','enquiry');
        formdata.append('nonce',ajax_nonce);
        formdata.append('enquiry',form);

        $.ajax({
            type:'POST',
            data:formdata,
            url:endpoint,
            processData:false,
            contentType:false,
            success:function(data){
                $('#enquiry').hide(250);
                $('#success-message').show(250).text('Thanks for your message');
            },
            error:function(err){
                console.log(err.responseJSON);
            }
        })
    })
})