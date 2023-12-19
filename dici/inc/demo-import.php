<?php

if ( ! function_exists('dici_ocdi_import_files' ) ) {
	function dici_ocdi_import_files()
	{
		return array(

            array(
                'import_file_name'             => 'Jewelry Shop',
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'dummy-data/demo6/dici-content.xml',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'dummy-data/demo6/dici-customizer.dat',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'dummy-data/demo6/dici-widgets.wie',
                'import_preview_image_url'     => 'http://dici.themes.zone/wp-content/uploads/2018/09/Diamond_City_Home_new.jpg',
                'import_notice'                => esc_html__( "The imges used for demo are licensed stock images and should not be used on published sites, please replace with your own.", 'dici' ),
            ),

			array(
				'import_file_name'             => 'Jewelry Boutique',
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'dummy-data/demo2/dici-content.xml',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'dummy-data/demo2/dici-customizer.dat',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'dummy-data/demo2/dici-widgets.wie',
				'import_preview_image_url'     => 'http://dici.themes.zone/wp-content/uploads/2018/09/demo_s2-1.png',
				'import_notice'                => esc_html__( "The imges used for demo are licensed stock images and should not be used on published sites, please replace with your own.", 'dici' ),
			),

			array(
				'import_file_name'             => 'Handmade Jewelry Artist',
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'dummy-data/demo3/dici-content.xml',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'dummy-data/demo3/dici-customizer.dat',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'dummy-data/demo3/dici-widgets.wie',
				'import_preview_image_url'     => 'http://dici.themes.zone/wp-content/uploads/2018/09/demo_s3-1.png',
				'import_notice'                => esc_html__( "The imges used for demo are licensed stock images and should not be used on published sites, please replace with your own.", 'dici' ),
			),

			array(
				'import_file_name'             => 'Jewelry Marketplace',
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'dummy-data/demo4/dici-content.xml',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'dummy-data/demo4/dici-customizer.dat',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'dummy-data/demo4/dici-widgets.wie',
				'import_preview_image_url'     => 'http://dici.themes.zone/wp-content/uploads/2018/09/demo_s4-1.png',
				'import_notice'                => esc_html__( "The imges used for demo are licensed stock images and should not be used on published sites, please replace with your own.", 'dici' ),
			),

			array(
				'import_file_name'             => 'Jewelry Designer',
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'dummy-data/demo5/dici-content.xml',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'dummy-data/demo5/dici-customizer.dat',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'dummy-data/demo5/dici-widgets.wie',
				'import_preview_image_url'     => 'http://dici.themes.zone/wp-content/uploads/2018/09/demo_s5-1.png',
				'import_notice'                => esc_html__( "The imges used for demo are licensed stock images and should not be used on published sites, please replace with your own.", 'dici' ),
			),

            array(
                'import_file_name'             => 'Local Boutique',
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'dummy-data/demo1/dici-content.xml',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'dummy-data/demo1/dici-customizer.dat',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'dummy-data/demo1/dici-widgets.wie',
                'import_preview_image_url'     => 'http://dici.themes.zone/wp-content/uploads/2018/09/demo_s1-1.png',
                'import_notice'                => esc_html__( "The imges used for demo are licensed stock images and should not be used on published sites, please replace with your own.", 'dici' ),
            ),


		);
	}
}

add_filter( 'pt-ocdi/import_files', 'dici_ocdi_import_files' );

/* Disable thumbs regeneration for faster installation */
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

function dici_change_time_of_single_ajax_call() {
	return 20;
}
add_action( 'pt-ocdi/time_for_one_ajax_call', 'dici_change_time_of_single_ajax_call' );

/* New Intro text for Data Installer */
function chromium_intro_text( $default_text ) {
	$default_text .= '
		<div class="ocdi__intro-text">
				<p>'.esc_html__('PHP Requirements', 'dici').':</p>
				<ul>
					<li><strong>upload_max_filesize</strong> - 256M</li>
					<li><strong>max_input_time</strong> - 300</li>
					<li><strong>memory_limit</strong> - 512M</li>
					<li><strong>max_execution_time</strong> - 300</li>
					<li><strong>post_max_size</strong> - 512M</li>
				</ul>
				<p>'.esc_html__('You can always restore default values for PHP variables after installing sample data.','dici').'</p>
				<p><b>'.esc_html__('IMPORTANT', 'dici').'</b> '.esc_html__('Most of the images used for demo data are stock photos. If you wish to re-use those images on your live site please acquire a license. The list of resources is provided in the themes documentation.', 'dici').'</p>
				<p>
				<hr><b>'.esc_html__('IMPORTANT', 'dici').'</b> '.esc_html__('If your server does not have required resources to import Demo Data it will result in corrupted content, in this case you can import Demo Data manually though WordPress importer (Contact our Support if you don\'t know how to).', 'dici').'</p>
		</div>';
	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'chromium_intro_text' );

