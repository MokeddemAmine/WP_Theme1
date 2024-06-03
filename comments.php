<?php
    if(comments_open()){
        // echo '<h3 class="my-3 bg-light p-2 rounded">';
        //     comments_number();
        // echo '</h3>';
        // add new comment or reply to a comment
        $args_form = array(
            'title_reply'   =>'Comment Here',
            'logged_in_as'  => false,
            'comment_field' => '
                <div class="form-group">
                    <textarea class="form-control" name="comment" placeholder="Your Comment Here"></textarea>
                </div>
            ',
            'class_submit'     => 'btn btn-warning btn-sm my-3',
            // 'title_reply_before'=> '<h3 id="reply-title" class="comment-reply-title bg-light p-2">',
            // 'title_reply_after' => '</h3>',
        );
        comment_form($args_form);
        // show the comments commented
        echo '<ul class="list-unstyled comments-list">';
            $args_comments = array(
                'max_depth'         => 3,
                'type'              => 'comment',
                'avatar_size'       => 40,
                'reverse_top_level' => true,
            );
            wp_list_comments($args_comments);
        echo '</ul>';
        
    }else{
        echo '<div class="bg-white p-1 rounded">Comments Disable</div>';
    }
?>