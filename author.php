<?php get_header() ?>
    <?php $user_posts = count_user_posts(get_the_author_meta('ID')); ?>
    <div class="container">
        <div class="bg-white my-3 p-3 rounded">
            <div class="row align-items-center">
                <div class="col-3">
                    <?php 
                        $avatar_args = array(
                            'class'     => 'img-responsive img-thumbnail rounded-circle'
                        );
                        echo get_avatar(get_the_author_meta('ID'),128,'','user avatar of '.get_the_author_meta('nickname'),$avatar_args)
                    ?>
                </div>
                <div class="col-9">
                    <h4>
                        <?php the_author_meta('first_name') ?>
                        <?php the_author_meta('last_name'); ?>
                    </h4>
                    <span class="text-secondary">
                        (<?php the_author_meta('nickname'); ?>)
                    </span>
                </div>
            </div>
            <?php if(get_the_author_meta('description')){ ?>
                <p class="text-center my-3 bg-light p-2">
                    <span class="fw-bold">Bio:</span> 
                    <?php the_author_meta('description'); ?>
                </p>
            <?php } ?>
            <div class="row mt-5 mb-3">
                <div class="col-md-6 col-lg-3">
                    <div class="bg-warning rounded p-3 text-center text-capitalize">
                        <span class="text-white fw-bold fs-4">
                            posts count
                        </span>
                        <p class="text-info fs-1 m-0">
                            <?php echo $user_posts; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-warning rounded p-3 text-center text-capitalize">
                        <span class="text-white fw-bold fs-4">
                            comments count 
                        </span>
                        <p class="text-info fs-1 m-0">
                            <?php 
                                $args_comments_count = array(
                                    'user_id'       => get_the_author_meta('ID'),
                                    'count'         => true,
                                );
                                $user_comments = get_comments($args_comments_count);
                                echo $user_comments;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-warning rounded p-3 text-center text-capitalize">
                        <span class="text-white fw-bold fs-4">
                            posts view
                        </span>
                        <p class="text-info fs-1 m-0">
                            0
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-warning rounded p-3 text-center text-capitalize">
                        <span class="text-white fw-bold fs-4">
                            other option
                        </span>
                        <p class="text-info fs-1 m-0">
                            0
                        </p>
                    </div>
                </div>
            </div>
            <h4 class="bg-light text-capitalize p-2">
                <?php $latest_posts = 4; ?>
                <?php if($latest_posts > $user_posts){
                    echo 'all posts from ';
                    the_author_meta('first_name');
                }else{ ?>
                    latest <?php echo $latest_posts ?> posts from <?php the_author_meta('first_name');?> 
                <?php } ?>
                
            </h4>
                <?php 
                    $args_query = array(
                        'author'        => get_the_author_meta('ID'),
                        'posts_per_page'=> $latest_posts,
                    );

                    $query = new WP_Query($args_query);
                    if($query->have_posts()){
                        while($query->have_posts()){
                            $query->the_post();?>
                                <div class="row align-items-center bg-light p-2 m-2">
                                    <div class="col-lg-3">
                                        <?php the_post_thumbnail('',['class' => 'img-responsive img-thumbanail w-200 h-200']); ?>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="main-post p-3 rounded">
                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>" reel="bookmark" title="Link to <?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="mb-2">
                                                <span class="post-date">
                                                    <i class="fa-regular fa-calendar"></i>
                                                    <?php the_time('j F,Y') ?>
                                                </span>
                                                <span class="post-comment">
                                                    <i class="fa-regular fa-comments"></i>
                                                    <?php comments_popup_link(); ?>
                                                </span>
                                            </div>
                                            <div class="post-content-latest">
                                                <?php the_excerpt() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                        wp_reset_postdata();    
                    }else{
                        echo 'There are no posts';
                    }
                ?>
                <?php
                    $comments_number = 4;
                    $args_comments = array(
                        'user_id'       => get_the_author_meta('ID'),
                        'status'        => 'approve',
                        'number'        => $comments_number,
                        'posts_status'  => 'publish',
                        'post_type'     => 'post',
                    );
                    $comments = get_comments($args_comments);
                    if($comments){ ?>
                        <h4 class="bg-light p-2 my-2 text-capitalize">
                            <?php if($comments_number > $user_comments){ 
                                echo 'all comments'; 
                                }else{
                                    echo 'latest '.$comments_number.' comments';
                                } ?>
                        </h4>
                        <?php foreach($comments as $comment){?>
                            <div class="bg-light p-2 rounded mb-2">
                                <div class="mb-2 rounded d-flex justify-content-between">
                                    <a href="<?php echo get_permalink($comment->comment_post_ID); ?>" class="fs-4">
                                        <?php echo get_the_title($comment->comment_post_ID); ?>
                                    </a>
                                    <div class="mb-3">
                                        <i class="fa-regular fa-calendar"></i>
                                        <?php echo 'added on '.mysql2date('l, F j, Y',$comment->comment_date) ?>
                                    </div>
                                </div>
                                
                                <?php echo $comment->comment_content; ?>
                            </div>
                        <?php } ?>
                    <?php }else{
                        the_author_meta('first_name');
                        echo ' dont have any comments';
                    }
                ?>
        </div>
    </div>
<?php get_footer() ?>