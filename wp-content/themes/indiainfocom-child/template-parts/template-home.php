<?php

/**

 Template Name: Home

 */

get_header(); ?>

<section class="latest-conference wow fadeInUp">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="title align-items-center"><strong>Latest</strong> Events </h2>

				<div class="conference-item conference-slide">

					<?php $args = array(
			            'post_type' => 'event-list',
			            'posts_per_page' => -1,
			            'order' => 'DESC',
			         );
			            $slider = new WP_Query($args);
			         ?>

			         <?php while($slider->have_posts()): $slider->the_post(); 
		        		$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		        	?>


						<div class="item">
							<div class="pic-sec" style="background:url('<?php the_field('add_conference_logo');?>');">
								<a href="<?php the_permalink();?>">
									<?php // the_post_thumbnail(); ?>
									<!-- <img src="<?php // the_field('add_conference_logo');?>" /> -->
									<span><?php the_field('add_date'); ?></span>
								</a>
							</div>
							<div class="content-sec">
								<h4>
									<a href="<?php the_permalink();?>">
										<?php the_title(); ?> <br/> 
										<em>

										<?php if ( ! has_excerpt() ) {
											echo '';
										} else { 
											echo get_the_excerpt();
										}?>

                                        </em>
									</a>
								</h4>
								
								<div class="link-sec">
									<a href="<?php the_permalink();?>" class="explore-now"> See More</a>
								</div>
							</div>
						</div>

					<?php endwhile;  wp_reset_postdata(); ?>					

				</div>

				
				<div class="text-center">
					<a href="<?php the_permalink(27); ?>" class="view-all">View All &nbsp; <i class="fa-solid fa-arrow-right-long"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>



<?php if( get_sub_field('add_you_tube_link') ): ?>

<section class="session-videos white-bg wow fadeInUp">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				

				<div class="video-list pb-0">
					<h2 class=""><strong>Video</strong> Gallery</h2>
				

					<div class="row project-tiles ">
							<?php $args = array(
								'post_type' => 'event-list',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'order_by' => 'date',
								'order' => 'ASC',
							);
								$slider = new WP_Query($args);
								
							?>

							<?php $i=1; while($slider->have_posts()): $slider->the_post(); 
								$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							?>

								<?php $j=1; while( have_rows('add_conference_videos') ): the_row(); 
									$add_video_file = get_sub_field('add_video');
									$add_video_name = get_sub_field('add_video_name');
									$add_video_date = get_sub_field('add_video_upload_date');
									$add_video_thumbnail = get_sub_field('add_video_thumbnail');
									$add_you_tube_link = get_sub_field('add_you_tube_link');
									?>
	
											<div class="col-md-3 px-2 py-2 gallery-item itm-<?php echo $j ?>">
												<div class="hover-overlay">
													<img src="<?php echo $add_video_thumbnail; ?>" class="img-fluid" />
													<div class="item-overlay"></div>
	
													<div class="event-img-meta white-color">
														<h5><?php echo $add_video_name; ?></h5>   
																<span> <?php echo get_the_excerpt(); ?> </span>
																<p>[ <?php echo $add_video_date; ?> ]</p>
													</div>
	
													<div class="image-zoom icon-xl white-color">
														<a class="<?php if($add_you_tube_link) { ?> popup-youtube <?php } else { ?> popup-with-form <?php } ?> " 
														href="<?php if($add_you_tube_link) { ?><?php echo $add_you_tube_link; ?><?php } else { ?> #vid-<?php echo $i.$j; ?>  <?php } ?>">
															<span class="fa-regular fa-circle-play"></span>
														</a>
	
													</div>
												</div>
	
												<div id="vid-<?php echo $i.$j ?>" class="white-popup-block mfp-hide ">
													<video class="pop-videos img-fluid" controls>
														<source src="<?php echo $add_video_file['url']; ?>" type="video/mp4">
													</video> 
												</div>
	
											</div>
								<?php $j++; endwhile;  wp_reset_postdata(); ?>

							<?php $i++; endwhile;  wp_reset_postdata(); ?>

							<div class="text-center">
								<a href="<?php the_permalink(31); ?>" class="view-all">View All &nbsp; <i class="fa-solid fa-arrow-right-long"></i></a>
							</div>

					</div>


				</div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>


<section class="all-blogs wow fadeInUp d-none">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="blog-sec">
					<h2 class="title align-items-center"> <strong>CIO</strong>  Wall </h2>
				    <div class="row mt-30">
					<?php $args = array(
			            'post_type' => 'infocom-blog',
			            'posts_per_page' => -1,
			            'order' => 'ASC',
						// 'tax_query' => array(
						// 		array(
						// 			'taxonomy' => 'blog-categories',
						// 			'field'    => 'slug',
						// 			'terms'    => array('cio-wall')
						// 		),
						// 	),
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
				
				<div class="text-center mt-0">
					<a href="<?php the_permalink(29); ?>" class="view-all">View All &nbsp; <i class="fa-solid fa-arrow-right-long"></i></a>
				</div>


			</div>
		</div>
	</div>
</section>

<section class="testiminials d-none text-center  wow fadeInUp" style="background: url('<?php the_field('add_testi_bg','option') ?>') no-repeat; ">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>What People Say?</h2>
				<p>More than 84% of 2019 attendees said the Eventer Conference 2019 was 'better' or <br/> 'way better' than similar events that year</p>
				<div class="testi-item">
				<?php $args = array(
						'post_type' => 'event-list',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'order_by' => 'date',
						'order' => 'ASC',
					);
						$slider = new WP_Query($args);
						
					?>

					<?php $i=1; while($slider->have_posts()): $slider->the_post(); 
						$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					?>

					<?php while( have_rows('add_testimonial') ): the_row(); 
						$t_name = get_sub_field('add_testimonial_name');
						$t_picture = get_sub_field('add_testimonial_picture');
						$t_content = get_sub_field('add_testimonial_content');
						$t_designation = get_sub_field('add_testimonial_designation');
						$show_in_homepage_testimonial = get_sub_field('show_in_homepage_testimonial');
					?>
							<?php
								if($show_in_homepage_testimonial)
								{ ?>
									<div class="item">
											<div class="image-sec">
												<img src="<?php echo $t_picture; ?>" class="img-fluid" />
											</div>
											<?php echo $t_content; ?>
											<h3><?php echo $t_name; ?></h3>
											<span>(<?php echo $t_designation; ?>)</span>
									</div>
							<?php } ?>


						<?php $j++; endwhile;  wp_reset_postdata(); ?>

					<?php $i++; endwhile;  wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>


	
<?php get_footer();