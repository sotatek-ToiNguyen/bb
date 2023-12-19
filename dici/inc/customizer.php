<?php
/**
 * dici Theme Customizer
 *
 * @package dici
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dici_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'dici_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'dici_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'dici_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function dici_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function dici_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dici_customize_preview_js() {
	wp_enqueue_script( 'dici-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'dici_customize_preview_js' );


/**
 * Customizer options based on Kirki Plugin.
 */

// Add Kirki Fallback class
require get_template_directory() . '/inc/lib/class-kirki-fallback.php';

if ( class_exists( 'DiCi_Kirki_Customizer' ) ) : // DiCi_Kirki_Customizer Options Start

	DiCi_Kirki_Customizer::add_config( 'dici_theme', array(
		'option_type' => 'theme_mod',
		'capability'  => 'edit_theme_options',
        'gutenberg_support' => true,
	) );

	if ( ! function_exists('dici_add_custom_fonts') ) {

		function dici_add_custom_fonts( $fonts ){

			$fonts['Butler'] = array(
				'label' => 'Butler',
				'variants' => array('200', '300', '400','400italic', '500','500italic', '600','600italic', '700','700italic', '800','800italic', 'regular','italic'),
				'stack' => 'Butler, serif',
                'subsets' => array( 'latin-ext' ),
			);

			$fonts['Butler Stencil'] = array(
				'label' => 'Butler Stencil',
				'variants' => array('400'),
				'stack' => 'Butler Stencil, Butler, serif',
                'subsets' => array( 'latin-ext' ),
			);

			$fonts['Poppins'] = array(
				'label' => 'Poppins',
				'variants' => array('200','200italic', '300','300italic', '400','400italic', '500','500italic', '600','600italic', '700','700italic', '800','800italic', 'regular','italic'),
				'stack' => 'Poppins, serif',
                'subsets' => array( 'latin-ext' ),
			);

			return $fonts;
		}

	}

	add_filter( 'kirki_fonts_standard_fonts', 'dici_add_custom_fonts' );

// Available Section

// Typography Section
	DiCi_Kirki_Customizer::add_section( 'typography', array(
		'title'      => esc_html__( 'Typography', 'dici' ),
		'priority'   => 1,
		'capability' => 'edit_theme_options',
	) );

