<?php
/**
 * Template part for displaying home news and events section.
 *
 * @package University_Hub
 */

?>
<?php
$news_and_events_ntitle    = university_hub_get_option( 'news_and_events_ntitle' );
$news_and_events_nnumber   = university_hub_get_option( 'news_and_events_nnumber' );
$news_and_events_ncategory = university_hub_get_option( 'news_and_events_ncategory' );
$news_and_events_etitle    = university_hub_get_option( 'news_and_events_etitle' );
$news_and_events_enumber   = university_hub_get_option( 'news_and_events_enumber' );
$news_and_events_ecategory = university_hub_get_option( 'news_and_events_ecategory' );
?>
<div id="university-hub-news-and-events" class="home-section-news-and-events">
	<div class="container">
		<div class="inner-wrapper">
			<div class="recent-news">
				<h2><?php echo esc_html( $news_and_events_ntitle ); ?></h2>
				<?php
				$qargs = array(
					'posts_per_page'      => absint( $news_and_events_nnumber ),
					'no_found_rows'       => true,
					'ignore_sticky_posts' => true,
					);

				if ( absint( $news_and_events_ncategory ) > 0 ) {
					$qargs['cat'] = absint( $news_and_events_ncategory );
				}

				// Fetch posts.
				$the_query = new WP_Query( $qargs );
				?>

				<?php if ( $the_query->have_posts() ) : ?>
					<div class="inner-wrapper">

						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<div class="news-post">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'university-hub-thumb', array( 'class' => 'aligncenter' ) ); ?></a>
								<?php endif; ?>

								<div class="news-content">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="block-meta">
										<span class="posted-on"><a href="<?php the_permalink(); ?>"><?php the_time( _x( 'F d, Y', 'date format', 'university-hub' ) ); ?></a></span>
										<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
											<span class="comments-link">
												<?php comments_popup_link( esc_html__( '0 comments', 'university-hub' ), esc_html__( '1 Comment', 'university-hub' ), esc_html__( '% Comments', 'university-hub' ) ); ?>
											</span>
										<?php endif; ?>
									</div><!-- .block-meta -->
									<?php
									$excerpt = university_hub_the_excerpt( 20 );
									echo wp_kses_post( wpautop( $excerpt ) );
									?>
								</div><!-- .news-content -->

							</div><!-- .news-post -->
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div><!-- .inner-wrapper -->

				<?php endif; ?>

			</div><!-- .recent-news -->
			<div class="recent-events">
				<h2><?php echo esc_html( $news_and_events_etitle ); ?></h2>
				<?php
				$qargs = array(
					'posts_per_page'      => absint( $news_and_events_enumber ),
					'no_found_rows'       => true,
					'ignore_sticky_posts' => true,
					);

				if ( absint( $news_and_events_ecategory ) > 0 ) {
					$qargs['cat'] = absint( $news_and_events_ecategory );
				}

				// Fetch posts.
				$the_query = new WP_Query( $qargs );
				?>

				<?php if ( $the_query->have_posts() ) : ?>

						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<div class="event-post">
								<div class="custom-entry-date">
									<span class="entry-month"><?php the_time( _x( 'M', 'date format', 'university-hub' ) ); ?></span>
									<span class="entry-day"><?php the_time( _x( 'd', 'date format', 'university-hub' ) ); ?></span>
								</div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php
								$excerpt = university_hub_the_excerpt( 10 );
								echo wp_kses_post( wpautop( $excerpt ) );
								?>
							</div> <!-- .event-post -->

						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>


				<?php endif; ?>

			</div><!-- .recent-news -->

			</div> <!-- .inner-wrapper -->

		</div> <!-- .container -->
	</div><!-- .home-section-news-and-events -->
