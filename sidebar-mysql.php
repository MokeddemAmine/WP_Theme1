<?php 
    $args_comments = array(
        'status'        => 'approve'
    );
    $comments_count = 0;
    $all_comments = get_comments($args_comments);
    foreach($all_comments as $comment){
        $post_id = $comment->comment_post_ID;
        if(!in_category('mysql',$post_id)){
            continue;
        }
        $comments_count++;
    }

    $cat = get_queried_object();
    $posts_count = $cat->count;
?>

<div class="sidebar-mysql">
    <div class="widget mb-3">
        <h3 class="widget-title bg-warning text-white fw-bold py-2 px-3 m-0 rounded-top text-capitalize fs-4">
            <?php single_cat_title() ?> stats
        </h3>
        <div class="widget-content bg-light text-secondary py-2 px-3 rounded-bottom">
            <div class="row mb-2">
                <div class="col-8 fw-bold text-capitalize">
                    comments counts:
                </div>
                <div class="col-4">
                    <?php echo $comments_count; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-8 fw-bold text-capitalize">
                    posts count:
                </div>
                <div class="col-4">
                    <?php echo $posts_count; ?> 
                </div>
            </div>
        </div>
    </div>
    <div class="widget mb-3">
        <h3 class="widget-title bg-warning text-white fw-bold py-2 px-3 m-0 rounded-top text-capitalize fs-4">
            latest HTML posts
        </h3>
        <div class="widget-content bg-light text-secondary py-2 px-3 rounded-bottom">
            <ul class="list-unstyled">
                <?php 
                    $args_posts = array(
                        'posts_per_page'        => 5,
                        'cat'                   => 2,
                    );
                    $query = new WP_Query($args_posts);
                    if($query->have_posts()){
                        while($query->have_posts()){
                            $query->the_post();
                            ?>
                            <li>
                                <a href="<?php the_permalink() ?>" class="text-secondary fw-bold">
                                    <?php the_title(); ?>
                                </a>
                            </li>
                            <?php
                        }
                        wp_reset_postdata();
                    }else{
                        echo 'There are no posts';
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="widget mb-3">
        <h3 class="widget-title bg-warning text-white fw-bold py-2 px-3 m-0 rounded-top text-capitalize fs-4">
            hot post by comment
        </h3>
        <div class="widget-content bg-light text-secondary py-2 px-3 rounded-bottom">
            <?php 
                $args_hot_post = array(
                    'posts_per_page'    => 1,
                    'orderby'           => 'comment_count',
                );
                $hot_query = new WP_Query($args_hot_post);
                if($hot_query->have_posts()){
                    while($hot_query->have_posts()){
                        $hot_query->the_post();
                        ?>
                        <div class="d-flex justify-content-between">
                            <a href="<?php the_permalink() ?>" class="text-secondary fw-bold">
                                <?php the_title(); ?>
                            </a>
                            <?php comments_popup_link(); ?>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</div>