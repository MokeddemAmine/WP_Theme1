<?php

    // include navwalker to fix bootstrap menu
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once('vendor/autoload.php');

    //Load Composer's autoloader


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

    // add post thumbnail feature to posts
    add_theme_support('post-thumbnails');

    // add the excerpt attributes
    function mine_excerpt_length ($length){
        if(is_author()){
            return 20;
        }else{
            return 10;
        }
    }
    function mine_excerpt_more ($more){
        return 'Read More ...';
    }
    add_filter('excerpt_length','mine_excerpt_length');
    add_filter('excerpt_more','mine_excerpt_more');
    // paginate the index page
    function numbering_pagination(){
        global $wp_query;
        $all_pages = $wp_query->max_num_pages;
        $current_pages = max(1,get_query_var('paged'));

        if($all_pages > 1){
            return paginate_links(array(
                'base'          => get_pagenum_link().'%_%',
                'format'        => 'page/%#%',
                'current'       => $current_pages,
                'prev_text'     => 'Prev',
                'next_text'     => 'Next',
                'mid_size'      => 2,
                'end_size'      => 3,
            ));
        }
    }

    // add colors options to customize the theme

    function my_theme_customizer_assets() {
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_style( 'wp-color-picker' );
    }

    add_action( 'customize_controls_enqueue_scripts', 'my_theme_customizer_assets' );

    function my_theme_customize_register( $wp_customize ) {
        // Add color for body
        $wp_customize->add_setting( 'body_color', array(
            'default' => '#adb5bd', // Default color
            'sanitize_callback' => 'sanitize_hex_color', // Sanitization callback
        ) );
    
        // Add color control body
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_color', array(
            'label' => __( 'Body Color', 'myTheme' ),
            'section' => 'colors',
        ) ) );
        // add color for navbar
        $wp_customize->add_setting( 'navbar_color', array(
            'default' => '#ffc107', // Default color
            'sanitize_callback' => 'sanitize_hex_color', // Sanitization callback
        ) );
    
        // Add color control for navbar
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navbar_color', array(
            'label' => __( 'Nav Color', 'myTheme' ),
            'section' => 'colors',
        ) ) );
        // add color for posts
        $wp_customize->add_setting( 'posts_color', array(
            'default' => '#ffffff', // Default color
            'sanitize_callback' => 'sanitize_hex_color', // Sanitization callback
        ) );
    
        // Add color control for posts
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'posts_color', array(
            'label' => __( 'Posts Color', 'myTheme' ),
            'section' => 'colors',
        ) ) );
    }
    add_action( 'customize_register', 'my_theme_customize_register' );

    // set a number of posts per page in category page
    function custom_posts_per_page( $query ) {
        if ( !is_admin() && $query->is_main_query() && is_category() ) {
            $query->set( 'posts_per_page', 2 ); // Change 10 to the number of posts you want per page
        }
    }
    add_action( 'pre_get_posts', 'custom_posts_per_page' );

    // add sidebar
    function mine_register_sidebar(){
        register_sidebar(array(
            'name'          => 'main-sidebar',
            'id'            => 'main-sidebar',
            'description'   => 'main sidebar',
            'class'         => 'main-sidebar',
            'before_sidebar'=> '<div class="widgets-sidebar list-unstyled">',
            'after_sidebar' => '</div>'
        ));
    }
    add_action('widgets_init','mine_register_sidebar');

    // add custom post : cars
    function cars_post(){
        $labels = array(
            'name'          => _x('Cars','post type general name'),
            'singular_name' => _x('Car','post type singular name'),
            'add_new'      => _x('Add New Car','car'),
            'add_new_item'  => __('Add New Car','Type'),
            'edit_item'     => __('Edit Car Type'),
            'new_item'      => __('New Car Type'),
            'all_items'     => __('New Car Type'),
            'view_item'     => __('View Car Type'),
            'search_items'  => __('Search Car Type'),
            'not_fount'     => __('No Car Type found'),
            'menu_name'     => 'Cars'
        );
        $args_cars_post = array(
            'labels'        => $labels,
            'hierarchical'  => true,
            'public'        => true,
            'has_archive'   => true,
            'menu_icon'     => 'dashicons-car',
            'supports'      => array('title','editor','thumbnail','custom-fields'),
        );
        register_post_type('cars',$args_cars_post);
    }

    add_action('init','cars_post');

    // add brand taxonomy 
    function brand_taxonomy(){
        $labels2 = array(
            'name'          => 'Brands',
            'singular_name' => 'Brand',
        );
        $args_taxonomy = array(
            'labels'        => $labels2,
            'public'        => true,
            'hierarchical'  => true,
        );

        register_taxonomy('brands',array('cars'),$args_taxonomy);
    }

    add_action('init','brand_taxonomy');

    // enquiry form
    function car_form(){
        // verify the nonce
        if(!wp_verify_nonce($_POST['nonce'],'ajax-nonce')){
            wp_send_json_error('Nonce is incorrect',401);
            die();
        }

        $formdata = [];
        wp_parse_str($_POST['enquiry'],$formdata);

        $admin_email    = get_option('admin_email');
        $subject        = 'Enquiry from : '.$formdata['fname'];

        $message = '';
        foreach($formdata as $index=>$field){
            $message .= '<strong>'.$index.':</strong> '.$field.'<br/>';
        }
        // using phpmailer included in WP

        $mail = new PHPMailer();
        
            $mail->isSMTP();
            $mail->Host     = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mokeddemamine1707@gmail.com';
            $mail->Password = 'wazu tlsz thus gnir';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;

            $mail->SetFrom($formdata['email'],$formdata['fname']);
            $mail->addAddress($admin_email,'Mr. Admin');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            if($mail->send()){
                wp_send_json_success('Email send');
            }else{
                wp_send_json_error('email failed');
            }
            

    }
    
    add_action('wp_ajax_enquiry','car_form');
    add_action('wp_ajax_nopriv_enquiry','car_form');

    // phpMailer installed in WP
    // function custom_mailer(PHPMailer $mail){
    //     global $formdata;
    //     $mail->SetFrom('mokeddemamine1707@gmail.com','mokeddem amine');
    //     $mail->Host     = 'smtp.gmail.com';
    //     $mail->Port     = 587;
    //     $mail->SMTPAuth = true;
    //     $mail->SMTPSecure = 'tls';
    //     $mail->Username = 'mokeddemamine1707@gmail.com';
    //     $mail->Password = 'srgq qtqx qtar zuhw';
    //     $mail->isSMTP();
    // }

    // add_action('phpmailer_init','custom_mailer');


    // search car in cars posts

    function search_query(){
        $args = [
            'post_type'         => 'cars',
            'post_per_page'     => 0,
            'tax_query'         => [],
            'meta_qeury'        => ['relation'=> 'And'],
        ];

        if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
            $args['s'] = sanitize_text_field($_GET['keyword']);
        }

        if(isset($_GET['brand']) && !empty($_GET['brand'])){
            $args['tax_query'][] = [
                'taxonomy'      => 'brands',
                'field'         => 'slug',
                'terms'         => array(sanitize_text_field($_GET['brand'])),
            ]; 
        }

        if(isset($_GET['price_above']) && !empty($_GET['price_above'])){
            $args['meta_query'][] = array(
                'key'           => 'price',
                'value'         => sanitize_text_field($_GET['price_above']),
                'compare'       => '>=',
                'type'          => 'numeric',
            );
        }

        if(isset($_GET['price_below']) && !empty($_GET['price_below'])){
            $args['meta_query'][] = array(
                'key'           => 'price',
                'value'         => sanitize_text_field($_GET['price_below']),
                'compare'       => '<=',
                'type'          => 'numeric',
            );
        }

        return new WP_Query($args);
    }