if ( ! function_exists( 'dici_after_import_setup' ) ) {

	function dici_after_import_setup( $selected_import ){

		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$social_menu = get_term_by( 'name', 'Payment Icons', 'nav_menu' );
		$footer_menu = get_term_by( 'name', 'Short', 'nav_menu' );
		$short_menu = get_term_by( 'name', 'Short', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
				'menu-main' => $main_menu->term_id,
				'primary' => $main_menu->term_id,
				'footer-menu' => $footer_menu->term_id,
				'social-menu' => $social_menu->term_id,
				'top-header-menu' => $short_menu->term_id
			)
		);

		// WooCurrency Options
		update_option( 'woocs_drop_down_view', 'no' );
		update_option( 'woocs_auto_switcher_basic_field', '__CODE__ __SIGN__' );

		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Home Page EN' );
		$blog_page_id  = get_page_by_title( 'Blog' );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

		// Elementor Options
		update_option('elementor_container_width', '1200');
		update_option('elementor_disable_color_schemes', 'yes');
		update_option('elementor_disable_typography_schemes', 'yes');

		// Update Woo Currency options
		if ( class_exists('WOOCS_STARTER') ) {
			update_option( 'woocs_drop_down_view', 'no' );
		}

		//Call Back Button
		update_option('vdz_call_back_widget_show_flag' ,'1');

		// Enable Yoast breadcrumbs
		if ( class_exists('WPSEO_Installation') ) {
			$seo_defaults = get_option('wpseo_titles');
			$seo_defaults['breadcrumbs-enable'] = true;
			update_option('wpseo_titles', $seo_defaults);
		}

		// Update woocommerce options
		if ( class_exists( 'WooCommerce' ) ) {
			$shop_page = get_page_by_title( 'Shop' );
			$cart_page = get_page_by_title( 'Cart' );
			$checkout_page = get_page_by_title( 'Checkout' );
			$my_account_page = get_page_by_title( 'My Account' );
			update_option( 'woocommerce_shop_page_id', $shop_page->ID );
			update_option( 'woocommerce_myaccount_page_id', $my_account_page->ID );
			update_option( 'woocommerce_cart_page_id', $cart_page->ID );
			update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
		}

		switch ( $selected_import['import_file_name'] ) {
            case 'Jewelry Shop': dici_main_setup(); break;
			case 'Jewelry Boutique': dici_simple_setup(); break;
			case 'Handmade Jewelry Artist': dici_storefront_setup(); break;
			case 'Jewelry Marketplace': dici_marketplace_setup(); break;
			case 'Jewelry Designer': dici_black_setup(); break;
            case 'Local Boutique': dici_localshop_setup(); break;
			default: break;
		}

	}

}

add_action( 'pt-ocdi/after_import', 'dici_after_import_setup' );

function dici_localshop_setup(){

	// Update megamenu options
	if ( class_exists( 'Mega_Menu' ) ) {
		$megamenu_dici_defaults = array (
			"prefix"=>"enabled",
			"descriptions"=>"enabled",
			"second_click"=>"close",
			"mobile_behaviour"=>"standard",
			"css"=>"fs",
			"unbind"=>"enabled",
			"menu-main"=>array(
				"enabled"=>"1",
				"event"=>"hover",
				"effect"=>"fade_up",
				"effect_speed"=>"200",
				"effect_mobile"=>"slide",
				"effect_speed_mobile"=>"200",
				"theme"=>"dici_localshop",
			),
			"instances"=>array(
				"menu-main"=>"0",
			),
		);
		update_option( 'megamenu_settings', $megamenu_dici_defaults );
	}

    /* Import Revolution Slider */
    if ( class_exists( 'RevSlider' ) ) {
        $filepath = get_template_directory() . '/dummy-data/demo1/slider.zip';
        $slider = new RevSlider();
        $slider->importSliderFromPost( true, true, $filepath );
    }

}

