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

								<section class="unit-image-frame">
									<?php	

									$images = get_field('unit_images');

										if( $images ): ?>
											<?php foreach( $images as $image ): ?>
		                     <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="unit-image-large" />
				              <?php endforeach; ?>
			              
								</section>

								<section class='thumb-wrapper'>
											<?php foreach( $images as $image ): ?>
												<a href="#" rel="<?php echo $image['sizes']['large']; ?>" class="unit-image-thumb">
		                     <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
				                </a>
				              <?php endforeach; ?>
										<?php endif; ?>
									<div class="clearfix"></div>
								</section>

								<section class="unit-stats">

										<ul>
											<li>Unit Type: <span class="bold"><?php the_terms($post->ID, 'bedrooms'); ?></span></li>
											<li>Size: <span class="bold"><?php number_format(the_field('square_footage')); ?> sq. ft.</span></li>
											<li>Price: <span class="bold">$<?php the_field('price'); ?></span></li>
										</ul>

								</section>

								<section class="unit-description">
									<?php the_field('description_text'); ?>
								</section>

								<section class="cta">
									<a href="<?php echo get_page_link(4); ?>" class="orange-btn button unit-contact">
										contact us
									</a>

									<ul>
										<?php $terms = get_terms('bedrooms');
											if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
											    $count = count( $terms );
											    $i = 0;
											    $term_list = '<li class="bedrooms-archive">';
											    foreach ( $terms as $term ) {
											        $i++;
											    	$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) . '" class="gray-btn">' . $term->name . '</a>';
											    	if ( $count != $i ) {
											            $term_list .= ' &middot; ';
											        }
											        else {
											            $term_list .= '</li>';
											        }
											    }
											    echo $term_list;
											} ?>
									</ul>
									<a href="#unit-other-units" id="unit-other-units" class="gray-btn button">other units</a>
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
