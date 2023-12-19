<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dici
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'dici_before_page' ); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'dici' ); ?></a>
    <?php do_action( 'dici_before_header' ); ?>
<?php
    //Elementor PRO
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) :
?>
<?php if ( ! dici_elementor_header_enabled() ) : ?>
    <header id="masthead" class="site-header">
        <section class="site-header-inner">
            <?php do_action( 'dici_before_header_content' ); ?>
            <?php dici_site_branding(); ?>
            <?php do_action( 'dici_after_header_content' ); ?>
        </section>
	    <?php do_action( 'dici_before_nav' ); ?>
        <?php if ( has_nav_menu('menu-main') ) : ?>
        <nav id="site-navigation" class="main-navigation">
			<?php if ( !function_exists('max_mega_menu_is_enabled') || !max_mega_menu_is_enabled('menu-main') ) : ?>
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'dici' ); ?></button>
			<?php endif; ?>
            <?php
				wp_nav_menu( array(
					'theme_location' => 'menu-main',
					'menu_id'        => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
        <?php endif; ?>
	    <?php do_action( 'dici_after_nav' ); ?>
	</header><!-- #masthead -->
<?php endif; ?>
<?php endif; ?>
<?php do_action( 'dici_after_header' ); ?>
<?php do_action( 'dici_between_header_content' ); ?>
	<div id="content" class="site-content">
        <?php do_action( 'dici_before_site_content' ); ?>