function dici_simple_setup(){

	// Update megamenu options
	if ( class_exists( 'Mega_Menu' ) ) {
		$megamenu_dici_defaults = array (
			"prefix"=>"enabled",
			"descriptions"=>"enabled",
			"second_click"=>"close",
			"mobile_behaviour"=>"standard",
			"css"=>"fs",
			"unbind"=>"enabled",
			"menu-main"=>array(
				"enabled"=>"1",
				"event"=>"hover",
				"effect"=>"fade_up",
				"effect_speed"=>"200",
				"effect_mobile"=>"slide",
				"effect_speed_mobile"=>"200",
				"theme"=>"dici_simple",
			),
			"instances"=>array(
				"menu-main"=>"0",
			),
		);
		update_option( 'megamenu_settings', $megamenu_dici_defaults );
	}

    /* Import Revolution Slider */
    if ( class_exists( 'RevSlider' ) ) {
        $filepath = get_template_directory() . '/dummy-data/demo2/slider.zip';
        $slider = new RevSlider();
        $slider->importSliderFromPost( true, true, $filepath );
    }

}

function dici_storefront_setup(){

    // Update megamenu options
    if ( class_exists( 'Mega_Menu' ) ) {
        $megamenu_dici_defaults = array (
            "prefix"=>"enabled",
            "descriptions"=>"enabled",
            "second_click"=>"close",
            "mobile_behaviour"=>"standard",
            "css"=>"fs",
            "unbind"=>"enabled",
            "menu-main"=>array(
                "enabled"=>"1",
                "event"=>"hover",
                "effect"=>"fade_up",
                "effect_speed"=>"200",
                "effect_mobile"=>"slide",
                "effect_speed_mobile"=>"200",
                "theme"=>"dici_localshop",
            ),
            "instances"=>array(
                "menu-main"=>"0",
            ),
        );
        update_option( 'megamenu_settings', $megamenu_dici_defaults );

    }

	/* Import Revolution Slider */
	if ( class_exists( 'RevSlider' ) ) {
		$filepath = get_template_directory() . '/dummy-data/demo3/slider.zip';
		$slider = new RevSlider();
		$slider->importSliderFromPost( true, true, $filepath );
	}

    // Elementor Options
    update_option('elementor_container_width', '1200');
    update_option('elementor_disable_color_schemes', 'yes');
    update_option('elementor_disable_typography_schemes', 'yes');

}

function dici_marketplace_setup(){

	// Update megamenu options
	if ( class_exists( 'Mega_Menu' ) ) {
		$megamenu_dici_defaults = array (
			"prefix"=>"enabled",
			"descriptions"=>"enabled",
			"second_click"=>"close",
			"mobile_behaviour"=>"standard",
			"css"=>"fs",
			"unbind"=>"enabled",
			"menu-main"=>array(
				"enabled"=>"1",
				"event"=>"hover",
				"effect"=>"fade_up",
				"effect_speed"=>"200",
				"effect_mobile"=>"slide",
				"effect_speed_mobile"=>"200",
				"theme"=>"dici_marketplace",
			),
			"instances"=>array(
				"menu-main"=>"0",
			),
		);
		update_option( 'megamenu_settings', $megamenu_dici_defaults );

	}

    /* Import Revolution Slider */
    if ( class_exists( 'RevSlider' ) ) {
        $filepath = get_template_directory() . '/dummy-data/demo4/slider.zip';
        $slider = new RevSlider();
        $slider->importSliderFromPost( true, true, $filepath );
    }

    // Elementor Options
    update_option('elementor_container_width', '1200');
    update_option('elementor_disable_color_schemes', 'yes');
    update_option('elementor_disable_typography_schemes', 'yes');

}

function dici_black_setup(){

    // Elementor Options
    update_option('elementor_container_width', '1200');
    update_option('elementor_disable_color_schemes', 'yes');
    update_option('elementor_disable_typography_schemes', 'yes');

}

function dici_main_setup(){

    // Update megamenu options
    if ( class_exists( 'Mega_Menu' ) ) {
        $megamenu_dici_defaults = array (
            "prefix"=>"enabled",
            "descriptions"=>"enabled",
            "second_click"=>"close",
            "mobile_behaviour"=>"standard",
            "css"=>"fs",
            "unbind"=>"enabled",
            "menu-main"=>array(
                "enabled"=>"1",
                "event"=>"hover",
                "effect"=>"fade_up",
                "effect_speed"=>"200",
                "effect_mobile"=>"slide",
                "effect_speed_mobile"=>"200",
                "theme"=>"dici_slim",
            ),
            "instances"=>array(
                "menu-main"=>"0",
            ),
        );
        update_option( 'megamenu_settings', $megamenu_dici_defaults );
    }

    /* Import Revolution Slider */
    if ( class_exists( 'RevSlider' ) ) {
        $filepath = get_template_directory() . '/dummy-data/demo6/slider.zip';
        $slider = new RevSlider();
        $slider->importSliderFromPost( true, true, $filepath );
    }

    // Elementor Options
    update_option('elementor_container_width', '1200');
    update_option('elementor_disable_color_schemes', 'yes');
    update_option('elementor_disable_typography_schemes', 'yes');

}

