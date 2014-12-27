<?php
/*
 Template Name: Images
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

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content cf" itemprop="articleBody">
								
										<?php	

									$images = get_field('images');
									if( $images ): ?>
										<section class='images-page-thumbs'>
											<?php foreach( $images as $image ): ?>
												<a href="<?php echo $image['url']; ?>" class="swipebox image-thumb">
		                     <img src="<?php echo $image['sizes']['bones-thumb-300']; ?>" alt="<?php echo $image['alt']; ?>" />
				                </a>
				              <?php endforeach; ?>
										</section>
										<section class='image-full-frame'></section>
										<section class='image-full-nav'>
											<img src="<?php echo get_template_directory_uri(); ?>/library/images/back.png" class="full-back-nav">
											<img src="<?php echo get_template_directory_uri(); ?>/library/images/forward.png" class="full-forward-nav">
										</section>
									<?php endif; ?>

								</section>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

				</div>

			</div>


<?php get_footer(); ?>
