<?php get_header() ?>
    <div class="container my-3 bg-white rounded py-3">
        <h1 class="text-warning text-center my-3"><?php the_title(); ?></h1>
        <div class="row my-3">
            <div class="col-lg-9 content">
                <div class="bg-light h-100 rounded p-2">
                    <?php the_content() ?>
                </div>
            </div>
            <div class="col-lg-3 sidebar">
                <?php 
                    if(is_active_sidebar('main-sidebar')){
                        dynamic_sidebar('main-sidebar');
                    }
                ?>
            </div>
        </div>
    </div>
<?php get_footer() ?>