add_filter("megamenu_themes", "dici_import_menu_themes");


/* Menu Themes for Mega Menu */
if ( class_exists( 'Mega_Menu' ) ) :

	add_filter("megamenu_themes", "dici_import_menu_themes");

	function dici_import_menu_themes( $themes ){

		$themes["dici_localshop"] = array(
			'title' => 'DiCi - Main Menu (Jewelry Shop)',
			'container_background_from' => 'rgba(0, 0, 0, 0)',
			'container_background_to' => 'rgba(0, 0, 0, 0)',
			'container_padding_left' => '0',
			'container_padding_right' => '0',
			'arrow_up' => 'dash-f343',
			'arrow_down' => 'dash-f347',
			'arrow_left' => 'dash-f341',
			'arrow_right' => 'dash-f345',
			'menu_item_align' => 'center',
			'menu_item_background_hover_from' => 'rgba(0, 0, 0, 0)',
			'menu_item_background_hover_to' => 'rgba(0, 0, 0, 0)',
			'menu_item_link_font_size' => '15px',
			'menu_item_link_height' => '49px',
			'menu_item_link_color' => 'rgb(13, 13, 13)',
			'menu_item_link_weight' => 'inherit',
			'menu_item_link_text_align' => 'center',
			'menu_item_link_color_hover' => 'rgb(34, 34, 34)',
			'menu_item_link_weight_hover' => 'inherit',
			'menu_item_link_padding_left' => '15px',
			'menu_item_link_padding_right' => '15px',
			'menu_item_border_color' => 'rgba(0, 0, 0, 0)',
			'menu_item_border_color_hover' => 'rgba(0, 0, 0, 0)',
			'panel_background_from' => 'rgb(255, 255, 255)',
			'panel_background_to' => 'rgb(255, 255, 255)',
			'panel_header_border_color' => '#555',
			'panel_font_size' => '14px',
			'panel_font_color' => '#666',
			'panel_font_family' => 'inherit',
			'panel_second_level_font_color' => '#555',
			'panel_second_level_font_color_hover' => '#555',
			'panel_second_level_text_transform' => 'uppercase',
			'panel_second_level_font' => 'inherit',
			'panel_second_level_font_size' => '16px',
			'panel_second_level_font_weight' => 'bold',
			'panel_second_level_font_weight_hover' => 'bold',
			'panel_second_level_text_decoration' => 'none',
			'panel_second_level_text_decoration_hover' => 'none',
			'panel_second_level_border_color' => '#555',
			'panel_third_level_font_color' => '#666',
			'panel_third_level_font_color_hover' => '#666',
			'panel_third_level_font' => 'inherit',
			'panel_third_level_font_size' => '14px',
			'flyout_width' => 'auto',
			'flyout_menu_background_from' => 'rgb(255, 255, 255)',
			'flyout_menu_background_to' => 'rgb(255, 255, 255)',
			'flyout_link_padding_left' => '20px',
			'flyout_link_padding_right' => '20px',
			'flyout_link_padding_top' => '15px',
			'flyout_link_padding_bottom' => '15px',
			'flyout_link_weight' => 'inherit',
			'flyout_link_weight_hover' => 'inherit',
			'flyout_link_height' => '10px',
			'flyout_background_from' => 'rgb(255, 255, 255)',
			'flyout_background_to' => 'rgb(255, 255, 255)',
			'flyout_background_hover_from' => 'rgb(247, 247, 247)',
			'flyout_background_hover_to' => 'rgb(247, 247, 247)',
			'flyout_link_size' => '14px',
			'flyout_link_color' => 'rgb(13, 13, 13)',
			'flyout_link_color_hover' => 'rgb(13, 13, 13)',
			'flyout_link_family' => 'inherit',
			'responsive_breakpoint' => '768px',
			'shadow' => 'on',
			'shadow_horizontal' => '2px',
			'shadow_vertical' => '5px',
			'shadow_blur' => '8px',
			'mobile_columns' => '1',
			'toggle_background_from' => '#222',
			'toggle_background_to' => '#222',
			'toggle_font_color' => 'rgb(13, 13, 13)',
			'toggle_bar_height' => '49px',
			'mobile_background_from' => 'rgb(255, 255, 255)',
			'mobile_background_to' => 'rgb(255, 255, 255)',
			'mobile_menu_item_link_font_size' => '14px',
			'mobile_menu_item_link_color' => 'rgb(13, 13, 13)',
			'mobile_menu_item_link_text_align' => 'left',
			'mobile_menu_item_link_color_hover' => 'rgb(13, 13, 13)',
			'mobile_menu_item_background_hover_from' => 'rgb(255, 255, 255)',
			'mobile_menu_item_background_hover_to' => 'rgb(255, 255, 255)',
			'custom_css' => '/** Push menu onto new line **/ 
#{$wrap} { 
    clear: both; 
}

#{$wrap} #{$menu} > li.mega-menu-item{
	
    font-weight: 600;
}

