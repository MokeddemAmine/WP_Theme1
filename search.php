<?php get_header(); ?>
    <div class="container my-3 p-3 bg-white rounded">
        <h1 class="text-center my-3">search for '<?php echo get_search_query(); ?>'</h1>
        <div class="row">
            <?php get_template_part('includes/section','searchresults') ?>
        </div>
    </div>
<?php get_footer(); ?>