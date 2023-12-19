<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'dici' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Type to search', 'placeholder', 'dici' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<span class="shadow_for_search"></span>
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'dici' ); ?></span><i class="dici-icon-magnifying-glass"></i></button>
</form>