// Header Section
	DiCi_Kirki_Customizer::add_section( 'header', array(
		'title'      => esc_html__( 'Header Layout', 'dici' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	) );

// Layout Section
	DiCi_Kirki_Customizer::add_section( 'layout', array(
		'title'      => esc_html__( 'Theme Layout', 'dici' ),
		'priority'   => 3,
		'capability' => 'edit_theme_options',
	) );

// Footer Section
	DiCi_Kirki_Customizer::add_section( 'footer', array(
		'title'      => esc_html__( 'Footer Layout', 'dici' ),
		'priority'   => 4,
		'capability' => 'edit_theme_options',
	) );

// Blog Section
	DiCi_Kirki_Customizer::add_section( 'blog', array(
		'title'      => esc_html__( 'Blog Options', 'dici' ),
		'priority'   => 5,
		'capability' => 'edit_theme_options',
	) );

// Post Section
	DiCi_Kirki_Customizer::add_section( 'post', array(
		'title'      => esc_html__( 'Post Options', 'dici' ),
		'priority'   => 5,
		'capability' => 'edit_theme_options',
	) );

// Shop Section
	DiCi_Kirki_Customizer::add_section( 'shop', array(
		'title'      => esc_html__( 'Shop Page Options', 'dici' ),
		'priority'   => 5,
		'capability' => 'edit_theme_options',
	) );

// Product Section
	DiCi_Kirki_Customizer::add_section( 'product', array(
		'title'      => esc_html__( 'Product Page Options', 'dici' ),
		'priority'   => 5,
		'capability' => 'edit_theme_options',
	) );

// Typography Start
	// global typography start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'global_font',
		'label'       => esc_html__( 'Global Font', 'dici' ),
		'description' => esc_attr__( 'Site wide font used everywhere if no other setting applied.', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-weight'    => '400',
			'font-size'      => '15px',
			'line-height'    => '1.75',
			'letter-spacing' => '0',
			'color'          => '#262626',
			'text-transform' => 'none',
			'text-align'     => 'left',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 1,
		'output'      => array(
			array(
				'element' => array(
					'body'
				),
			),
            array(
                'element'  => '.edit-post-visual-editor.editor-styles-wrapper',
                'context'  => array( 'editor' ),
            ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'headings_font',
		'label'       => esc_html__( 'Headings Font', 'dici' ),
		'description' => esc_attr__( 'Site wide headings font used everywhere if no other setting applied.', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Butler',
			'color'          => '#000000',
            'line-height'    => '1.3',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 2,
		'output'      => array(
			array(
				'element' => array(
					'h1',
					'h2',
					'h3',
					'h4',
					'.dici-testimonials .elementor-testimonial-content',
					'.tz-woo-product-categories li .cat-caption .cat-name'
				),
			),
            array(
                'element'  => array(
                    '.edit-post-visual-editor.editor-styles-wrapper h1',
                    '.edit-post-visual-editor.editor-styles-wrapper h2',
                    '.edit-post-visual-editor.editor-styles-wrapper h3',
                    '.edit-post-visual-editor.editor-styles-wrapper h4',
                    '.editor-post-title__block',
                    '.editor-post-title__block .editor-post-title__input'
                ),
                'context'  => array( 'editor' ),
            ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'accent_color',
		'label'       => esc_html__( 'Accent Color', 'dici' ),
		'description' => esc_attr__( 'Accent Color (secondary site color).', 'dici' ),
		'section'     => 'colors',
		'default'     => '#00d1b7',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => array(
					'.site-header-cart .cart-toggler .cart-contents',
					'.site-header-cart .product_list_widget li .remove',
					'.tagcloud a:hover',
					'.single-product .summary .product_meta .posted_in:before',
					'.single-product .summary .product_meta .sku_wrapper:before',
					'.single-product .summary .product_meta .tagged_as:before',
					'.vdz_cb_btn',
					'.dici-call-back-button-view:before, .dici-shop-address-view:before',
					'ul.products .product .added_to_cart',
                    'blockquote:before',
                    '.shop_table .product-remove a',
                    '.dici-call-back-button-view .vdz_cb_btn',
                    '.dici-shop-address-view .vdz_cb_btn'

				),
				'property' => 'color',
			),

			array(
				'element'  => array(
					'.heading-undersocre:after',
					'#secondary .widget.widget_tag_cloud .tagcloud a:hover',
					'.mejs-container, .mejs-container .mejs-controls, .mejs-embed, .mejs-embed body',
					'.widget_price_filter .ui-slider .ui-slider-range',
					'.widget_price_filter .price_slider_amount .button:hover',
					'.woo-variation-swatches-stylesheet-enabled .variable-items-wrapper .variable-item.button-variable-item:not(.radio-variable-item).selected',
					'.woo-variation-swatches-stylesheet-enabled .variable-items-wrapper .variable-item.button-variable-item:not(.radio-variable-item).selected:hover',
					'.single-post .rpbt_shortcode > h3:after',
					'.shop_table .button:hover',
					'.wpcf7-form input[type="submit"]:hover',
					'.elementor-widget-tz-woo-product-tabs .tz-tab-title::after',
                    '.post-header-widget.widget_wishlist_products_counter .wishlist_products_counter .wishlist_products_counter_number',
                    '.pre-header-widget.widget_wishlist_products_counter .wishlist_products_counter .wishlist_products_counter_number',
                    '.dici-elementor-header .elementor-widget-wp-widget-widget_top_wishlist .wishlist_products_counter .wishlist_products_counter_number',
                    '.single-product .dici-tabs-wrapper .tabs li:hover a:after, .single-product .dici-tabs-wrapper .tabs li.active a:after',
                    '.site-header-cart .cart-toggler .cart-contents .count',
                    '.site-header-cart .product_list_widget li .remove:hover',

				),
				'property' => 'background-color',
			),

			array(
				'element' => array(
					'.lrm-form button[type=submit]',
					'.tz-woo-product-categories .owl-dots .owl-dot',
					'.underline:after'
				),
				'property' => 'background-color',
				'suffix'   => '!important',
			),

			array(
				'element'  => array(
					'.widget_product_tag_cloud .tagcloud a:hover',
					'input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus',
					'.single-product .woocommerce-product-gallery .flex-control-thumbs li img.flex-active, .single-product .woocommerce-product-gallery .flex-control-thumbs li img:hover',
                    'blockquote',
                    '.comment-list .comment-body .comment-content blockquote'
				),
				'property' => 'border-color',
			),

			array(
				'element' => array(
					'.tz-woo-product-categories .owl-prev, .tz-woo-product-categories .owl-next',
					'.tz-posts-carousel .owl-prev, .tz-posts-carousel .owl-next',
				),
				'property' => 'color',
				'suffix'   => '!important',
			)

		),
	) );


    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'color',
        'settings'    => 'buttons_color',
        'label'       => esc_html__( 'Buttons Color', 'dici' ),
        'description' => esc_attr__( 'Buttons Color.', 'dici' ),
        'section'     => 'colors',
        'default'     => '#00d1b7',
        'choices'     => array(
            'alpha' => true,
        ),
        'output'   => array(

            array(
                'element'  => array(
                    'button, input[type="reset"]',
                    'input[type="button"]',
                    'input[type="submit"]',
                    '.site-header-cart .widget_shopping_cart_content .buttons a:hover',
                    '.widget_product_tag_cloud .tagcloud a:hover',
                    '.single-product .product .summary .single_add_to_cart_button:hover',
                    'ul.products .product .add_to_cart_button:hover',
                    'ul.products .product .product_type_variable:hover',
                    '.single-product .single-product-reviews .review-button-cont .button:hover',
                    '#review_form #respond p.form-submit input:hover',
                    '.site-header-cart .widget_shopping_cart_content .buttons a.checkout',
                    '.woocommerce-cart .wc-proceed-to-checkout a',
                    '.shop_table .button'

                ),
                'property' => 'background-color',
            ),

            array(
                'element' => array(
                    '.lrm-form button[type=submit]',
                    '.tz-woo-product-categories .owl-dots .owl-dot',
                    '.underline:after'
                ),
                'property' => 'background-color',
                'suffix'   => '!important',
            ),

        ),
    ) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'accent_color_text',
		'label'       => esc_html__( 'Accent Color for Text', 'dici' ),
		'description' => esc_attr__( 'Accent Color for Text.', 'dici' ),
		'section'     => 'colors',
		'default'     => '#109d92',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => array(
					'cite',
					'.widget_product_categories .product-categories li a:hover',
					'#secondary .widget.comments_widget_plus .cwp-author-link',
					'#secondary .widget.recent-posts-widget-with-thumbnails li .rpwwt-post-categories',
					'#secondary .widget.widget_categories li a:hover, #secondary .widget.widget_archive li a:hover',
					'.widget_calendar table #today',
					'.widget_recent_comments .recentcomments .comment-author-link a',
					'.comment-list .comment-body .comment-meta .comment-author .fn a',
					'.page-header-block [class*="crumb"] .breadcrumb_last, .error404 .page-header [class*="crumb"] .breadcrumb_last, .page-header-block [class*="crumb"] .nav-item:last-child',
					'.single-product .summary .product_meta .posted_in a',
					'.single-product .summary .product_meta .tagged_as a',
					'.shop_table.woocommerce-checkout-review-order-table .order-total .amount',
					'.breadcrumb_last',
                    '.entry-categories .cat-links a',
                    'article[class*="post"] .entry-categories .cat-links a',
                    '.tz-posts-carousel article .entry-categories .cat-links a',
                    '.single-post .post .entry-categories .cat-links a',
                    '.dici-elementor-footer .widget ul li a:hover',
                    '.dici-elementor-footer .elementor-widget-container ul li a:hover',
                    '.dici-footer-widget-area .widget ul li a:hover',
                    '.dici-footer-widget-area .elementor-widget-container ul li a:hover'
				),
				'property' => 'color',
			),
            array(
                'element'  => array(
                    'cite',
                ),
                'context'  => array( 'editor' ),
            ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'accent_color_alpha',
		'label'       => esc_html__( 'Accent Color with Alpha', 'dici' ),
		'description' => esc_attr__( 'Accent Color with Alpha chanel (secondary site color).', 'dici' ),
		'section'     => 'colors',
		'default'     => '#00d1b7',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(

			array(
				'element'  => array(
					'.mejs-container, .mejs-container .mejs-controls, .mejs-embed, .mejs-embed body',


				),
				'property' => 'background',
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'links_color',
		'label'       => esc_html__( 'Links color', 'dici' ),
		'description' => esc_attr__( 'Color for links site-wide.', 'dici' ),
		'section'     => 'colors',
		'default'     => '#000000',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => 'a',
				'property' => 'color',
			),
            array(
                'element'  => array(
                    'a',
                ),
                'property' => 'color',
                'context'  => array( 'editor' ),
            ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'links_color_hover',
		'label'       => esc_html__( 'Hovered links color', 'dici' ),
		'description' => esc_attr__( 'Hover color for links site-wide.', 'dici' ),
		'section'     => 'colors',
		'default'     => '#7e7e7e',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => 'a:hover',
				'property' => 'color',
			),
            array(
                'element'  => array(
                    'a:hover',
                ),
                'property' => 'color',
                'context'  => array( 'editor' ),
            ),
		),
	) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'menu_font',
		'label'       => esc_html__( 'Menu Font', 'dici' ),
		'description' => esc_attr__( 'Typography for main menu.', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '15px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#000000',
			'text-transform' => 'capitalize',
			'text-align'     => 'left',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 4,
		'output'      => array(
			array(
				'element' => array(
					'.main-navigation .menu > li > a',
					'.main-navigation .menu > ul > li > a',
					'.main-navigation .menu .nav-menu > li > a',
                    '.main-navigation .mega-menu > ul > li.mega-menu-item',
                    '.main-navigation .mega-menu > ul > li > a.mega-menu-link'
				),
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'logo_font',
		'label'       => esc_html__( 'Logo Font', 'dici' ),
		'description' => esc_attr__( 'Logo font, color, and size.', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Butler',
			'variant'        => '500',
			'font-size'      => '32px',
			'line-height'    => '1.5',
			'letter-spacing' => '0.5px',
			'color'          => '#000000',
			'text-transform' => 'uppercase',
			'text-align'     => 'center',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 3,
		'output'      => array(
			array(
				'element' => array(
					'.site-title',
					'.dici-footer-widget-area .footer-title b'

				),
			),
		),
	) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'page_heading_font',
		'label'       => esc_html__( 'Page Header Font', 'dici' ),
		'description' => esc_attr__( 'Title font for page header block.', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Butler',
			'variant'        => '500',
			'font-size'      => '40px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#000000',
			'text-transform' => 'capitalize',
			'text-align'     => 'center',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 3,
		'output'      => array(
			array(
				'element' => array(
					'.page-header-block .page-title',
                    '.single-post.dici-post-modern .page-header-block .entry-title',
				),
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'footer_signature_font',
		'label'       => esc_html__( 'Footer Signature Font', 'dici' ),
		'description' => esc_attr__( 'Typography for footer signature.', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '13px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#434343',
			'text-transform' => 'normal',
			'text-align'     => 'left',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 20,
		'output'      => array(
			array(
				'element' => array(
					'.site-info',
					'.site-info a',
					'.site-footer .menu li a'

				),
			),
		),
	) );
	// global typography end

	// blog typography start

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'blog_widget_title',
		'label'       => esc_html__( 'Blog Widget Titles', 'dici' ),
		'description' => esc_attr__( 'Typography for Sidebar widget title', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Butler',
			'variant'        => '500',
			'font-size'      => '22px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#000000',
			'text-transform' => 'capitalize',
			'text-align'     => 'left',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'#secondary .widget-title',
				),
			),
		),
	) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'typography',
        'settings'    => 'blog_widget_content',
        'label'       => esc_html__( 'Blog Widget Content', 'dici' ),
        'description' => esc_attr__( 'Typography for Sidebar widget content', 'dici' ),
        'section'     => 'typography',
        'default'     => array(
            'font-size'      => '14px',
            'line-height'    => '1.5',
            'color'          => '#262626',
            'text-align'     => 'left',
            'subsets' => array( 'latin-ext' ),
        ),
        'priority'    => 5,
        'output'      => array(
            array(
                'element' => array(
                    '#secondary > *:not(.widget-title)',
                ),
            ),
        ),
    ) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'archive_post_titles',
		'label'       => esc_html__( 'Blog Post Titles', 'dici' ),
		'description' => esc_attr__( 'Post titles typography on posts listings.', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Butler',
			'variant'        => '500',
			'font-size'      => '32px',
			'line-height'    => '1.3',
			'letter-spacing' => '0',
			'color'          => '#000000',
			'text-transform' => 'none',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'.blog #content article.post .entry-title',
                    '.single-post #content .related-post .post .entry-title',
                    '.search article[class*="post"] .entry-title',
                    '.archive article[class*="post"] .entry-title'

				),
			),
		),
	) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'typography',
        'settings'    => 'blog_post_text',
        'label'       => esc_html__( 'Blog Post Text', 'dici' ),
        'description' => esc_attr__( 'Typography for Blog Post text', 'dici' ),
        'section'     => 'typography',
        'default'     => array(
            'font-family'    => 'Poppins',
            'variant'        => '400',
            'font-size'      => '15px',
            'line-height'    => '1.75',
            'letter-spacing' => '0',
            'color'          => '#262626',
            'text-transform' => 'normal',
            'subsets' => array( 'latin-ext' ),
        ),
        'priority'    => 5,
        'output'      => array(
            array(
                'element' => array(
                    '.blog .post .dici-post-inner .entry-content',

                ),
            ),
        ),
    ) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'single_post_text',
		'label'       => esc_html__( 'Single Post Text', 'dici' ),
		'description' => esc_attr__( 'Typography for Blog Post text', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '15px',
			'line-height'    => '1.75',
			'letter-spacing' => '0',
			'color'          => '#262626',
			'text-transform' => 'normal',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'.single-post .post .dici-post-inner .entry-content',

				),
			),
		),
	) );


	// blog typography end


	// post typography start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'post_title',
		'label'       => esc_html__( 'Post Titles', 'dici' ),
		'description' => esc_attr__( 'Post title on single post page.', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Butler',
			'variant'        => '500',
			'font-size'      => '40px',
			'line-height'    => '1.3',
			'letter-spacing' => '0',
			'color'          => '#262626',
			'text-transform' => 'none',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'body.single-post #content .entry-header .entry-title',
                    'body.single-post .entry-title',
                    'body.page .entry-title'
				),
			),
		),
	) );
	// post typography end

	// product listing typography start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'product_listing_titles',
		'label'       => esc_html__( 'Product Titles on product listing page', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '1em',
			'line-height'    => '1.3',
			'letter-spacing' => '0',
			'color'          => '#000000',
			'text-transform' => 'none',
			'text-align'     => 'left',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'.products .product .woocommerce-loop-product__title',
                    '.woocommerce-grouped-product-list-item__label label a'
				),
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'product_listing_prices',
		'label'       => esc_html__( 'Product price on product listing page', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '15px',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#00a28e',
			'text-transform' => 'none',
			'text-align'     => 'left',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'ul.products .product .price',
                    '.woocommerce-grouped-product-list-item__price .amount'
				),
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'rating_color',
		'label'       => esc_html__( 'Ratings Color', 'dici' ),
		'description' => esc_attr__( 'Star ratings color on listing page', 'dici' ),
		'section'     => 'colors',
		'default'     => '#00d1b7',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => array(
					'.star-rating',
					'.comment-form-rating .stars a:before',
					'.comment-form-rating .stars:hover a:before',
					'.comment-form-rating .stars:visited a:before',
					'.comment-form-rating .stars:active a:before',
					'.comment-form-rating .stars.selected a.active:before'
				),
				'property' => 'color',
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'product_listing_button',
		'label'       => esc_html__( 'Add to cart button on product listing page', 'dici' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => 'normal',
			'font-size'      => '1em',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#ffffff',
			'text-transform' => 'none',
			'text-align'     => 'left',
            'subsets' => array( 'latin-ext' ),
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'.products > .product .add_to_cart_button',
                    'ul.products .product .button',
                    'ul.products .product .add_to_cart_button',
                    'ul.products .product .product_type_variable',
                    'ul.products .product .product_type_external'
				),
			),
		),
	) );
	// product listing typography end