#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link{
	font-weight: 600;
    position: relative;
}

#{$wrap} #{$menu} > li.mega-menu-item:hover > a.mega-menu-link{
	font-weight: 600;
}

#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link:before,
{
	position: absolute;
	right: 0;
	top: -5px;
	left: 0;
	display: block;
	width: 100%;
	height: 3px;
	opacity: 0;
	content: \'\';
	transition: opacity 400ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
	background-color: #79e9e0;
}

#{$wrap} #{$menu} > li.mega-menu-item:hover > a.mega-menu-link:before,
#{$wrap} #{$menu} > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link:before
{
	opacity:1;
}

#{$wrap} #{$menu} > li.mega-menu-item > ul.mega-sub-menu{
    right: auto !important;
    left:0 !important;
    font-weight:normal;
}
',
		);

		$themes["dici_simple"] = array(
			'title' => 'DiCi - Main Menu (Jewelry Boutique)',
			'container_background_from' => 'rgba(0, 0, 0, 0)',
			'container_background_to' => 'rgba(0, 0, 0, 0)',
			'container_padding_left' => '0',
			'container_padding_right' => '0',
			'arrow_up' => 'dash-f343',
			'arrow_down' => 'dash-f347',
			'arrow_left' => 'dash-f341',
			'arrow_right' => 'dash-f345',
			'menu_item_background_hover_from' => 'rgba(0, 0, 0, 0)',
			'menu_item_background_hover_to' => 'rgba(0, 0, 0, 0)',
			'menu_item_link_font_size' => '15px',
			'menu_item_link_height' => '49px',
			'menu_item_link_color' => 'rgb(13, 13, 13)',
			'menu_item_link_weight' => 'inherit',
			'menu_item_link_text_align' => 'center',
			'menu_item_link_color_hover' => 'rgb(34, 34, 34)',
			'menu_item_link_weight_hover' => 'inherit',
			'menu_item_link_padding_left' => '15px',
			'menu_item_link_padding_right' => '15px',
			'menu_item_border_color' => 'rgba(0, 0, 0, 0)',
			'menu_item_border_color_hover' => 'rgba(0, 0, 0, 0)',
			'panel_background_from' => 'rgb(255, 255, 255)',
			'panel_background_to' => 'rgb(255, 255, 255)',
			'panel_header_border_color' => '#555',
			'panel_font_size' => '14px',
			'panel_font_color' => '#666',
			'panel_font_family' => 'inherit',
			'panel_second_level_font_color' => '#555',
			'panel_second_level_font_color_hover' => '#555',
			'panel_second_level_text_transform' => 'uppercase',
			'panel_second_level_font' => 'inherit',
			'panel_second_level_font_size' => '16px',
			'panel_second_level_font_weight' => 'bold',
			'panel_second_level_font_weight_hover' => 'bold',
			'panel_second_level_text_decoration' => 'none',
			'panel_second_level_text_decoration_hover' => 'none',
			'panel_second_level_border_color' => '#555',
			'panel_third_level_font_color' => '#666',
			'panel_third_level_font_color_hover' => '#666',
			'panel_third_level_font' => 'inherit',
			'panel_third_level_font_size' => '14px',
			'flyout_width' => 'auto',
			'flyout_menu_background_from' => 'rgb(255, 255, 255)',
			'flyout_menu_background_to' => 'rgb(255, 255, 255)',
			'flyout_link_padding_left' => '20px',
			'flyout_link_padding_right' => '20px',
			'flyout_link_padding_top' => '15px',
			'flyout_link_padding_bottom' => '15px',
			'flyout_link_weight' => 'inherit',
			'flyout_link_weight_hover' => 'inherit',
			'flyout_link_height' => '10px',
			'flyout_background_from' => 'rgb(255, 255, 255)',
			'flyout_background_to' => 'rgb(255, 255, 255)',
			'flyout_background_hover_from' => 'rgb(247, 247, 247)',
			'flyout_background_hover_to' => 'rgb(247, 247, 247)',
			'flyout_link_size' => '14px',
			'flyout_link_color' => 'rgb(13, 13, 13)',
			'flyout_link_color_hover' => 'rgb(13, 13, 13)',
			'flyout_link_family' => 'inherit',
			'responsive_breakpoint' => '768px',
			'shadow' => 'on',
			'shadow_horizontal' => '2px',
			'shadow_vertical' => '5px',
			'shadow_blur' => '8px',
			'mobile_columns' => '1',
			'toggle_background_from' => '#222',
			'toggle_background_to' => '#222',
			'toggle_font_color' => 'rgb(13, 13, 13)',
			'toggle_bar_height' => '49px',
			'mobile_background_from' => 'rgb(255, 255, 255)',
			'mobile_background_to' => 'rgb(255, 255, 255)',
			'mobile_menu_item_link_font_size' => '14px',
			'mobile_menu_item_link_color' => 'rgb(13, 13, 13)',
			'mobile_menu_item_link_text_align' => 'left',
			'mobile_menu_item_link_color_hover' => 'rgb(13, 13, 13)',
			'mobile_menu_item_background_hover_from' => 'rgb(255, 255, 255)',
			'mobile_menu_item_background_hover_to' => 'rgb(255, 255, 255)',
			'custom_css' => '/** Push menu onto new line **/ 
#{$wrap} { 
    clear: both; 
}

