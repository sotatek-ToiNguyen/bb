<?php

add_action( 'wp_enqueue_scripts', 'dici_theme_enqueue_styles' );
function dici_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_action( 'wp_enqueue_scripts', 'dicichild_theme_enqueue_styles' );
function dicichild_theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

// Controller overload
if ( !class_exists('TZ_Theme_Controller') )  require_once get_template_directory() . '/../dici/inc/lib/class-tz-theme-controller.php';
if ( !class_exists('DiCi_Controller') ) require_once get_template_directory() . '/../dici/inc/class-dici-controller.php';


class DiCi_Child_Controller extends DiCi_Controller
{
    // You can overload any method from DiCi_Controller you want here

    function page_banner( $image_id ){
        if ( $image_id ) : ?>
            <div class="<?php echo esc_attr( 'dici-top-banner' )?>">
                <?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
            </div>
        <?php endif;
    }
}

// Run controller
remove_action( 'after_setup_theme', 'DiCi_Controller::instance' );
add_action( 'after_setup_theme', 'DiCi_Child_Controller::instance' );

