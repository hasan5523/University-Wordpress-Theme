<?php
/**
 * Template part for displaying home latest news section.
 *
 * @package University_Hub
 */

$latest_news_title          = university_hub_get_option( 'latest_news_title' );
$latest_news_layout         = university_hub_get_option( 'latest_news_layout' );
$latest_news_number         = university_hub_get_option( 'latest_news_number' );
$latest_news_column         = university_hub_get_option( 'latest_news_column' );
$latest_news_category       = university_hub_get_option( 'latest_news_category' );
$latest_news_featured_image = university_hub_get_option( 'latest_news_featured_image' );
$latest_news_excerpt_length = university_hub_get_option( 'latest_news_excerpt_length' );
?>

<div id="latest-news" class="home-section-latest-news">
	<div class="container">

		<h2 class="section-title"><?php echo esc_html( $latest_news_title ); ?></h2>
		<?php
		$qargs = array(
			'posts_per_page'      => absint( $latest_news_number ),
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
			);

		if ( absint( $latest_news_category ) > 0 ) {
			$qargs['cat'] = absint( $latest_news_category );
		}

		// Fetch posts.
		$the_query = new WP_Query( $qargs );
		?>

		<?php if ( $the_query->have_posts() ) : ?>
			<div class="inner-wrapper latest-news-wrapper latest-news-col-<?php echo absint( $latest_news_column ); ?> latest-news-layout-<?php echo absint( $latest_news_layout ); ?>">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="latest-news-item">
						<div class="latest-news-inner-wrapper">
							<div class="latest-news-thumb">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( esc_attr( $latest_news_featured_image ), array( 'class' => 'aligncenter' ) ); ?></a>
								<?php endif; ?>
								<div class="read-more-button">
									<a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Learn More', 'university-hub' ); ?></a>
								</div>
							</div><!-- .latest-news-thumb -->
							<div class="latest-news-text-wrap">
								<h3 class="latest-news-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3><!-- .latest-news-title -->
								<div class="latest-news-meta">
									<span class="posted-on"><a href="<?php the_permalink(); ?>"><?php the_time( _x( 'j M Y', 'date format', 'university-hub' ) ); ?></a></span>
									<?php university_hub_the_term_link_single( 'category', '<span class="cat-links">', '</span>' ); ?>
									<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
										<span class="comments-link">
											<?php comments_popup_link( esc_html__( '0 comments', 'university-hub' ), esc_html__( '1 Comment', 'university-hub' ), esc_html__( '% Comments', 'university-hub' ) ); ?>
										</span>
									<?php endif; ?>
								</div><!-- .latest-news-meta -->
								<?php
								$excerpt = university_hub_the_excerpt( absint( $latest_news_excerpt_length ) );
								if ( $excerpt ) {
									echo wp_kses_post( wpautop( $excerpt ) );
								}
								?>
							</div><!-- .latest-news-text-wrap -->
						</div> <!-- .latest-news-inner-wrap -->
					</div><!-- .latest-news-item -->
				<?php endwhile; ?>
			</div><!-- .latest-news-wrapper -->
			<?php wp_reset_postdata(); ?>

		<?php endif; ?>
	</div><!-- .container -->
</div><!-- .home-section-team -->
