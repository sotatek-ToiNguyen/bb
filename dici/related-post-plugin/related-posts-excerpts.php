<?php
/**
 * Widget and shortcode template: excerpts template.
 *
 * This template is used by the plugin: Related Posts by Taxonomy.
 *
 * plugin:        https://wordpress.org/plugins/related-posts-by-taxonomy
 * Documentation: https://keesiemeijer.wordpress.com/related-posts-by-taxonomy/
 *
 * @package Related Posts by Taxonomy
 * @since 0.1
 *
 * The following variables are available:
 *
 * @var array $related_posts Array with related posts objects or empty array.
 * @var array $rpbt_args     Widget or shortcode arguments.
 */
?>

<?php
/**
 * Note: global $post; is used before this template by the widget and the shortcode.
 */
?>

<?php if ( $related_posts ) : ?>
	<ul class="related-post">
		<?php foreach ( $related_posts as $post ) :
			setup_postdata( $post ); ?>
		<li>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <section class="<?php echo esc_attr( 'dici-post-inner' ); ?>">
                    <div class="entry-categories">
						<?php dici_entry_categories(); ?>
                    </div>
                    <header class="entry-header">
						<?php
                        the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
						if ( 'post' === get_post_type() ) :
							?>
                            <div class="entry-meta">
								<?php
								dici_posted_on();
								dici_comment_link();
								?>
                            </div><!-- .entry-meta -->
						<?php endif; ?>
                    </header><!-- .entry-header -->
                </section>
				<?php dici_post_thumbnail(); ?>
            </article><!-- #post-<?php the_ID(); ?> -->
		</li>
		<?php endforeach; ?>
	</ul>
<?php
	endif;
/**
 * note: wp_reset_postdata(); is used after this template by the widget and the shortcode
 */
?>