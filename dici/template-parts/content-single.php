<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dici
 */

?>
<?php do_action( 'dici_before_post_single', get_post_format(get_the_ID()), is_sticky(get_the_ID()) ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <section class="<?php echo esc_attr( 'dici-post-inner' ); ?>">

        <?php dici_post_thumbnail(); ?>
        <?php
        if ( get_theme_mod('post_layout', 'modern') != 'modern' ) :
        ?>
        <div class="entry-categories">
		    <?php dici_entry_categories(); ?>
        </div>

		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			endif;
            ?>
            <?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php
                    dici_posted_by();
                    esc_html_e(' on ', 'dici');
                    dici_posted_on();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
        <?php endif; ?>
        <div class="entry-content">
            <?php
            the_content( sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                '%1$s<span class="screen-reader-text"> "%2$s"</span>',
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                esc_html__('Continue Reading', 'dici'),
                get_the_title()
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dici' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->
        <footer class="entry-footer"><?php dici_entry_tags(); ?><?php do_action( 'dici_single_post_footer' ); ?></footer><!-- .entry-footer -->
	</section>
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'dici_after_post_single' ); ?>
