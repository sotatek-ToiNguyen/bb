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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
        <?php
            the_excerpt();
        ?>
        </div><!-- .entry-content -->
        <div class="entry-meta">
            <?php
            dici_entry_tags();
            dici_comment_link();
            ?>
        </div><!-- .entry-meta -->
    </section>
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'dici_after_post' ); ?>
