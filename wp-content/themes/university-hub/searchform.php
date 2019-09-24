<div class="search-box-wrap">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'university-hub' ); ?></span>
			<input class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'university-hub' ); ?>" value="<?php echo get_search_query(); ?>" name="s" type="search">
		</label>
		<input class="search-submit" value="&#xf002;" type="submit">
	</form><!-- .search-form -->
</div><!-- .search-box-wrap -->
