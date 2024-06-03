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
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg bg-warning text-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"       data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php mine_bootstrap_menu() ?>
            </div>
        </div>
    </nav>