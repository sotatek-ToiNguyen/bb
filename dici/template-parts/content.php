<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dici
 */

?>

<?php do_action( 'dici_before_post', get_post_format(get_the_ID()), is_sticky(get_the_ID()) ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <?php dici_post_thumbnail(); ?>
    <section class="<?php echo esc_attr( 'dici-post-inner' ); ?>" <?php esc_html_e(is_sticky(get_the_ID()) ? 'data-sticky='.esc_attr_x( 'Featured', 'post', 'dici' ) : '') ?>>
        <div class="entry-categories">
            <?php dici_entry_categories(); ?>
        </div>
        <header class="entry-header">
            <?php
            if ( is_singular() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

            if ( 'post' === get_post_type() ) :
                ?>

                <div class="entry-meta">
                    <?php
                    if ( 'decorated' === get_theme_mod('blog_posts_style', 'classy') ) {
                        dici_posted_on_decorated();
                    } else {
                        dici_posted_by();
                        esc_html_e(' on ', 'dici');
                        dici_posted_on();
                    }
                    ?>
                </div><!-- .entry-meta -->

            <?php endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-content">

            <?php if ( 'grid' === get_theme_mod('blog_posts_layout', 'list') ) : ?>
                <?php  the_excerpt() ?>
                <?php else : ?>
                <?php
                the_content(sprintf(
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
                ));

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dici' ),
                    'after'  => '</div>',
                ) );
                ?>
            <?php endif; ?>
        </div><!-- .entry-content -->
        <?php if ( ( 'classy' === get_theme_mod('blog_posts_style', 'classy') && ( 'grid' !== get_theme_mod( 'blog_posts_layout', 'list' ) ) ) ) : ?>
            <div class="entry-meta">
                <?php
                dici_entry_tags();
                dici_comment_link();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </section>
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'dici_after_post' ); ?>
