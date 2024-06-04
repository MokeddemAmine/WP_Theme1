<?php get_header() ?>
    <div class="container my-4 mb-6">
            <?php 
                if(have_posts()){
                    while(have_posts()){
                        the_post();
                        $current = get_the_title();
                    ?>
                        <div class="main-post bg-white p-3 rounded mb-3">
                            <?php 
                                $current_user = wp_get_current_user();

                                if ( in_array( 'administrator', (array) $current_user->roles ) || in_array( 'author', (array) $current_user->roles ) || in_array( 'editor', (array) $current_user->roles ) ) {?>
                                    <div class="text-end">
                                        <?php edit_post_link('edit','','',0,'py-1 px-2 rounded bg-secondary text-capitalize text-white') ?>
                                    </div>
                               <?php } 
                            ?>
                            
                            <h3 class="post-title m-0 mb-2 text-secondary">
                                <a href="<?php the_permalink() ?>" reel="bookmark" title="Link to <?php the_title_attribute() ?>" class="text-capitalize">
                                    <?php the_title() ?>
                                </a>
                            </h3>
                            <div class="mb-2">
                                <span class="post-author">
                                    <i class="fa-regular fa-user"></i>
                                    <?php the_author_posts_link() ?>
                                </span>
                                <span class="post-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    <?php the_time('j F,Y') ?>
                                </span>
                                <span class="post-comment">
                                    <i class="fa-regular fa-comments"></i>
                                    <?php comments_popup_link(); ?>
                                </span>
                            </div>
                            <div class="post-single-image">
                                <?php the_post_thumbnail('',['class' => 'img-responsive img-thumbnail']) ?>
                            </div>
                            <div class="post-single-content my-2 text-dark">
                                <?php the_content(); ?>
                            </div>
                            <div class="post-categories">
                                <span class="fw-bold"><i class="fa-solid fa-layer-group"></i> Cats:</span> <?php the_category(' | ') ?>
                            </div>
                            <div class="post-tags my-2">
                                <?php if(has_tag()){
                                    the_tags('<h6 class="text-uppercase"><i class="fa-solid fa-tags"></i> <span class="text-capitalize">tags</span>: ',' | ','</h6>');
                                }else{
                                    echo '<h6><i class="fa-solid fa-tags"></i>Tags : _</h6>';
                                } ?>
                            </div>
                        </div>
                        <div class="post-pagination one-post-pagination d-flex justify-content-between">
                            <?php 
                                if(get_previous_post_link()){
                                    previous_post_link('%link','<i class="fa-solid fa-chevron-left"></i> %title');
                                }else{
                                    echo '<span><i class="fa-solid fa-chevron-left"></i> Prev</span>';
                                }

                                if(get_next_post_link()){
                                    next_post_link('%link','%title <i class="fa-solid fa-chevron-right"></i>');
                                }else{
                                    echo '<span>Next <i class="fa-solid fa-chevron-right"></i></span>';
                                }
                            ?>
                        </div>
                        <hr style="border:2px dashed rgba(255,193,7)" class="my-3">
                        <?php 
                            $args_random_posts = array(
                                'posts_per_page'        => 4,
                                'orderby'               => 'rand',
                                'category__in'          => wp_get_post_categories(get_queried_object_id()),
                                'post__not_in'          => array(get_queried_object_id()),
                            );
                            $random_posts = new WP_Query($args_random_posts);
                            if($random_posts->have_posts()){?>
                                <div class="post-random text-center bg-white p-3 rounded my-3">
                                    <h4 class="text-capitalize">posts related with <?php echo $current; ?></h4>
                                    <div class="row">
                                    <?php
                                    while($random_posts->have_posts()){
                                        $random_posts->the_post();?>
                                        <div class="col-3 p-1">
                                            <div class="bg-light p-1">
                                                <h3 class="post-title">
                                                    <a href="<?php the_permalink() ?>">
                                                        <h4 class="mb-2">
                                                            <?php the_title(); ?>
                                                        </h4>
                                                        <div class="post-single-image">
                                                            <?php the_post_thumbnail('',['class' => 'img-responsive img-thumbnail']) ?>
                                                        </div>
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                    <?php } 
                                    ?>
                                    </div>
                                </div>
                            <?php
                            wp_reset_postdata();
                            }
                        ?>
                        <hr style="border:2px dashed rgba(255,193,7)" class="my-3">
                        <div class="author-post bg-white p-2 rounded">
                            <div class="row align-items-center">
                            <div class="col-md-2">
                                <?php 
                                    $args_avatar = array(
                                        'class' => 'img-responsive img-thumbnail'
                                    );
                                    echo get_avatar(get_the_author_meta('ID'),128,'','user avatar of '.get_the_author_meta('nickname'),$args_avatar)
                                ?>
                            </div>
                            <div class="col-md-10">
                                <h6>
                                    <span class="text-capitalize">
                                        <?php the_author_meta('first_name'); ?>
                                        <?php the_author_meta('last_name'); ?>
                                    </span>
                                    <span class="text-uppercase">
                                        <?php the_author_meta('nickname') ?>
                                    </span>
                                </h6>
                                <?php
                                    if(the_author_meta('description')){?>
                                        <p>
                                            <?php the_author_meta('description'); ?>
                                        </p>
                                    <?php }
                                ?>
                            </div>
                            <div class="d-flex align-items-center mt-3 gap-2">
                                <div>
                                    <?php the_author_posts_link() ?>
                                </div>
                                <h6 class="m-0">
                                    <span class="text-capitalize">
                                        user posts count : 
                                    </span>
                                    <span class="text-danger">
                                        <?php echo count_user_posts(get_the_author_meta('ID')); ?>
                                    </span>
                                </h6>
                            </div>
                            </div>
                        </div>
                        <hr style="border:2px dashed rgba(255,193,7)" class="my-3">
                    <?php
                    }
                    wp_reset_postdata();
                }
            ?>
            <?php comments_template(); ?>
        </div>
<?php get_footer(); ?>