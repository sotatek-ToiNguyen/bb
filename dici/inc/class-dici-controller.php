<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 15/02/2018
 * Time: 15:53
 */

class DiCi_Controller extends ThemesZone_Theme_Controller{ // overload Theme Controllers Functionality here

    function load_global_scripts(){

        parent::load_global_scripts();

        wp_enqueue_style( 'dici-fontawesome', get_template_directory_uri() . '/assets/css/all.min.css');

	    wp_enqueue_script( 'dici-animate-controller', get_template_directory_uri() . '/js/animate-controller.js', array(), THEMESZONE_THEME_VERSION, true );
	    wp_enqueue_script( 'dici-subitems-controller', get_template_directory_uri() . '/js/subitems-controller.js', array(), THEMESZONE_THEME_VERSION, true );

	    wp_deregister_script('select2');

		wp_register_script( 'select2', get_template_directory_uri() . '/js/select2.min.js', array('jquery'));

	    wp_enqueue_script('select2', array('jquery'), true);

	    if ( 'enabled' === get_theme_mod('sticky_header', 'disabled') ) {
		    wp_enqueue_script( 'dici-sticky-controller', get_template_directory_uri() . '/js/sticky-controller.js', array(), THEMESZONE_THEME_VERSION, true );
        }


    }

    function global_layout_hooks(){

	    parent::global_layout_hooks();

	    if ( 'enabled' === get_theme_mod('sticky_header', 'disabled') ) {
			add_action( 'dici_before_header', [$this, 'sticky_header'], 2 );
		}

	    if ( get_theme_mod( 'footer_elementor', true )
            && ThemesZone_Theme_Helper::elementor_installed()
            && class_exists( 'Dici_Feature_Pack_Elementor_HF' )
        ){
	        add_action( 'dici_before_footer', [$this, 'render_elementor_footer'], 1);
	    }

	    if ( get_theme_mod( 'header_elementor', false )
		    && ThemesZone_Theme_Helper::elementor_installed()
		    && class_exists( 'Dici_Feature_Pack_Elementor_HF' )
	    ){
	        if ( is_front_page() && get_theme_mod( 'header_elementor_home', false ) ){
	            add_filter( 'get_dici_hf_header_id', function( $cur_header_id ) {
		            $home_header_id = get_theme_mod( 'header_elementor_home_id' );
		            if ( isset( $home_header_id ) && ( "0" != $home_header_id ) ) return ( int ) $home_header_id;
		            else return $cur_header_id;
                } );
            }
	        add_action( 'dici_after_header', [$this, 'render_elementor_header'], 1);
	    }

        if ( get_theme_mod( 'dedicated_mobile_header', true )
            && ThemesZone_Theme_Helper::elementor_installed()
            && class_exists( 'Dici_Feature_Pack_Elementor_HF' )
        ){

        }

	    add_action( 'dici_between_header_content', [$this, 'page_heading'], 1 );

	    add_action( 'dici_page_header_breadcrumbs', [$this, 'breadcrumbs'], 1, 1);

        add_action( 'dici_single_post_footer', [$this, 'post_author'], 1, 1);

		add_action( 'dici_after_site_info', [$this, 'social_menu'] );
	    add_action( 'dici_after_site_info', [$this, 'footer_menu'] );

	    add_action( 'dici_after_post_loop', [$this, 'posts_navigation'], 99 );


	    add_filter( 'comment_form_default_fields', [$this, 'comments_form_fileds'] );

	    add_filter( 'the_content_more_link', [$this, 'more_link'] );

	    if ( class_exists( 'Elementor\Plugin' ) ) $this->elementor_layout_hooks();

	    if ( class_exists( 'WooCommerce' ) ) $this->woo_layout_hooks();

	    add_filter( 'post_gallery', [$this, 'gallery_controller'], 1002, 3 );

	    add_filter( 'dici_post_navigation', [$this, 'post_navigation'], 1, 1);

	    add_filter( 'dici_comment_form_args', [$this, 'comment_args'], 1, 1 );

	    add_filter( 'excerpt_length', [$this, 'excerpt_length'], 999 );

	    add_filter('excerpt_more', [$this, 'excerpt_more'] );

	}

	function load_product_scripts(){

		wp_enqueue_script( 'dici-single-product', get_template_directory_uri() . '/js/single-product.js', array(), THEMESZONE_THEME_VERSION, true );
		wp_localize_script( 'dici-single-product', 'options', [
			        'label_write_review' => esc_html__('Add a review','dici')
		        ]);

    }

