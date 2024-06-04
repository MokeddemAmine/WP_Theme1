<?php get_header() ?>
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
                            <?php echo count_user_posts(get_the_author_meta('ID')); ?>
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
                                echo get_comments($args_comments_count);
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
        </div>
    </div>
<?php get_footer() ?>