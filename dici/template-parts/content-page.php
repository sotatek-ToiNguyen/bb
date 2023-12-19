<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dici
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    if ( get_theme_mod('post_layout', 'modern') != 'modern' ) :
    ?>
	<header class="entry-header">
		<?php if ( apply_filters( 'dici_show_page_title', true ) ) : ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <?php endif; ?>
	</header><!-- .entry-header -->
    <?php endif; ?>

	<?php dici_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dici' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
						'%1$s <span class="screen-reader-text">%2$s</span>',
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					esc_html__('Edit', 'dici'),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