// Typography End


// Header Layout Start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'logo_position',
		'label'       => esc_html__( 'Logo Position', 'dici' ),
		'description' => esc_attr__( 'Select how you want to position your logo, left, right or centered' , 'dici' ),
		'section'     => 'header',
		'default'     => 'center',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/logo_l.jpg',
			'right'  => get_template_directory_uri() . '/assets/img/logo_r.jpg',
			'center' => get_template_directory_uri() . '/assets/img/logo_c.jpg',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'menu_alignment',
		'label'       => esc_html__( 'Menu Items Alignment', 'dici' ),
		'description' => esc_attr__( 'Select how you want to align main menu items, left, right or centered' , 'dici' ),
		'section'     => 'header',
		'default'     => 'center',
		'priority'    => 3,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/text-l.svg',
			'right'  => get_template_directory_uri() . '/assets/img/text-r.svg',
			'center' => get_template_directory_uri() . '/assets/img/text-c.svg',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'top_header_widget_area',
		'label'       => esc_html__( 'Top Header widget area', 'dici' ),
		'description' => esc_attr__( 'Enable or disable Top Header widget area.', 'dici' ),
		'section'     => 'header',
		'default'     => 'enabled',
		'priority'    => 5,
		'choices'     => array(
			'enabled'  => esc_attr__( 'Enabled', 'dici' ),
			'disabled'   => esc_attr__( 'Disables', 'dici' ),
		),
	) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'top_header_background_color',
		'label'       => esc_html__( 'Top Header Background', 'dici' ),
		'description' => esc_attr__( 'Top Header Background color.', 'dici' ),
		'section'     => 'header',
		'priority'    => 5,
		'active_callback' => array(
			array(
				'setting' => 'top_header_widget_area',
				'operator' => '==',
				'value' => true,
			)
		),
		'default'     => '#45cfbe',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => '.top-header-container',
				'property' => 'background-color',
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'top_header_text_color',
		'label'       => esc_html__( 'Top Header Color', 'dici' ),
		'description' => esc_attr__( 'Top Header text color.', 'dici' ),
		'section'     => 'header',
		'priority'    => 5,
		'default'     => '#ffffff',
		'active_callback' => array(
			array(
				'setting' => 'top_header_widget_area',
				'operator' => '==',
				'value' => true,
			)
		),
		'output'   => array(
			array(
				'element'  => '.top-header-container .top-header-inner',
				'property' => 'color',
			),
		),
	) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'pre_header_widget_area',
		'label'       => esc_html__( 'Pre Logo widget area', 'dici' ),
		'description' => esc_attr__( 'Enable or disable Pre Logo widget area.', 'dici' ),
		'section'     => 'header',
		'default'     => 'enabled',
		'priority'    => 5,
		'choices'     => array(
			'enabled'  => esc_attr__( 'Enabled', 'dici' ),
			'disabled'   => esc_attr__( 'Disabled', 'dici' ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'post_header_widget_area',
		'label'       => esc_html__( 'Post Logo widget area', 'dici' ),
		'description' => esc_attr__( 'Enable or disable Post Logo widget area.', 'dici' ),
		'section'     => 'header',
		'default'     => 'enabled',
		'priority'    => 6,
		'choices'     => array(
			'enabled'  => esc_attr__( 'Enabled', 'dici' ),
			'disabled'   => esc_attr__( 'Disabled', 'dici' ),
		),
	) );

	/*DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'sticky_header',
		'label'       => esc_html__( 'Sticky Header', 'dici' ),
		'description' => esc_attr__( 'Enable or disable sticky header', 'dici' ),
		'section'     => 'header',
		'default'     => 'disabled',
		'priority'    => 7,
		'choices'     => array(
			'enabled'  => esc_attr__( 'Enabled', 'dici' ),
			'disabled'   => esc_attr__( 'Disabled', 'dici' ),
		),
	) );*/

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'header_elementor',
		'label'       => esc_html__( 'Elementor Header', 'dici' ),
		'description' => esc_attr__( 'Enable or disable Elementor template to show instead of default WordPress header', 'dici' ),
		'section'     => 'header',
		'default'     => true,
		'priority'    => 7,
		'choices'     => array(
			'enabled'  => esc_attr__( 'Enabled', 'dici' ),
			'disabled'   => esc_attr__( 'Disabled', 'dici' ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'header_elementor_home',
		'label'       => esc_html__( 'Set different header for home page', 'dici' ),
		'description' => esc_attr__( 'Enable if you wish to set a custom header for home page.', 'dici' ),
		'section'     => 'header',
		'default'     => 'enabled',
		'priority'    => 8,
		'choices'     => array(
			'enabled'  => esc_attr__( 'Enabled', 'dici' ),
			'disabled'   => esc_attr__( 'Disabled', 'dici' ),
		),
		'active_callback' => array(
			array(
				'setting' => 'header_elementor',
				'operator' => '==',
				'value' => true,
			)
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'select',
		'settings'    => 'header_elementor_home_id',
		'label'       => esc_html__( 'Available Headers', 'dici' ),
		'section'     => 'header',
		'default'     => '',
		'active_callback' => array(
			array(
				'setting' => 'header_elementor_home',
				'operator' => '==',
				'value' => true,
			)
		),
		'choices'     => DiCi_Controller::get_available_headers(),
	) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'color',
        'settings'    => 'mobile_header_widget_content',
        'label'       => esc_html__( 'Mobile Header Widgets Color', 'dici' ),
        'description' => esc_attr__( 'Color for content in .mobile header if applicable.', 'dici' ),
        'section'     => 'header',
        'default'     => '#000000',
        'choices'     => array(
            'alpha' => true,
        ),
        'output'   => array(
            array(
                'element'  => [
                    '.dici-mobile .site-header-cart .cart-contents:before',
                    '.dici-mobile .wishlist_products_counter_text:before',
                    '.dici-mobile .elementor-widget-wp-widget-widget_top_wishlist .wishlist_products_counter_text:before'
                    ],
                'property' => 'color',
            ),
        ),
    ) );

