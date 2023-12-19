<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package dici
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function dici_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'dici_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function dici_woocommerce_scripts() {
	wp_enqueue_style( 'dici-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
}
add_action( 'wp_enqueue_scripts', 'dici_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function dici_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'dici_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function dici_woocommerce_products_per_page() {
	return get_theme_mod('products_per_page', '12');
}
add_filter( 'loop_shop_per_page', 'dici_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function dici_woocommerce_thumbnail_columns() {
	return get_theme_mod('products_thumbnail_columns', '4');
}
add_filter( 'woocommerce_product_thumbnails_columns', 'dici_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function dici_woocommerce_loop_columns() {
	return get_theme_mod('products_per_row', '3');
}
add_filter( 'loop_shop_columns', 'dici_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function dici_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => get_theme_mod('related_products_per_page', '4'),
		'columns'        => get_theme_mod('related_products_per_column', '4')
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'dici_woocommerce_related_products_args' );

if ( ! function_exists( 'dici_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function dici_woocommerce_product_columns_wrapper() {
		$columns = dici_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'dici_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'dici_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function dici_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'dici_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'dici_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function dici_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'dici_woocommerce_wrapper_before' );

if ( ! function_exists( 'dici_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function dici_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'dici_woocommerce_wrapper_after' );

if ( ! function_exists( 'dici_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function dici_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		dici_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'dici_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'dici_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function dici_woocommerce_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'dici' ); ?>">
				<?php /* translators: number of items in the mini cart. */ ?>
				<?php
                    $item_count_text = sprintf(
                        /* translators: number of items in the mini cart. */
                        _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'dici' ),
                        WC()->cart->get_cart_contents_count()
                    );
                    ?>
                	<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>

            </a>
		<?php
	}
}

if ( ! function_exists( 'dici_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function dici_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<div id="site-header-cart" class="site-header-cart">
			<div class="cart-toggler <?php echo esc_attr( $class ); ?>">
				<?php dici_woocommerce_cart_link(); ?>
			</div>
			<div class="site-header-cart-contents"><span id="cart-close" class="cart-close">×</span><?php
					$instance = array(
						'title' => esc_html__('Shopping Cart','dici'),
					);

					the_widget( 'WC_Widget_Cart', $instance );
				?></div>
		</div>
		<?php
	}
}
// Add wrapper around Product name in the cart
add_filter( 'woocommerce_cart_item_name', 'dici_cart_product_name_wrapper', 99, 3 );
if ( ! function_exists( 'dici_cart_product_name_wrapper' ) ) {

    function dici_cart_product_name_wrapper( $product_name, $cart_item, $cart_item_key ){

        $product_name = '<span>'.$product_name.'</span><br/>';

        return $product_name;

    }

}
// Move title

add_filter( 'woocommerce_show_page_title', '__return_false' );

// Product layout start

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); // we are moving the link to the product title
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9 );

add_action( 'woocommerce_before_shop_loop_item_title', 'dici_product_thumbnail_wrapper_start', 0 );

if ( !function_exists( 'dici_product_thumbnail_wrapper_start' ) ) :
    function dici_product_thumbnail_wrapper_start(){
        ?>
        <div class="<?php echo esc_attr( 'dici-thumb-wrapper' )?>">
        <?php
    }
endif;

add_action( 'woocommerce_after_shop_loop_item', 'dici_product_thumbnail_wrapper_end', 13 );

//Adding wishlist if there is one

if ( function_exists( 'tinvwl_view_addto_htmlloop' ) ) {

	remove_action( 'tinvwl_after_shop_loop_item', 'tinvwl_view_addto_htmlloop' );
	remove_action( 'woocommerce_after_shop_loop_item', 'tinvwl_view_addto_htmlloop');

    remove_action( 'woocommerce_before_shop_loop_item', 'tinvwl_view_addto_htmlloop');
	remove_action( 'tinvwl_after_shop_loop_item', 'tinvwl_view_addto_htmlloop' );

	add_action( 'woocommerce_before_shop_loop_item_title', 'tinvwl_view_addto_htmlloop', 14 );
}

// Adding custom product badges

if ( !function_exists( 'dici_custom_badges' ) ) :

    function dici_custom_badges(){
	    global $post;
	    $last_badge = get_post_custom_values( 'dici_badge_last' );
	    $last_badge = $last_badge ? $last_badge[0] : '' ;
	    $new_badge = get_post_custom_values( 'dici_badge_new' );
	    $new_badge = $new_badge ? $new_badge[0] : '' ;
	    if ( $last_badge ) {
	        ?>
            <span class="last-badge"><?php echo esc_html( $last_badge ); ?></span>
            <?php
        }
	    if ( $new_badge ) {
		    ?>
            <span class="new-badge"><?php echo esc_html( $new_badge ); ?></span>
		    <?php
	    }
    }

	add_action( 'woocommerce_before_shop_loop_item_title', 'dici_custom_badges', 10 );

endif;

if ( ! function_exists( 'dici_listing_gallery' ) ) :
	add_action( 'woocommerce_before_shop_loop_item_title', 'dici_listing_gallery', 11 );
	function dici_listing_gallery(){
		global $product;
		$attachment_ids = $product->get_gallery_image_ids();
		if ( count($attachment_ids) ) {
			$gallery_image = $attachment_ids[0];
			echo wp_get_attachment_image($gallery_image, 'shop_catalog', false, array('class'=>'dici-gallery-image'));
		}
	}
endif;

if ( !function_exists( 'dici_product_thumbnail_wrapper_end' ) ) :
	function dici_product_thumbnail_wrapper_end(){
		?>
        </div><!--<?php echo esc_attr( 'dici-thumb-wrapper' )?>-->
		<?php
	}
endif;

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );

