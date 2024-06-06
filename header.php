<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <title>
        <?php wp_title('|',true,'right'); ?>
        <?php bloginfo('name'); ?>
    </title>

    <?php wp_head(); ?>
    <style type="text/css">
        /* Primary Color */
        body {
            background-color: <?php echo get_theme_mod( 'body_color', '#adb5bd' ); ?>;
        }
        nav{
            background-color: <?php echo get_theme_mod( 'navbar_color', '#ffc107' ); ?>;
        }
        .main-post{
            background-color: <?php echo get_theme_mod( 'posts_color', '#ffffff' ); ?>;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg text-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="search-form flex-grow-1 d-flex justify-content-center">
                    <?php get_search_form(); ?>
                </div>
                <?php mine_bootstrap_menu() ?>
            </div>
        </div>
    </nav>