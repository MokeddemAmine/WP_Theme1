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
                            <div class="post-single-content my-3 text-dark">
                                <?php the_content(); ?>
                            </div>
                            <div class="post-details">
                                <h3 class="text-warning fw-bold text-capitalize">details :</h3>
                                <div class="row">
                                    <div class="col-lg-6 ps-5">
                                        <div class="row">
                                            <h4 class="col-6 text-capitalize">color :</h4>
                                            <p class="col-6"><?php echo get_post_meta($post->ID,'color',true); ?></p>
                                        </div>
                                        <div class="row">
                                            <h4 class="col-6 text-capitalize">registration :</h4>
                                            <p class="col-6"><?php echo get_post_meta($post->ID,'registration',true); ?></p>
                                        </div>
                                        <div class="row">
                                            <h4 class="col-6 text-capitalize">price :</h4>
                                            <p class="col-6"><?php echo '$'.get_post_meta($post->ID,'price',true); ?></p>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="bg-white p-3 rounded my-3">
                            <?php get_template_part('includes/form','enquiry'); ?>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                }
            ?>
        </div>
<?php get_footer(); ?>