#{$wrap} #{$menu} > li.mega-menu-item{
	
    font-weight: 600;
}

#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link{
	font-weight: 600;
    position: relative;
}

#{$wrap} #{$menu} > li.mega-menu-item:hover > a.mega-menu-link{
	font-weight: 600;
}

#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link:before{
	position: absolute;
	right: 0;
	top: auto;
    bottom: 0;
	left: 0;
	display: block;
	width: 100%;
	height: 3px;
	opacity: 0;
	content: \'\';
	transition: opacity 400ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
	background-color: #79e9e0;
}

#{$wrap} #{$menu} > li.mega-menu-item:hover > a.mega-menu-link:before,
#{$wrap} #{$menu} > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link:before
{
	opacity:1;
}

#{$wrap} #{$menu} > li.mega-menu-item > ul.mega-sub-menu{
    right: auto !important;
    left:0 !important;
    font-weight:normal;
}
',
		);

		$themes["dici_marketplace"] = array(
			'title' => 'DiCi - Main Menu (Jewelry Marketplace)',
			'container_background_from' => 'rgba(0, 0, 0, 0)',
			'container_background_to' => 'rgba(0, 0, 0, 0)',
			'container_padding_left' => '0',
			'container_padding_right' => '0',
			'arrow_up' => 'dash-f343',
			'arrow_down' => 'dash-f347',
			'arrow_left' => 'dash-f341',
			'arrow_right' => 'dash-f345',
			'menu_item_background_hover_from' => 'rgba(0, 0, 0, 0)',
			'menu_item_background_hover_to' => 'rgba(0, 0, 0, 0)',
			'menu_item_link_font_size' => '15px',
			'menu_item_link_height' => '49px',
			'menu_item_link_color' => 'rgb(13, 13, 13)',
			'menu_item_link_weight' => 'inherit',
			'menu_item_link_text_align' => 'center',
			'menu_item_link_color_hover' => 'rgb(34, 34, 34)',
			'menu_item_link_weight_hover' => 'inherit',
			'menu_item_link_padding_left' => '15px',
			'menu_item_link_padding_right' => '15px',
			'menu_item_border_color' => 'rgba(0, 0, 0, 0)',
			'menu_item_border_color_hover' => 'rgba(0, 0, 0, 0)',
			'panel_background_from' => 'rgb(255, 255, 255)',
			'panel_background_to' => 'rgb(255, 255, 255)',
			'panel_header_border_color' => '#555',
			'panel_font_size' => '14px',
			'panel_font_color' => '#666',
			'panel_font_family' => 'inherit',
			'panel_second_level_font_color' => '#555',
			'panel_second_level_font_color_hover' => '#555',
			'panel_second_level_text_transform' => 'uppercase',
			'panel_second_level_font' => 'inherit',
			'panel_second_level_font_size' => '16px',
			'panel_second_level_font_weight' => 'bold',
			'panel_second_level_font_weight_hover' => 'bold',
			'panel_second_level_text_decoration' => 'none',
			'panel_second_level_text_decoration_hover' => 'none',
			'panel_second_level_border_color' => '#555',
			'panel_third_level_font_color' => '#666',
			'panel_third_level_font_color_hover' => '#666',
			'panel_third_level_font' => 'inherit',
			'panel_third_level_font_size' => '14px',
			'flyout_width' => 'auto',
			'flyout_menu_background_from' => 'rgb(255, 255, 255)',
			'flyout_menu_background_to' => 'rgb(255, 255, 255)',
			'flyout_link_padding_left' => '20px',
			'flyout_link_padding_right' => '20px',
			'flyout_link_padding_top' => '15px',
			'flyout_link_padding_bottom' => '15px',
			'flyout_link_weight' => 'inherit',
			'flyout_link_weight_hover' => 'inherit',
			'flyout_link_height' => '10px',
			'flyout_background_from' => 'rgb(255, 255, 255)',
			'flyout_background_to' => 'rgb(255, 255, 255)',
			'flyout_background_hover_from' => 'rgb(247, 247, 247)',
			'flyout_background_hover_to' => 'rgb(247, 247, 247)',
			'flyout_link_size' => '14px',
			'flyout_link_color' => 'rgb(13, 13, 13)',
			'flyout_link_color_hover' => 'rgb(13, 13, 13)',
			'flyout_link_family' => 'inherit',
			'responsive_breakpoint' => '768px',
			'shadow' => 'on',
			'shadow_horizontal' => '2px',
			'shadow_vertical' => '5px',
			'shadow_blur' => '8px',
			'mobile_columns' => '1',
			'toggle_background_from' => '#222',
			'toggle_background_to' => '#222',
			'toggle_font_color' => 'rgb(13, 13, 13)',
			'toggle_bar_height' => '49px',
			'mobile_background_from' => 'rgb(255, 255, 255)',
			'mobile_background_to' => 'rgb(255, 255, 255)',
			'mobile_menu_item_link_font_size' => '14px',
			'mobile_menu_item_link_color' => 'rgb(13, 13, 13)',
			'mobile_menu_item_link_text_align' => 'left',
			'mobile_menu_item_link_color_hover' => 'rgb(13, 13, 13)',
			'mobile_menu_item_background_hover_from' => 'rgb(255, 255, 255)',
			'mobile_menu_item_background_hover_to' => 'rgb(255, 255, 255)',
			'custom_css' => '/** Push menu onto new line **/ 
#{$wrap} { 
    clear: both; 
}

