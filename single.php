<?php get_header() ?>
    <div class="container my-4 mb-6">
            <?php 
                if(have_posts()){
                    while(have_posts()){
                        the_post();
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
                            <div class="post-content my-2 text-dark">
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
                    <?php
                    }
                }
            ?>
            <?php comments_template(); ?>
        </div>
<?php get_footer(); ?>