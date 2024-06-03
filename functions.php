<?php

    // include navwalker to fix bootstrap menu
    require_once('wp-bootstrap-navwalker.php');

    // add style files
    function add_styles(){
        // add fontAwsome icon from google
        wp_register_style('fontAwsome',get_template_directory_uri().'/css/all.min.css');
        wp_enqueue_style('fontAwsome');
        // add boostrap style
        wp_register_style('bootstrap',get_template_directory_uri().'/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap');
        // add main style
        wp_register_style('main-css',get_template_directory_uri().'/css/main.css');
        wp_enqueue_style('main-css');
    }

    add_action('wp_enqueue_scripts','add_styles');

    // add script files

    function add_scripts(){
        // add jqueey from WP include directory
        wp_deregister_script('jquery');
        wp_register_script('jquery',includes_url('/js/jquery/jquery.js'),array(),false,true);
        wp_enqueue_script('jquery');
        // add popper
        wp_register_script('popper',get_template_directory_uri().'/js/popper.min.js',array(),false,true);
        wp_enqueue_script('popper');
        // add bootstrap script
        wp_register_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),false,true);
        wp_enqueue_script('bootstrap-js');
        // add main script
        wp_register_script('main-js',get_template_directory_uri().'/js/main.js',array(),false,true);
        wp_enqueue_script('main-js');
    }

    add_action('wp_enqueue_scripts','add_scripts');

    // add menus to the theme

    function mine_register_menu(){
        register_nav_menu('bootstrap-menu',__('Navigation Bar'));
    }
    add_action('init','mine_register_menu');

    function mine_bootstrap_menu(){
        wp_nav_menu(array(
            'theme_location'        => 'bootstrap-menu',
            'menu_class'            => 'navbar-nav me-auto mb-2 mb-lg-0',
            'container'             => false,
            'depth'                 => 2,
            'walker'                => new WP_Bootstrap_Navwalker(),
        ));
    }