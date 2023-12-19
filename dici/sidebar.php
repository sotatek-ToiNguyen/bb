<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dici
 */

if ( is_active_sidebar( DiCi_Controller::instance()->get_page_sidebar_tag() ) ) :
?>
<aside id="secondary" class="widget-area <?php echo esc_attr( DiCi_Controller::instance()->get_page_sidebar_tag() )?>-area">
    <?php dynamic_sidebar( DiCi_Controller::instance()->get_page_sidebar_tag() ); ?>
</aside><!-- #secondary -->
<?php
endif;
