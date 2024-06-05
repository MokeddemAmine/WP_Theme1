<?php $all_cats = get_the_category(); ?>

<nav class="bg-white py-2 my-3" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
                <a href="<?php echo get_home_url() ?>" class="text-capitalize text-warning fw-bold">
                    <?php echo get_bloginfo('name') ?>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo esc_url(get_category_link($all_cats[0]->term_id)) ?>" class="text-capitalize text-warning fw-bold">
                    <?php echo esc_html($all_cats[0]->name); ?>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo get_the_title(); ?>
            </li>
        </ol>
    </div>
</nav>