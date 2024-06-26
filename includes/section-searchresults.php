<?php 
                if(have_posts()){
                    while(have_posts()){
                        the_post();
                    ?>
                    <div class="col-lg-6 col-xxl-4">
                        <div class="main-post p-3 rounded mb-3">
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
                            <div class="post-image d-flex justify-content-center">
                                <!-- <?php the_post_thumbnail('',['class' => 'img-responsive img-thumbnail']) ?> -->
                                <?php if(has_post_thumbnail()){ ?>
                                    <img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>" class="img-responsive img-thumbnail">
                                <?php }
                                ?>
                            </div>
                            <div class="post-content my-2 text-dark">
                                <?php the_excerpt() ?>
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
                    </div>
                    <?php
                    }?>

                    <div class="post-pagination post-pagination-search my-2 d-flex justify-content-center gap-2">
                        <?php 
                            if(get_previous_posts_link()){
                                previous_posts_link('<i class="fa-solid fa-chevron-left"></i> Prev');
                            }else{
                                echo '<span>Prev</span>';
                            }

                            if(get_next_posts_link()){
                                next_posts_link('Next <i class="fa-solid fa-chevron-right"></i>');
                            }else{
                                echo '<span>Next</span>';
                            }
                        ?>
                    </div>
               <?php }else{
                 echo '<div class="alert alert-light my-3">
                            There are no results for your search query';
                            echo get_search_query();
                 echo '</div>';
               }
            ?>