#{$wrap} #{$menu} > li.mega-menu-item{
	
    font-weight: 600;
}

#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link{
	font-weight: 600;
    position: relative;
}

#{$wrap} #{$menu} > li.mega-menu-item:hover > a.mega-menu-link{
	font-weight: 600;
}

#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link:before,
{
	position: absolute;
	right: 0;
	top: -5px;
	left: 0;
	display: block;
	width: 100%;
	height: 3px;
	opacity: 0;
	content: \'\';
	transition: opacity 400ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
	background-color: #79e9e0;
}

#{$wrap} #{$menu} > li.mega-menu-item:hover > a.mega-menu-link:before,
#{$wrap} #{$menu} > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link:before
{
	opacity:1;
}

#{$wrap} #{$menu} > li.mega-menu-item > ul.mega-sub-menu{
    right: auto !important;
    left:0 !important;
    font-weight:normal;
}
',
		);

        $themes["dici_slim"] =
            array(
                'title' => 'DiCi - Main Menu Slim',
                'container_background_from' => 'rgba(0, 0, 0, 0)',
                'container_background_to' => 'rgba(0, 0, 0, 0)',
                'container_padding_left' => '0',
                'container_padding_right' => '0',
                'arrow_up' => 'dash-f343',
                'arrow_down' => 'dash-f347',
                'arrow_left' => 'dash-f341',
                'arrow_right' => 'dash-f345',
                'menu_item_align' => 'center',
                'menu_item_background_hover_from' => 'rgba(0, 0, 0, 0)',
                'menu_item_background_hover_to' => 'rgba(0, 0, 0, 0)',
                'menu_item_link_font_size' => '15px',
                'menu_item_link_height' => '49px',
                'menu_item_link_color' => 'rgb(13, 13, 13)',
                'menu_item_link_weight' => 'inherit',
                'menu_item_link_text_align' => 'center',
                'menu_item_link_color_hover' => 'rgb(34, 34, 34)',
                'menu_item_link_weight_hover' => 'inherit',
                'menu_item_link_padding_left' => '20px',
                'menu_item_link_padding_right' => '20px',
                'menu_item_border_color' => 'rgba(0, 0, 0, 0)',
                'menu_item_border_color_hover' => 'rgba(0, 0, 0, 0)',
                'panel_background_from' => 'rgb(255, 255, 255)',
                'panel_background_to' => 'rgb(255, 255, 255)',
                'panel_header_border_color' => '#555',
                'panel_font_size' => '14px',
                'panel_font_color' => '#666',
                'panel_font_family' => 'inherit',
                'panel_second_level_font_color' => '#555',
                'panel_second_level_font_color_hover' => '#555',
                'panel_second_level_text_transform' => 'uppercase',
                'panel_second_level_font' => 'inherit',
                'panel_second_level_font_size' => '16px',
                'panel_second_level_font_weight' => 'bold',
                'panel_second_level_font_weight_hover' => 'bold',
                'panel_second_level_text_decoration' => 'none',
                'panel_second_level_text_decoration_hover' => 'none',
                'panel_second_level_border_color' => '#555',
                'panel_third_level_font_color' => '#666',
                'panel_third_level_font_color_hover' => '#666',
                'panel_third_level_font' => 'inherit',
                'panel_third_level_font_size' => '14px',
                'flyout_width' => 'auto',
                'flyout_menu_background_from' => 'rgb(255, 255, 255)',
                'flyout_menu_background_to' => 'rgb(255, 255, 255)',
                'flyout_link_padding_left' => '20px',
                'flyout_link_padding_right' => '20px',
                'flyout_link_padding_top' => '15px',
                'flyout_link_padding_bottom' => '15px',
                'flyout_link_weight' => 'inherit',
                'flyout_link_weight_hover' => 'inherit',
                'flyout_link_height' => '10px',
                'flyout_background_from' => 'rgb(255, 255, 255)',
                'flyout_background_to' => 'rgb(255, 255, 255)',
                'flyout_background_hover_from' => 'rgb(247, 247, 247)',
                'flyout_background_hover_to' => 'rgb(247, 247, 247)',
                'flyout_link_size' => '14px',
                'flyout_link_color' => 'rgb(13, 13, 13)',
                'flyout_link_color_hover' => 'rgb(13, 13, 13)',
                'flyout_link_family' => 'inherit',
                'shadow' => 'on',
                'shadow_horizontal' => '-2px',
                'shadow_vertical' => '2px',
                'shadow_blur' => '25px',
                'shadow_spread' => '-8px',
                'shadow_color' => 'rgba(0, 0, 0, 0.25)',
                'toggle_background_from' => 'rgba(255, 255, 255, 0)',
                'toggle_background_to' => 'rgba(255, 255, 255, 0)',
                'toggle_bar_height' => '49px',
                'mobile_menu_overlay' => 'on',
                'mobile_menu_force_width' => 'on',
                'mobile_menu_force_width_selector' => 'body',
                'mobile_background_from' => 'rgb(255, 255, 255)',
                'mobile_background_to' => 'rgb(255, 255, 255)',
                'mobile_menu_item_link_font_size' => '16px',
                'mobile_menu_item_link_color' => 'rgb(13, 13, 13)',
                'mobile_menu_item_link_text_align' => 'left',
                'mobile_menu_item_link_color_hover' => 'rgb(13, 13, 13)',
                'mobile_menu_item_background_hover_from' => 'rgb(255, 255, 255)',
                'mobile_menu_item_background_hover_to' => 'rgb(255, 255, 255)',
                'custom_css' => '/** Push menu onto new line **/ 
#{$wrap} { 
    clear: both; 
}

