<?php

/**

 Template Name: Cio template

 */

get_header(); ?>

<section class="banner-area">
	<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
</section>

<section class="all-blogs">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="blog-sec">
					
				    <div class="row mt-30">
					<?php $args = array(
			            'post_type' => 'ciolist',
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
										<img src="<?php the_field('add_profile_picture');?>" class="img-fluid" />
									</a>
								</div>

								
								<span><?php the_field('add_designation');?></span>
					             <strong><?php the_field('add_company_name');?></strong>
					 			<em><?php the_field('add_location');?></em>

								<a href="<?php the_permalink();?>" class="more-details">More Details</a>
							</div>
						</div>
						
						<?php endwhile;  wp_reset_postdata(); ?>

					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


	
<?php get_footer();