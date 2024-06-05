<?php get_header() ?>
    <div class="container my-3">
        <div class="bg-white p-3">
            <h1 class="cat-title text-warning fw-bold text-center fs-2">
                <?php single_cat_title(); ?>
            </h1>
            <div class="cat-description bg-light my-3 text-center">
                <?php echo category_description() ?>
            </div>
            <div class="cat-counts text-center my-3 text-capitalize">
                <span class="fw-bold">article count:</span> 
                20 
                | 
                <span class="fw-bold">comments count:</span> 
                118
            </div>
            <div class="row">
                <?php 
                    
                    if(have_posts()){
                        while(have_posts()){
                            the_post();
                        ?>
                        <div class="col-lg-6">
                            <div class="main-post bg-light p-3 rounded mb-3">
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
                                <div class="post-image">
                                    <?php the_post_thumbnail('',['class' => 'img-responsive img-thumbnail']) ?>
                                </div>
                                <div class="post-content my-2 text-dark">
                                    <?php the_excerpt() ?>
                                </div>
                                <!-- <div class="post-categories">
                                    <span class="fw-bold"><i class="fa-solid fa-layer-group"></i> Cats:</span> <?php the_category(' | ') ?>
                                </div> -->
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
                        }
                        wp_reset_postdata();
                    }
                ?>
                <div class="post-pagination-wp d-flex justify-content-center">
                    <div class="d-flex rounded bg-white border border-primary">
                        <?php echo numbering_pagination() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>