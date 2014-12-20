<?php
/*
 Template Name: Home
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php 

			$hero_image = get_field('hero_image'); 
			$home_logo = get_field('home_logo');
			$home_content_image = get_field('home_content_image');

			?>

				<div id="home-hero" style="background-image: URL('<?php echo $hero_image['url']; ?>')">
					<div id="hero-content">
						<div id="home-logo">
							<img src="<?php echo $home_logo['url']; ?>" alt="<?php echo $home_logo['alt']; ?>">
						</div>
							<h4 id="home-subtitle"><?php the_field('home_subtitle') ?></h4>
							<a href="<?php echo get_page_link(4); ?>" class="orange-btn button">
								contact us
							</a>
					</div>

					<div id="scroll-down">
						<p>scroll down to find out more</p>
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/down-arrow.png">
					</div>
				</div>

	<?php endwhile; // end of the loop. ?>		

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="hentry cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<?php while ( have_posts() ) : the_post(); ?>
								<div id="home-content-title">
									<h1 class="page-title"><?php the_field('home_content_title')?></h1>
								</div>

								<div id="home-about-image" style="background-image: URL('<?php echo $home_content_image['url']; ?>')"></div>

								<p><?php the_content(); ?></p>

							<?php endwhile; // end of the loop. ?>

							<div id="home-cta">
								<a href="<?php echo get_page_link(8); ?>" class="orange-btn button">
									see units for sale
								</a>
								<a href="<?php echo get_page_link(4); ?>" class="orange-btn button">
									contact us
								</a>
							</div>

							<div id="home-map">
								<div id="map-latitude"><?php the_field('google_map_latitude') ?></div>
								<div id="map-longitude"><?php the_field('google_map_longitude') ?></div>
								<div id="map-canvas"></div>
							</div>
						</main>
				</div>

			</div>


<?php get_footer(); ?>