// Header Layout End

// Sidebar Layout Start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'blog_page_layout',
		'label'       => esc_html__( 'Blog Page Sidebar Position', 'dici' ),
		'description' => esc_attr__('Select how you want to position your sidebar, left, right or no sidebar on the blog page' , 'dici' ),
		'section'     => 'layout',
		'default'     => 'right',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/two-col-left.png',
			'right'  => get_template_directory_uri() . '/assets/img/two-col-right.png',
			'no'     => get_template_directory_uri() . '/assets/img/one-col.png',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'post_page_layout',
		'label'       => esc_html__( 'Single Post Sidebar Position', 'dici' ),
		'description' => esc_attr__('Select how you want to position your sidebar, left, right or no sidebar on the post page' , 'dici' ),
		'section'     => 'layout',
		'default'     => 'right',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/two-col-left.png',
			'right'  => get_template_directory_uri() . '/assets/img/two-col-right.png',
			'no'     => get_template_directory_uri() . '/assets/img/one-col.png',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'search_page_layout',
		'label'       => esc_html__( 'Search Results Page Sidebar Position', 'dici' ),
		'description' => esc_attr__('Select how you want to position your sidebar, left, right or no sidebar on the search page' , 'dici'),
		'section'     => 'layout',
		'default'     => 'right',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/two-col-left.png',
			'right'  => get_template_directory_uri() . '/assets/img/two-col-right.png',
			'no'     => get_template_directory_uri() . '/assets/img/one-col.png',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'static_page_layout',
		'label'       => esc_html__( 'Static Page Sidebar Position', 'dici' ),
		'description' => esc_attr__('Select how you want to position your sidebar, left, right or no sidebar on the static page' , 'dici'),
		'section'     => 'layout',
		'default'     => 'no',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/two-col-left.png',
			'right'  => get_template_directory_uri() . '/assets/img/two-col-right.png',
			'no'     => get_template_directory_uri() . '/assets/img/one-col.png',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'shop_page_layout',
		'label'       => esc_html__( 'Shop Page Sidebar Position', 'dici' ),
		'description' => esc_attr__('Select how you want to position your sidebar, left, right or no sidebar on the shop page', 'dici'),
		'section'     => 'layout',
		'default'     => 'left',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/two-col-left.png',
			'right'  => get_template_directory_uri() . '/assets/img/two-col-right.png',
			'no'     => get_template_directory_uri() . '/assets/img/one-col.png',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'cart_page_layout',
		'label'       => esc_html__( 'Cart Page Sidebar Position', 'dici' ),
		'description' => esc_attr__('Select how you want to position your sidebar, left, right or no sidebar on the cart page', 'dici'),
		'section'     => 'layout',
		'default'     => 'no',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/two-col-left.png',
			'right'  => get_template_directory_uri() . '/assets/img/two-col-right.png',
			'no'     => get_template_directory_uri() . '/assets/img/one-col.png',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'checkout_page_layout',
		'label'       => esc_html__( 'Checkout Page Sidebar Position', 'dici' ),
		'description' => esc_attr__('Select how you want to position your sidebar, left, right or no sidebar on the checkout page', 'dici'),
		'section'     => 'layout',
		'default'     => 'no',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/two-col-left.png',
			'right'  => get_template_directory_uri() . '/assets/img/two-col-right.png',
			'no'     => get_template_directory_uri() . '/assets/img/one-col.png',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'product_page_layout',
		'label'       => esc_html__( 'Product Page Sidebar Position', 'dici' ),
		'description' => esc_attr__('Select how you want to position your sidebar, left, right or no sidebar on the product page', 'dici'),
		'section'     => 'layout',
		'default'     => 'no',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/two-col-left.png',
			'right'  => get_template_directory_uri() . '/assets/img/two-col-right.png',
			'no'     => get_template_directory_uri() . '/assets/img/one-col.png',
		),
	) );


