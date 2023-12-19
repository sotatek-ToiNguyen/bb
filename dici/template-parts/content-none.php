<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dici
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'dici' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
					'%1$s <a href="%2$s">%3$s</a>.',
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_html__('Ready to publish your first post?', 'dici'),
				esc_url( admin_url( 'post-new.php' ) ),
                esc_html__('Get started here', 'dici')
			);

        elseif ( is_search() ) :
			?>

            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dici' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dici' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
    </div><!-- .page-content -->
</section><!-- .no-results -->