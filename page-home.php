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

			?>

				<div id="home-hero" style="background-image: URL('<?php echo $hero_image['url']; ?>')">
					<div id="hero-content">
						<div id="home-logo">
							<img src="<?php echo $home_logo['url']; ?>" alt="<?php echo $home_logo['alt']; ?>">
						</div>
						<div id="home-subtitle">
							<h4><?php the_field('home_subtitle') ?></h4>
						</div>
						<button class="orange-btn">contact us</button>
					</div>

					<div id="scroll-down">
						<p>scroll down to find out more</p>
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/down-arrow.png">
					</div>
				</div>

	<?php endwhile; // end of the loop. ?>		

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<?php while ( have_posts() ) : the_post(); ?>
								<div id="home-about-image">
									<img src="<?php echo $home_content_image['url']; ?>" alt="<?php echo $home_content_image['alt']; ?>">
								</div>

								<p><?php the_content(); ?></p>

							<?php endwhile; // end of the loop. ?>					
						</main>
				</div>

			</div>


<?php get_footer(); ?>