// Sidebar Layout End

// Footer Layout Start

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'footer_sidebar',
		'label'       => esc_html__( 'Show / Hide Footer Sidebar Section', 'dici' ),
		'description' => esc_attr__( 'Show or Hide Footer Sidebar Section (Once disabled widgets will be removed from the sidebar)', 'dici' ),
		'section'     => 'footer',
		'default'     => 'on',
		'priority'    => 1,
		'choices'     => array(
			'on'  => esc_attr__( 'Show', 'dici' ),
			'off' => esc_attr__( 'Hide', 'dici' ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'footer_sign',
		'label'       => esc_html__( 'Show / Hide Footer Signature', 'dici' ),
		'description' => esc_attr__( 'Show or Hide Footer Signature', 'dici' ),
		'section'     => 'footer',
		'default'     => false,
		'priority'    => 1,
		'choices'     => array(
			'on'  => esc_attr__( 'Hide', 'dici' ),
			'off' => esc_attr__( 'Show', 'dici' ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'switch',
		'settings'    => 'footer_elementor',
		'label'       => esc_html__( 'Enable / Disable Footer Elementor Section', 'dici' ),
		'description' => esc_attr__( 'Enable or disable Footer Elementor Section in your footer, allows to show elementor templates in footer', 'dici' ),
		'section'     => 'footer',
		'active_callback' => 'ThemesZone_Theme_Helper::elementor_installed',
		'default'     => true,
		'priority'    => 1,
		'choices'     => array(
			'on'  => esc_attr__( 'Enable', 'dici' ),
			'off' => esc_attr__( 'Disable', 'dici' ),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'footer_sidebar_background_color',
		'label'       => esc_html__( 'Links color', 'dici' ),
		'description' => esc_attr__( 'Color for links site-wide.', 'dici' ),
		'section'     => 'footer',
		'default'     => '#ffffff',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => 'dici-footer-widget-area',
				'property' => 'background-color',
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'     => 'textarea',
		'settings' => 'footer_copyright_text',
		'label'    => esc_html__( 'Footer Copyright Text', 'dici' ),
		'section'  => 'footer',
		'default'  => '',
		'priority' => 10,
	) );

// Footer Layout End

// Blog Layout Start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio',
		'settings'    => 'blog_posts_layout',
		'label'       => esc_html__( 'Blog Posts View', 'dici' ),
		'description' => esc_attr__('Select how you want your blog posts to be displayed, list or grid view.', 'dici'),
		'section'     => 'blog',
		'default'     => 'list',
		'priority'    => 1,
		'choices'     => array(
			'list'   => array(
				esc_attr__( 'List', 'dici' ),
				esc_attr__( 'Blog posts will follow one another as a list of posts', 'dici' ),
			),
			'grid' => array(
				esc_attr__( 'Grid', 'dici' ),
				esc_attr__( 'Blog posts will be laid out in a grid manner', 'dici' ),
			),
		),
	) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'radio',
        'settings'    => 'blog_posts_style',
        'label'       => esc_html__( 'Blog Posts Style', 'dici' ),
        'description' => esc_attr__('Select how you want your blog posts to be displayed, list or grid view.', 'dici'),
        'section'     => 'blog',
        'default'     => 'classy',
        'priority'    => 1,
        'choices'     => array(
            'simple'   => array(
                esc_attr__( 'Simple', 'dici' ),
                esc_attr__( 'Simple, clean blog post view.', 'dici' ),
            ),
            'decorated' => array(
                esc_attr__( 'Decorated', 'dici' ),
                esc_attr__( 'Decorated blog post view', 'dici' ),
            ),
            'classy' => array(
                esc_attr__( 'Classy', 'dici' ),
                esc_attr__( 'Classic blog post view', 'dici' ),
            ),
        ),
    ) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'radio-image',
        'settings'    => 'blog_post_heading_align',
        'label'       => esc_html__( 'Blog posts heading alignment', 'dici' ),
        'description' => esc_attr__( 'Set heading alignment on the blog posts' , 'dici' ),
        'section'     => 'blog',
        'default'     => 'left',
        'priority'    => 1,
        'choices'     => array(
            'left'   => get_template_directory_uri() . '/assets/img/text-l.svg',
            'right'  => get_template_directory_uri() . '/assets/img/text-r.svg',
            'center' => get_template_directory_uri() . '/assets/img/text-c.svg',
        ),
    ) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'blog_post_content_align',
		'label'       => esc_html__( 'Blog posts content alignment', 'dici' ),
		'description' => esc_attr__( 'Set content alignment on the blog posts' , 'dici' ),
		'section'     => 'blog',
		'default'     => 'left',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/text-l.svg',
			'right'  => get_template_directory_uri() . '/assets/img/text-r.svg',
			'center' => get_template_directory_uri() . '/assets/img/text-c.svg',
		),
	) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'number',
		'settings'    => 'posts_per_row',
		'label'       => esc_html__( 'Set the number of posts per row', 'dici' ),
		'description' => esc_attr__( 'Set the number of posts you want to show per row for posts grid view', 'dici' ),
		'section'     => 'blog',
		'active_callback' => array(
			array(
				'setting' => 'blog_posts_layout',
				'operator' => '==',
				'value' =>  'grid',
			)
		),
		'default'     => 2,
		'priority'    => 2,
		'choices'     => array(
			'min'  => 2,
			'max'  => 4,
			'step' => 1,
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio',
		'settings'    => 'blog_grid_layout',
		'label'       => esc_html__( 'Blog Grid View', 'dici' ),
		'description' => esc_attr__('Select how you want your blog posts to be displayed in grid view, masonry or fit a row.', 'dici' ),
		'section'     => 'blog',
		'default'     => 'masonry',
		'priority'    => 3,
		'active_callback' => array(
			array(
				'setting' => 'blog_posts_layout',
				'operator' => '==',
				'value' =>  'grid',
			)
		),
		'choices'     => array(
			'masonry'   => array(
				esc_html__( 'Masonry', 'dici' ),
                esc_html__( 'Blog will be placed by shuffle script in masonry layout', 'dici' ),
			),
			'simple' => array(
                esc_html__( 'Simple', 'dici' ),
                esc_html__( 'Blog posts will be laid out in a grid manner fitting the row', 'dici' ),
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio',
		'settings'    => 'blog_pagination',
		'label'       => esc_html__( 'Blog Navigation Style', 'dici' ),
		'description' => esc_attr__('Select the type of navigation on blog page, paginated or newer/older posts links.', 'dici' ),
		'section'     => 'blog',
		'default'     => 'paginated',
		'priority'    => 3,
		'choices'     => array(
			'paginated'   => array(
                esc_html__( 'Paginated', 'dici' ),
                esc_html__( 'Linked page numbers.', 'dici' ),
			),
			'linked' => array(
                esc_html__( 'Linked', 'dici' ),
                esc_html__( 'Newer and Older posts links', 'dici' ),
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'image',
		'settings'    => 'blog_page_banner',
		'label'       => esc_html__( 'Blog Page Banner', 'dici' ),
		'description' => esc_attr__( 'Set a banner that appears on blog page.', 'dici' ),
		'section'     => 'blog',
		'default'     => '',
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

// Blog Layout End

// Post Layout Start

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'radio-image',
        'settings'    => 'post_heading_align',
        'label'       => esc_html__( 'Posts heading alignment', 'dici' ),
        'description' => esc_attr__( 'Set heading alignment on the single posts' , 'dici' ),
        'section'     => 'post',
        'default'     => 'left',
        'priority'    => 1,
        'choices'     => array(
            'left'   => get_template_directory_uri() . '/assets/img/text-l.svg',
            'right'  => get_template_directory_uri() . '/assets/img/text-r.svg',
            'center' => get_template_directory_uri() . '/assets/img/text-c.svg',
        ),
    ) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'radio-image',
        'settings'    => 'post_content_align',
        'label'       => esc_html__( 'Posts content alignment', 'dici' ),
        'description' => esc_attr__( 'Set content alignment on the single posts' , 'dici' ),
        'section'     => 'post',
        'default'     => 'left',
        'priority'    => 1,
        'choices'     => array(
            'left'   => get_template_directory_uri() . '/assets/img/text-l.svg',
            'right'  => get_template_directory_uri() . '/assets/img/text-r.svg',
            'center' => get_template_directory_uri() . '/assets/img/text-c.svg',
        ),
    ) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'radio',
        'settings'    => 'post_layout',
        'label'       => esc_html__( 'Single Posts Style', 'dici' ),
        'description' => esc_attr__('Select the design of your single post page', 'dici'),
        'section'     => 'post',
        'default'     => 'modern',
        'priority'    => 1,
        'choices'     => array(
            'simple'   => array(
                esc_html__( 'Simple', 'dici' ),
                esc_html__( 'Simple, clean blog post view.', 'dici' ),
            ),
            'modern' => array(
                esc_html__( 'Modern', 'dici' ),
                esc_html__( 'Modern blog post view', 'dici' ),
            ),
        ),
    ) );

// Post Layout End

// Shop Layout Start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'number',
		'settings'    => 'products_per_row',
		'label'       => esc_html__( 'Set the number of products per row', 'dici' ),
		'description' => esc_attr__( 'Set the number of products you want to show per row on a product listing page', 'dici' ),
		'section'     => 'shop',
		'default'     => 3,
		'choices'     => array(
			'min'  => 2,
			'max'  => 5,
			'step' => 1,
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'number',
		'settings'    => 'products_per_page',
		'label'       => esc_html__( 'Set the number of products per page', 'dici' ),
		'description' => esc_attr__( 'Set the number of products you want to show per page on a product listing page', 'dici' ),
		'section'     => 'shop',
		'default'     => 12
	) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'image',
		'settings'    => 'shop_page_banner',
		'label'       => esc_html__( 'Shop Page Banner', 'dici' ),
		'description' => esc_attr__( 'Set a banner that appears on shop page.', 'dici' ),
		'section'     => 'shop',
		'default'     => '',
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'product_content_align',
		'label'       => esc_html__( 'Product content alignment', 'dici' ),
		'description' => esc_attr__( 'Set content alignment for products on product listing page.' , 'dici' ),
		'section'     => 'shop',
		'default'     => 'center',
		'priority'    => 1,
		'choices'     => array(
			'left'   => get_template_directory_uri() . '/assets/img/text-l.svg',
			'right'  => get_template_directory_uri() . '/assets/img/text-r.svg',
			'center' => get_template_directory_uri() . '/assets/img/text-c.svg',
		),
	) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'switch',
        'settings'    => 'product_listing_rating',
        'label'       => esc_html__( 'Show / Hide product listing rating', 'dici' ),
        'description' => esc_attr__( 'Show or hide rating stars on product cards', 'dici' ),
        'section'     => 'shop',
        'default'     => 'off',
        'priority'    => 1,
        'choices'     => array(
            'on'  => esc_html__( 'Show', 'dici' ),
            'off' => esc_html__( 'Hide', 'dici' ),
        ),
    ) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'radio',
        'settings'    => 'product_listing_button_hover',
        'label'       => esc_html__( 'Show/Hide Buy button on product listing.', 'dici' ),
        'description' => esc_attr__( 'Choose if you want products button to be shown by default.', 'dici' ),
        'section'     => 'shop',
        'default'     => 'hide',
        'priority'    => 1,
        'choices'     => array(
            'show'  => esc_html__( 'Show', 'dici' ),
            'hide' => esc_html__( 'Hide', 'dici' ),
        ),
    ) );