#{$wrap} #{$menu} > li.mega-menu-item{
	
    font-weight: 500;
}

#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link{
	font-weight: 500;
    position: relative;
}

#{$wrap} #{$menu} > li.mega-menu-item:hover > a.mega-menu-link{
	font-weight: 500;
}

@include desktop{
	#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link:before,
	{
		position: absolute;
		right: 20px;
		top: -4px;
		left: 20px;
		display: block;
		width: calc(100% - 40px);
		height: 4px;
		opacity: 0;
		content: \'\';
		transition: opacity 400ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
		background: #7ee9e1; /* Old browsers */
		background: -moz-linear-gradient(left, #7ee9e1 0%, #44d0bf 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(left, #7ee9e1 0%,#44d0bf 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to right, #7ee9e1 0%,#44d0bf 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#7ee9e1\', endColorstr=\'#44d0bf\',GradientType=1 ); /* IE6-9 */
	}

	#{$wrap} #{$menu} > li.mega-menu-item:hover > a.mega-menu-link:before,
	#{$wrap} #{$menu} > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link:before
	{
		opacity:1;
	}
}
	
#{$wrap} #{$menu} > li.mega-menu-item > ul.mega-sub-menu{
    right: auto !important;
    left:0 !important;
    font-weight:normal;
}',
        );

		return $themes;

	}

endif;