add_action( 'woocommerce_shop_loop_item_title', 'dici_cats_list', 1 );

if ( ! function_exists( 'dici_cats_list' ) ) :
    function dici_cats_list(){
        global $post;
	    $product_categories_list = get_the_terms( $post, 'product_cat' );
	    if ( count( $product_categories_list ) ) {
	        ?>
            <span class="dici-prod-cat-list">
            <?php
            $cat_count = 0;
            foreach ( $product_categories_list as $product_category ){
	            $cat_count++;
	            if ( $cat_count > 1 ) break;
                ?>
                <span class="dici-prod-cat"><?php echo esc_html( $product_category->name ) ?></span>
                <?php
            }
            ?>
            </span>
		    <?php
	    }
    }
endif;

if ( !function_exists( 'dici_button_wrapper_start' ) ) :

    function dici_button_wrapper_start(){
        ?>
        <div class="<?php echo esc_attr( 'dici-buttons-wrapper' )?>">
        <?php
    }

	add_action( 'woocommerce_after_shop_loop_item', 'dici_button_wrapper_start', 8 );

endif;

if ( !function_exists( 'dici_button_wrapper_end' ) ) :

    function dici_button_wrapper_end(){
        ?>
        </div> <!-- <?php echo esc_attr( 'dici-buttons-wrapper' )?> -->
        <?php
    }

    add_action( 'woocommerce_after_shop_loop_item', 'dici_button_wrapper_end', 12 );

endif;

if ( 'off' === get_theme_mod('product_listing_rating', 'off') ) {
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
}

// Product layout end

// Pagination
add_filter( 'woocommerce_pagination_args', 'dici_woo_pagination_args' );

if ( ! function_exists('dici_woo_pagination_args' ) ) :

    function dici_woo_pagination_args( $args ){

        $args['prev_text'] = '<i class="dici-icon-angle-double-left"></i>';
		$args['next_text'] = '<i class="dici-icon-angle-double-right"></i>';

        return $args;

    }

endif;

// Single Product Layout Start

add_action( 'woocommerce_after_single_product_summary', 'dici_woo_tabs_wrapper_start', 9 );

if ( !function_exists( 'dici_woo_tabs_wrapper_start' ) ) :
    function dici_woo_tabs_wrapper_start(){
        ?>
        <div class="<?php echo esc_attr( 'dici-tabs-wrapper' )?>" >
        <?php
    }
endif;

add_action( 'woocommerce_after_single_product_summary', 'dici_woo_tabs_wrapper_end', 11 );

if ( !function_exists( 'dici_woo_tabs_wrapper_end' ) ) :
     function dici_woo_tabs_wrapper_end(){
     ?>
        </div><!--<?php echo esc_attr( 'dici-tabs-wrapper' )?>-->
     <?php
     }
endif;



add_filter('woocommerce_product_review_comment_form_args', 'dici_review_form_filter');

if ( ! function_exists( 'dici_review_form_filter' ) ){
	function dici_review_form_filter($args){

		$args['fields']['email'] = str_replace('input id="email"', 'input id="email" placeholder="'.esc_html__('Your E-Mail', 'dici').''.(strpos($args['fields']['email'], 'required') ? '*' : '').'" ', $args['fields']['email']);
		$args['fields']['author'] = str_replace('input id="author"', 'input id="author" placeholder="'.esc_html__('Your Name', 'dici').''.(strpos($args['fields']['author'], 'required') ? '*' : '').'" ', $args['fields']['author']);
		$args['comment_field'] = str_replace('textarea id="comment"', 'textarea id="comment" placeholder="'.esc_html__('Your Review', 'dici').'" ', $args['comment_field']);
		return $args;
	}
}

// Single Product Layout End

// Cart Layout Start

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

add_action( 'woocommerce_cart_collaterals', 'dici_cart_totals_wrap_start', 10 );

if ( !function_exists( 'dici_cart_totals_wrap_start' ) ) {

    function dici_cart_totals_wrap_start(){
        ?>
        <div class="cart-totals-wrap">
        <?php
    }

}

add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 11 );

add_action( 'woocommerce_cart_collaterals', 'dici_cart_totals_wrap_end', 12 );

if ( !function_exists( 'dici_cart_totals_wrap_end' ) ) {

	function dici_cart_totals_wrap_end(){
		?>
        </div>
		<?php
	}

}

// Cart Layout End

// Checkout Layout Start

add_action( 'woocommerce_checkout_order_review', 'dici_order_review_wrap_start', 9 );

if ( ! function_exists( 'dici_order_review_wrap_start' ) ) {
    function dici_order_review_wrap_start(){
        ?>
            <div class="woocommerce-checkout-review-order-inner">
        <?php
    }
}

add_action( 'woocommerce_checkout_order_review', 'dici_order_review_wrap_end', 21 );

if ( ! function_exists( 'dici_order_review_wrap_end' ) ) {
	function dici_order_review_wrap_end(){
		?>
            </div>
		<?php
	}
}

// Checkout Layout End

// Elementor Support Start

if ( class_exists( 'Elementor\Plugin' ) ) {
    add_action('admin_action_elementor', 'register_wc_hooks_in_elementor', 9);
}

if ( ! function_exists( 'register_wc_hooks_in_elementor' ) ) :

function register_wc_hooks_in_elementor(){
	if ( function_exists( 'wc' ) )
		wc()->frontend_includes();
}

endif;

// Elementor Support End