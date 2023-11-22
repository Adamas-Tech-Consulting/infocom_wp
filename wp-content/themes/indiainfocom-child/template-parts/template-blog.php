<?php

/**

 Template Name: Blog template

 */

get_header(); ?>

<section class="banner-area">
	<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
</section>

<section class="all-blogs d-none">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="blog-sec">
					
				    <div class="row mt-30">
					<?php $args = array(
			            'post_type' => 'infocom-blog',
			            'posts_per_page' => -1,
			            'order' => 'ASC',
			         );
			            $slider = new WP_Query($args);
			         ?>

			         <?php while($slider->have_posts()): $slider->the_post(); 
		        		$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		        	?>


						<div class="col-md-4 mb-4">
					 		<div class="blog-cover">
								<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
								<div class="pic">
									<a href="<?php the_permalink();?>">
										<span><?php the_field('add_date');?></span>
										<?php the_post_thumbnail(); ?>
									</a>
								</div>
					 			<p> <?php echo get_the_excerpt(); ?> </p>

								<a href="#" class="more-details">More Details</a>
							</div>
						</div>
						
						<?php endwhile;  wp_reset_postdata(); ?>

					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="all-blogs">
	<div class="container">
		<div class="blog-sec">

				<?php 

				$args = array(  
				        'orderby'   => 'title',
				        'order'     => 'DESC',
				    );  
				$product_categories = get_terms( 'blog-categories', $args );  
				$count = count($product_categories);  
				if ( $count > 0 ){  
				    foreach ( $product_categories as $product_category ) {

				        echo '<h2>' . $product_category->name . '</h2>';  
				            $args =array('posts_per_page' => -1,
				                        'post_type' => 'infocom-blog',
				                        'orderby' => 'title',                                
				                        'tax_query' => array('relation' => 'AND',  
				                                            array(  'taxonomy' => 'blog-categories',
				                                                'field' => 'slug',
				                                                'terms' => $product_category->slug  
				                                                )  
				                                            ),  
				                        );  
				            $products = new WP_Query( $args );  

					            echo '<div class="row mt-30">';

					            while ( $products->have_posts() ) { $products->the_post();  ?>  

					                <div class="col-md-4 mb-5">
								 		<div class="blog-cover">
											<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
											<div class="pic">
												<a href="<?php the_permalink();?>">
													<span><?php the_field('add_date');?></span>
													<?php the_post_thumbnail(); ?>
												</a>
											</div>
								 			<p> <?php echo get_the_excerpt(); ?> </p>

											<a href="#" class="more-details">More Details</a>
										</div>
									</div>


					     <?php  }  wp_reset_query();

					     		echo '</div>';

					    }  
					} ?>

		</div>

	</div>

</section>
	
<?php get_footer();