// Shop Layout End

// Product Layout Start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'number',
		'settings'    => 'products_thumbnail_columns',
		'label'       => esc_html__( 'Set the number of thumbnail columns on a product page', 'dici' ),
		'description' => esc_attr__( 'Set the number of thumbnail columns you want to show per row on a single product page', 'dici' ),
		'section'     => 'product',
		'default'     => 3,
		'choices'     => array(
			'min'  => 2,
			'max'  => 4,
			'step' => 1,
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'number',
		'settings'    => 'related_products_per_page',
		'label'       => esc_html__( 'Set the number of related products on product page', 'dici' ),
		'description' => esc_attr__( 'Set the number of related products you want to show on a single product page', 'dici' ),
		'section'     => 'product',
		'default'     => 4,
		'choices'     => array(
			'min'  => 2,
			'max'  => 5,
			'step' => 1,
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'number',
		'settings'    => 'related_products_per_column',
		'label'       => esc_html__( 'Set the number of related products per column', 'dici' ),
		'description' => esc_attr__( 'Set the number of related products you want to show on a single product page', 'dici' ),
		'section'     => 'product',
		'default'     => 4,
		'choices'     => array(
			'min'  => 2,
			'max'  => 5,
			'step' => 1,
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'image',
		'settings'    => 'product_page_banner',
		'label'       => esc_html__( 'Product Page Banner', 'dici' ),
		'description' => esc_attr__( 'Set a banner that appears on product page.', 'dici' ),
		'section'     => 'product',
		'default'     => '',
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	// single product typography start
	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'single_product_title',
		'label'       => esc_html__( 'Single Product page title', 'dici' ),
		'section'     => 'product',
		'default'     => array(
			'font-family'    => 'Butler',
			'variant'        => '500',
			'font-size'      => '32px',
			'line-height'    => '1.3',
			'letter-spacing' => '0',
			'color'          => '#000000',
			'text-transform' => 'none',
			'text-align'     => 'left'
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'.single-product .product .summary .product_title',
				),
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'single_rating_color',
		'label'       => esc_html__( 'Single product ratings color', 'dici' ),
		'description' => esc_attr__( 'Star ratings color on products page', 'dici' ),
		'section'     => 'colors',
		'default'     => '#00d1b7',
		'choices'     => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => '.single-product .product .summary .star-rating',
				'property' => 'color',
			),
		),
	) );

	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'typography',
		'settings'    => 'single_product_price',
		'label'       => esc_html__( 'Single Product Price', 'dici' ),
		'section'     => 'product',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '1.25em',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'color'          => '#000000',
			'text-transform' => 'none',
			'text-align'     => 'left'
		),
		'priority'    => 5,
		'output'      => array(
			array(
				'element' => array(
					'.single-product .product .summary .price',
				),
			),
		),
	) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'color',
        'settings'    => 'single_product_add_to_cart_button',
        'label'       => esc_html__( 'Single Product Add to Cart button', 'dici' ),
        'description' => esc_attr__( 'Background color for add to cart button on single product page', 'dici' ),
        'section'     => 'colors',
        'default'     => '#000000',
        'output'   => array(
            array(
                'element'  => array(
                    '.single-product .product .summary .single_add_to_cart_button',
                    '.single-product .single-product-reviews .review-button-cont .button'
                ),
                'property' => 'background-color',
            ),
        ),
    ) );


	DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
		'type'        => 'color',
		'settings'    => 'add_to_cart_listings_background',
		'label'       => esc_html__( 'Add to Cart background color', 'dici' ),
		'description' => esc_attr__( 'Background color for add to cart button on product listing', 'dici' ),
		'section'     => 'colors',
		'default'     => '#000000',
		'output'   => array(
			array(
				'element'  => array(
					'ul.products .product .button',
                    'ul.products .product .add_to_cart_button',
                    'ul.products .product .product_type_variable',
                    'ul.products .product .product_type_external'
				),
				'property' => 'background-color',
			),
		),
	) );

    DiCi_Kirki_Customizer::add_field( 'dici_theme', array(
        'type'        => 'color',
        'settings'    => 'add_to_cart_listings_background_hover',
        'label'       => esc_html__( 'Add to Cart background hover color', 'dici' ),
        'description' => esc_attr__( 'Background hover color for add to cart button on product listing', 'dici' ),
        'section'     => 'colors',
        'default'     => '#00d1b7',
        'output'   => array(
            array(
                'element'  => array(
                    'ul.products .product .button:hover',
                    'ul.products .product .add_to_cart_button:hover',
                    'ul.products .product .product_type_variable:hover',
                    'ul.products .product .product_type_external:hover'
                ),
                'property' => 'background-color',
            ),
        ),
    ) );

	// single product typography end

// Product Layout End

endif; // DiCi_Kirki_Customizer Options End