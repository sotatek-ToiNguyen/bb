<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dici
 */

?>
    <?php do_action( 'dici_after_site_content' ); ?>
	</div><!-- #content -->
    <?php do_action( 'dici_before_footer' ); ?>
<?php
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) :
?>
    <?php if ( ! get_theme_mod( 'footer_sign', false ) ) : ?>
	<footer id="colophon" class="site-footer">
        <div class="site-footer-inner">
            <?php do_action( 'dici_before_site_info' ); ?>
            <div class="site-info">
		        <?php
		        $dici_footer_copyright = get_theme_mod('footer_copyright_text');
		        if ( isset( $dici_footer_copyright ) && ( '' != $dici_footer_copyright ) ) :
			        ?>

			        <?php echo wp_kses_post( $dici_footer_copyright ); ?>

		        <?php else :?>

                    <a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>"><?php
				        /* translators: %s: CMS name, i.e. WordPress. */
				        printf( esc_html__( 'Powered by %s', 'dici' ), 'WordPress' );
				        ?></a>
                    <span class="sep"> | </span>
			        <?php
			        /* translators: 1: Theme name, 2: Theme author. */
			        printf( esc_html__( 'Theme: %1$s by %2$s.', 'dici' ), '<b>DiCi</b>', '<a href="https://themes.zone">Themes Zone</a>' );
			        ?>
		        <?php endif; ?>
            </div><!-- .site-info -->
            <?php do_action( 'dici_after_site_info' ); ?>
        </div>
	</footer><!-- #colophon -->
    <?php endif; ?>
<?php endif; ?>
    <?php do_action( 'dici_after_footer' ); ?>
</div><!-- #page -->
<?php do_action( 'dici_after_page' );?>
<?php wp_footer(); ?>
</body>
</html>
