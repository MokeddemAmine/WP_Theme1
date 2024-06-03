jQuery(document).ready(function($){
    // replace the reply comment form under the comment related
    if($('#reply-title')){
        let parent = $('#respond #reply-title a').attr('href');
        $(parent).after($('#respond'))
    }
})