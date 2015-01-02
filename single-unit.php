<?php
/*
 * CUSTOM POST TYPE TEMPLATE
 *
 * This is the custom post type post template. If you edit the post type name, you've got
 * to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is "register_post_type( 'bookmarks')",
 * then your single template should be single-bookmarks.php
 *
 * Be aware that you should rename 'custom_cat' and 'custom_tag' to the appropiate custom
 * category and taxonomy slugs, or this template will not finish to load properly.
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

								<header class="article-header">

									<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content cf">

								<div class="image-wrap"><section id="frame" class="unit-image-frame">
									<?php	

									$images = get_field('unit_images');

										if( $images ): ?>
		                     <img src="<?php echo $images[0]['sizes']['large']; ?>" alt="<?php echo $images[0]['alt']; ?>" class="unit-image-large" />
								</section></div>

								<section class='thumb-wrapper'>
											<?php foreach( $images as $image ): ?>
												<a href="#" rel="<?php echo $image['sizes']['large']; ?>" class="unit-image-thumb">
		                     <div class="image-wrap"><img src="<?php echo $image['sizes']['bones-thumb-300']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
				                </a>
				              <?php endforeach; ?>
										<?php endif; ?>
									<div class="clearfix"></div>
								</section>

								<section class="unit-stats">

										<ul>
											<li>Unit Type:</li>
											<li>Size:</li>
											<li>Price:</li>
										</ul>

										<ul class="bold">
											<li><?php the_terms($post->ID, 'bedrooms'); ?></li>
											<li><?php number_format(the_field('square_footage')); ?> sq. ft.</li>
											<li>$<?php the_field('price'); ?></li>
										</ul>

								</section>

								<section class="unit-description">
									<?php the_field('description_text'); ?>
								</section>

								<section class="cta">
									<a href="<?php echo get_page_link(4); ?>" class="orange-btn button unit-contact">
										contact us
									</a>

									<div id="other-units">
										<ul>
											<?php
												$query = new WP_Query( array( 'post_type' => 'unit' ) );

												while ( $query->have_posts() ) : $query->the_post();
													echo '<li><a href="';
													the_permalink();
													echo '" class = "gray-btn">';
													the_title();
													echo '</a></li>';
												endwhile; ?>
										</ul>
										<a href="#unit-other-units" id="unit-other-units" class="gray-btn button">other units</a>
									</div>
								</section>

							</article>

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

				</div>

			</div>

<?php get_footer(); ?>