    function elementor_layout_hooks(){
        if ( ThemesZone_Theme_Helper::is_elementor() ) {
	        add_filter( 'dici_show_page_title', '__return_false' );
	        add_filter( 'dici_show_page_comments', '__return_false' );
        }
    }

    function gallery_controller( $html, $atts, $instance ){
	    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), THEMESZONE_THEME_VERSION, true );
        wp_enqueue_script( 'packery-mode', get_template_directory_uri() . '/js/packery-mode.pkgd.min.js', array(), THEMESZONE_THEME_VERSION, true );
	    wp_enqueue_script( 'dici-gallery-controller', get_template_directory_uri() . '/js/gallery-controller.js', array('imagesloaded'), THEMESZONE_THEME_VERSION, true );
    }

	function woo_layout_hooks(){
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
        add_filter( 'woocommerce_breadcrumb_defaults', [$this, 'breadcrumb_filter'] );
        if (
                ThemesZone_Theme_Helper::is_cart()
                || ThemesZone_Theme_Helper::is_checkout()
                || ThemesZone_Theme_Helper::is_account()
                || ThemesZone_Theme_Helper::is_order_tracking()
        ) add_filter( 'dici_show_page_title', '__return_false' );
    }

    function post_layout_hooks(){
        add_action( 'dici_after_nav_single', [$this, 'display_related_posts'] );
    }

    function display_related_posts(){
	    if ( function_exists( 'related_posts_by_taxonomy_init' ) ) echo do_shortcode('[related_posts_by_tax columns="2" format="excerpts" limit_posts="2"]');
    }

    function breadcrumb_filter($args){
        $args['delimiter'] = '&nbsp;<i class="dici-icon-right-open-big"></i>&nbsp;' ;
	    $args['before'] = '<span class="nav-item">';
	    $args['after'] = '</span>';
        return $args;
    }

    function post_author(){

        if ( '' != get_the_author_meta('description') ) :
        ?>
        <div class="post-author">
            <?php
                echo get_avatar(get_the_author_meta('ID'), 165);
            ?>
            <div class="author-inner">
                <h5><?php echo get_the_author_meta('display_name'); ?></h5>
                <p>
                    <?php echo get_the_author_meta('description'); ?>
                </p>
            </div>
        </div>
        <?php
        endif;

    }

	function sticky_header(){
		?>
        <div class="sticky-header">
        <nav id="sticky-navigation" class="main-navigation">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'menu-main',
			'menu_id'        => 'primary-menu',
		) );
        ?></nav>
        </div>
		<?php
	}


	function register_conditional_menus(){
		register_nav_menus( array(
			'top-header-menu' => esc_html__( 'Top Header Menu', 'dici' ),
			'social-menu' => esc_html__( 'Social Icons', 'dici' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'dici' ),
		) );
    }

	function get_top_header_sidebar(){
		if ( !( is_active_sidebar( 'sidebar-top-header' ) || has_nav_menu( 'top-header-menu' ) ) ) return;

		?>
        <section class="top-header-container">
            <div class="top-header-inner">
                <?php
                if ( has_nav_menu( 'top-header-menu' ) ){
                    wp_nav_menu( array(
                        'theme_location' => 'top-header-menu',
                        'menu_id'        => 'top-header-menu',
                        'depth' => 1
                    ) );
                }
                ?>
                <aside id="<?php echo esc_attr( 'dici-top-header-sidebar' )?>" class="<?php echo esc_attr( 'dici-top-header-widget-area' )?>">
                    <?php
                    dynamic_sidebar('sidebar-top-header');
                    ?>
                </aside>
            </div>
        </section>
		<?php
	}

    function get_post_thumbnail_size(){

        $blog_view = get_theme_mod( 'blog_posts_layout', 'list' );

	    if ( $blog_view == 'grid' ){
		    $blog_cols = get_theme_mod( 'posts_per_row', '2' );
		    return 'dici-post-thumbnail-'.$blog_cols.'cols';
        } else {
		    return 'dici-post-thumbnail-list';
        }

    }

    function add_image_sizes(){

	    set_post_thumbnail_size(1420, 680, array( 'center', 'center' ));

	    add_image_size( 'dici-single-post-thumbnail', 1420, 680, array( 'center', 'center' ) );

	    add_image_size( 'dici-post-thumbnail-4cols', 323, 9999 );

	    add_image_size( 'dici-post-thumbnail-3cols', 440, 9999 );

	    add_image_size( 'dici-post-thumbnail-2cols', 675, 9999 );

	    add_image_size( 'dici-post-thumbnail-list', 1380, 623, array( 'center', 'center' ) );

        add_image_size( 'dici-post-thumbnail-nav', 790, 384, array( 'center', 'center' ) );

    }

	function social_menu(){
        if ( has_nav_menu( 'social-menu' ) ){
	        wp_nav_menu( array(
		        'theme_location' => 'social-menu',
		        'menu_id'        => 'social-menu',
		        'depth' => 1
	        ) );
        }
    }

	function footer_menu(){
		if ( has_nav_menu( 'footer-menu' ) ){
			wp_nav_menu( array(
				'theme_location' => 'footer-menu',
				'menu_id'        => 'footer-menu',
				'depth' => 1
			) );
		}
	}

	function comment_args($args){
        $args['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'dici' ) . '</label><textarea id="comment" placeholder="' . esc_html__( 'Comment', 'dici' ) . '" name="comment" cols="45" rows="7" aria-required="true"></textarea></p>';
        return $args;
    }

	function posts_navigation(){

        if ( 'linked' == get_theme_mod('blog_pagination', 'paginated' ) ) {
		    the_posts_navigation();
        } else {
	        the_posts_pagination(array(
		        'prev_text' => '<i class="dici-icon-angle-double-left"></i>',
		        'next_text' => '<i class="dici-icon-angle-double-right"></i>',
	        ));
        }
    }

    function post_navigation( $args ){

        $prev_post_thumb = get_the_post_thumbnail(get_previous_post(), 'dici-post-thumbnail-nav');
        $next_post_thumb = get_the_post_thumbnail(get_next_post(), 'dici-post-thumbnail-nav');

        $next_post_thumb_class = $next_post_thumb ? '<div class="thumb-cover" ></div>': '';
        $prev_post_thumb_class = $prev_post_thumb ? '<div class="thumb-cover" ></div>': '';

        $args['prev_text'] = wp_kses( $prev_post_thumb.'<span class="post-nav-span"><b>'.esc_html__('previous post', 'dici').'</b> <span class="nav-post-title">%title</span></span>'.$prev_post_thumb_class, wp_kses_allowed_html('post') );
        $args['next_text'] = wp_kses( $next_post_thumb.'<span class="post-nav-span"><b>'.esc_html__('next post', 'dici').'</b> <span class="nav-post-title">%title</span></span>'.$next_post_thumb_class, wp_kses_allowed_html('post') );

        return $args;
    }

	function product_navigation(){
		if ( is_singular( 'product' ) )
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true"><i class="dici-icon-right-small"></i></span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next Product', 'dici' ) . '</span> ' .
					'<!--<span class="post-title">%title</span>-->',
				'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="dici-icon-left-small"></i></span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous Product', 'dici' ) . '</span> ' .
					'<!--<span class="post-title">%title</span>-->',
			) );

	}

    function blog_page_heading(){
	    if ( is_home() ) : ?>
            <?php $image = get_theme_mod( 'blog_page_banner', 0 ); ?>
            <header class="page-header-block <?php $this->custom_image($image) ?> ">
	            <?php $this->page_banner( $image ); ?>
	            <?php do_action( 'dici_page_header_breadcrumbs' )?>
                <?php if ( ! is_front_page()) : ?>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                <?php else: ?>
                    <h1 class="page-title"><?php esc_html_e('Blog', 'dici'); ?></h1>
                <?php endif; ?>
            </header>

	    <?php
	    endif;
    }

    function search_page_heading(){
        ?>
        <header class="page-header-block">
	        <?php do_action( 'dici_page_header_breadcrumbs' )?>
            <h1 class="page-title"><?php
			    /* translators: %s: search query. */
			    printf( esc_html__( 'Search Results for: %s', 'dici' ), '<span>' . get_search_query() . '</span>' );
			    ?></h1>
        </header><!-- .page-header -->
        <?php
    }

    function archive_page_heading(){
        ?>
        <header class="page-header-block">
	        <?php do_action( 'dici_page_header_breadcrumbs' )?>
		    <?php
		    the_archive_title( '<h1 class="page-title">', '</h1>' );
		    the_archive_description( '<div class="archive-description">', '</div>' );
		    ?>
        </header><!-- .page-header -->
        <?php
    }

    function single_page_heading(){
        if ( apply_filters( 'dici_show_page_title', true ) ) :
        ?>
        <header class="page-header-block">

                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        </header><!-- .entry-header -->
            <?php
        endif;

    }

    function post_page_heading(){

	    if ( get_theme_mod('post_layout', 'modern') === 'modern' ) :
        ?>
            <?php if ( have_posts() ) : the_post(); ?>
            <header class="page-header-block">
                <div class="entry-top">
                    <?php
                    dici_entry_categories();
                    ?>
                </div>
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
            </header>
		    <?php rewind_posts(); ?>
            <?php endif; ?>
        <?php
        else:
        ?>
            <header class="page-header-block">
                <?php do_action( 'dici_page_header_breadcrumbs' ); ?>
            </header><!-- .page-header -->
        <?php
        endif;
    }

    function shop_page_heading(){
	    $image = get_theme_mod( 'shop_page_banner', 0 );
        ?>
        <header class="page-header-block <?php $this->custom_image($image) ?>">
            <?php $this->page_banner( $image ); ?>
		    <?php woocommerce_breadcrumb(); ?>
            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        </header><!-- .page-header -->
        <?php
    }

    function page_banner( $image_id ){
        if ( $image_id ) : ?>
        <div class="<?php echo esc_attr( 'dici-top-banner' )?>">
            <?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
        </div>
        <?php endif;
    }

    function product_page_heading(  ){
	    $image = get_theme_mod( 'product_page_banner', 0 );
	    ?>
        <header class="page-header-block <?php $this->custom_image($image) ?> ">
		    <?php $this->page_banner( $image ); ?>
            <div class="page-header-block-inner">
		        <?php woocommerce_breadcrumb(); ?>
                <?php $this->product_navigation(); ?>
            </div>
        </header><!-- .page-header -->
	    <?php
    }

    function cart_page_heading(){
	    $image = get_theme_mod( 'cart_page_banner', 0 );
	    ?>
        <header class="page-header-block <?php $this->custom_image($image) ?> ">
		    <?php $this->page_banner( $image ); ?>
		    <?php woocommerce_breadcrumb(); ?>
		    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header><!-- .page-header -->
	    <?php
    }

	function checkout_page_heading(){
		$image = get_theme_mod( 'checkout_page_banner', 0 );
		?>
        <header class="page-header-block <?php $this->custom_image($image) ?> ">
			<?php $this->page_banner( $image ); ?>
			<?php woocommerce_breadcrumb(); ?>
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header><!-- .page-header -->
		<?php
	}

	function account_page_heading(){
		$image = get_theme_mod( 'account_page_banner', 0 );
		?>
        <header class="page-header-block <?php $this->custom_image($image) ?> ">
			<?php $this->page_banner( $image ); ?>
			<?php woocommerce_breadcrumb(); ?>
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header><!-- .page-header -->
		<?php
    }

	function order_tracking_page_heading(){
		$image = get_theme_mod( 'account_page_banner', 0 );
		?>
        <header class="page-header-block <?php $this->custom_image($image) ?> ">
			<?php $this->page_banner( $image ); ?>
			<?php woocommerce_breadcrumb(); ?>
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header><!-- .page-header -->
		<?php
	}

	function fof_page_heading(){
		?>
        <header class="page-header-block">
			<?php do_action( 'dici_page_header_breadcrumbs' )?>
        </header><!-- .page-header -->
		<?php
    }

	function get_blog_view()
	{
		$classes[] = parent::get_blog_view();
		$classes[] = 'dici-post-style-'.get_theme_mod('blog_posts_style', 'classy');
		$classes[] = 'dici-post-content-'. get_theme_mod('blog_post_content_align', 'left');
        $classes[] = 'dici-post-heading-'. get_theme_mod('blog_post_heading_align', 'left');
		return implode(' ', $classes);
	}

	function get_post_view(){
	    $classes[] = parent::get_post_view();
		$classes[] = 'dici-post-content-'. get_theme_mod('post_content_align', 'left');
        $classes[] = 'dici-post-heading-'. get_theme_mod('post_heading_align', 'left');
        $classes[] = ( get_theme_mod('post_layout', 'modern') == 'modern' ? 'dici-post-modern' : '' );
	    $classes[] = ( get_theme_mod('post_layout', 'modern') == 'modern' ? 'dici-heading-inset' : '' );
        return implode(' ', $classes);
    }

    function get_shop_view()
    {
	    $classes[] = parent::get_shop_view(); // TODO: Change the autogenerated stub

	    $classes[] = 'dici-product-content-'. get_theme_mod('product_content_align', 'center');

        return implode(' ', $classes);
    }

    function get_global_view()
    {
	    $classes[] = parent::get_global_view(); // TODO: Change the autogenerated stub
	    $classes[] = 'dici-product-content-'. get_theme_mod('product_content_align', 'center');
        $classes[] = 'dici-pr-btn-hvr-'. get_theme_mod('product_listing_button_hover', 'hide');
	    return implode(' ', $classes);
    }

	function page_heading(){
        if ( ThemesZone_Theme_Helper::is_blog() && !ThemesZone_Theme_Helper::is_archive() ) $this->blog_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_search() ) $this->search_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_page() && !ThemesZone_Theme_Helper::is_woocommerce()  ) $this->single_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_archive() && !ThemesZone_Theme_Helper::is_woocommerce() ) $this->archive_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_post() ) $this->post_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_shop() ) $this->shop_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_product() ) $this->product_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_cart() ) $this->cart_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_checkout() ) $this->checkout_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_account() ) $this->account_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_order_tracking() ) $this->order_tracking_page_heading();
        elseif ( ThemesZone_Theme_Helper::is_404() ) $this->fof_page_heading();
    }

    private function custom_image($image){
         echo esc_attr ( ( ( isset($image) && ( $image ) ) ? 'dici-custom-image' : '' ) );
    }



    function more_link( $link ){

	    $link = str_replace( 'class="more-link"', 'class="more-link" data-content="'.esc_attr__( 'Continue Reading', 'dici' ).'"', $link);

        return $link;
    }

    function comments_form_fileds( $fields ){

	    $req = get_option( 'require_name_email' );
	    $star = $req ? ' *': '';

        $fields['author'] = str_replace('id="author" name="author"', 'id="author" name="author" placeholder="'.esc_attr__('Name', 'dici').$star.'"', $fields['author']);
	    $fields['email']  = str_replace('id="email" name="email"', 'id="email" name="email" placeholder="'.esc_attr__('Email', 'dici').$star.'"', $fields['email'] );
	    $fields['url']    = str_replace('id="url" name="url"', 'id="url" name="url" placeholder="'.esc_attr__('Website', 'dici').'"', $fields['url']);

        return $fields;
    }

    function render_elementor_footer(){
        if ( class_exists( 'Dici_Feature_Pack_Elementor_HF' ) ) {
            if ( Dici_Feature_Pack_Elementor_HF::footer_enabled() ) {
	            Dici_Feature_Pack_Elementor_HF::render_footer();
            }
        }
    }

	function render_elementor_header(){
		if ( class_exists( 'Dici_Feature_Pack_Elementor_HF' ) ) {
			if ( Dici_Feature_Pack_Elementor_HF::header_enabled() ) {
				Dici_Feature_Pack_Elementor_HF::render_header();
			}
		}
	}


	function breadcrumbs( $display = true ){
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<nav class="nav-crumbs">','</nav>',  true );
		} else return false;
	}

	function excerpt_length( $length ) {
		return 18;
	}

	function excerpt_more( $more ){

		return '<br/><a class="more-link" href="'. get_permalink() . '">'.sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					'%1$s<span class="screen-reader-text"> "%2$s"</span>',
					array(
						'span' => array(
							'class' => array(''),
						),
					)
				),
				esc_html__('Continue Reading', 'dici'),
				get_the_title()
			).'</a>';

    }

    public static function get_available_headers(){

        $type = 'type_header';

	    $cached = wp_cache_get( $type.'_custom' );

	    if ( false !== $cached ) {
		    return $cached;
	    }

	    $args = array(
		    'post_type'    => 'elementor-dici-hf',
		    'meta_key'     => 'dici_hf_template_type',
		    'meta_type'    => 'post',
		    'meta_compare' => '>=',
		    'orderby'      => 'meta_value',
		    'order'        => 'ASC',
	    );

	    $args = apply_filters( 'dici_hf_get_template_id_args', $args );

	    $template = new WP_Query(
		    $args
	    );


	    if ( $template->have_posts() ) {

		    $posts_header = wp_list_pluck( $template->posts, 'post_title', 'ID' );
		    wp_cache_set( $type.'_custom', $posts_header );
		    return $posts_header;
	    }
    }


}