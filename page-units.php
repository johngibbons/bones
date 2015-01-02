<?php
/*
 Template Name: All Units
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


								<h1 class="page-title"><?php the_title(); ?></h1>

								<div id="units-content">

								<section id="site-plan">
									<a href="">
									<a href="">
									<a href="">
									<a href="">
									<a href="">
								</section>

							<?php endwhile; endif; ?>


    					<section class="units-description-container">
								<?php
                  $post_type = 'unit';

                  // Get all the taxonomies for this post type
                  $taxonomies = get_object_taxonomies( (object) array( 'post_type' => $post_type ) );

                  foreach( $taxonomies as $taxonomy ) :

                    // Gets every "category" (term) in this taxonomy to get the respective posts
                    $terms = get_terms( $taxonomy );

                    foreach( $terms as $term ) :
                   
                      $posts = new WP_Query( array(
												'post_type' => $post_type,
												'tax_query' => array(
																array(
																	'taxonomy' => $taxonomy,
																	'field'    => 'slug',
																	'terms'    => $term,
																),
															),
												'posts_per_page' => '-1'));

    									?><h4 class="small-heading-mobile"><?php echo $term->name; ?></h4>
	    									
                      <?php if( $posts->have_posts() ) :
                     
                      	while( $posts->have_posts() ) : $posts->the_post(); ?>

								<a href="<?php the_permalink(); ?>">

									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf, units-description' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

										<header class="small-list-section">

											<span class="units-title small-list-heading <?php the_ID(); ?>"><?php the_title(); ?></span>
											<span class="units-bedrooms small-list-heading"> <?php echo $term->name; ?></span>
											<span class="units-size small-list-heading"> <?php number_format(the_field('square_footage')); ?> sq. ft.</span>
											<span class="units-price small-list-heading"> $<?php the_field('price'); ?></span>
											<span class="units-cta small-list-heading">More Info <img src="<?php echo get_template_directory_uri(); ?>/library/images/right-arrow.png" class="units-right-arrow"></span>
											<div class="units-preview-image"></div>

										</header>

									</article>
								</a>

									<?php endwhile;
                                                                               
                    else : ?>

                            <article id="post-not-found" class="hentry clearfix">
                                    <header class="article-header">
                                            <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
                                    </header>
                                    <section class="entry-content">
                                            <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
                                    </section>
                                    <footer class="article-footer">
                                            <p><?php _e("This is the error message in the custom posty type archive template.", "bonestheme"); ?></p>
                                    </footer>
                            </article> <?php
                   
									            endif;

									    endforeach;

									endforeach; ?>
							</section>

							</div>
									

						</main>

				</div>

			</div>


<?php get_footer(); ?>
