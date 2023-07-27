<?php

/**

 Template Name: Video template

 */

get_header(); ?>

<section class="banner-area">
	<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
</section>

<section class="session-videos d-none">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

			


				<div class="video-list inner list">
					<h2><strong>Infocom Calcutta</strong> Videos</h2>
					<div class="row">
							<?php 
									$args = array(
										'post_type' => 'sess-video',
										'post_status' => 'publish',
										'posts_per_page' => -1,
										// 'tax_query' => array(
										// 	array(
										// 		'taxonomy' => 'video-categories',
										// 		'field'    => 'slug',
										// 		'terms'    => array('default')
										// 	),
										// ),
									);
									 
								$slider = new WP_Query($args);

							
								// echo '<pre>' print_r($slider) '</pre>';
								
								
							?>

							<?php $i=1; while($slider->have_posts()): $slider->the_post(); 
								$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							?>



								<div class="col-md-4 px-2 py-2 gallery-item">

									<div class="hover-overlay">
										<?php the_post_thumbnail(); ?>
										<div class="item-overlay"></div>

										<div class="event-img-meta white-color">
											<h5><?php the_title();?></h5>   
											<?php 
											
											$featured_posts = get_field('add_conference_title');
											$file = get_field('add_session_video');
											$videodate = get_field('add_video_date');
											if( $featured_posts ):
											foreach( $featured_posts as $post ): 

											// Setup this post for WP functions (variable must be named $post).
											//setup_postdata($post); ?> 
											
													<span> <?php echo get_the_excerpt(); ?> </span>
													<p>[ <?php echo $videodate; ?> ]</p>
													
											
											<?php endforeach; wp_reset_postdata(); ?>

											<?php endif; ?>

										</div>

										<div class="image-zoom icon-xl white-color">
											<a class="popup-with-form" href="#vid-<?php echo $i; ?>">
												<span class="fa-regular fa-circle-play"></span>
											</a>

										</div>

									</div>
								
									<div id="vid-<?php echo $i; ?>" class="white-popup-block mfp-hide ">
									<video class="pop-videos img-fluid" controls>
										<source src="<?php echo $file['url']; ?>" type="video/mp4">
									</video> 
									
										
									</div> 
								</div>

							<?php $i++; endwhile;  wp_reset_postdata(); ?>

					</div>

				</div>
			</div>
		</div>
	</div>
</section>



<section class="session-videos pb-50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				

				<div class="video-list inner list">

					<h2 class="position-relative"><strong>Video</strong> Gallery   
							<select class="cat-list form-select">

								<option value="0">All</option>

								<?php 
									$args = array(
										'post_type' => 'event-list',
										'post_status' => 'publish',
										'posts_per_page' => -1,
										'order' => 'ASC',
									);
									$slider = new WP_Query($args);
								?>

								<?php  while($slider->have_posts()): $slider->the_post(); 
									//$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
									
								?>

									<?php if( get_field('add_conference_videos') ): ?>

										<option value="<?php echo $post->ID; ?>"><?php the_title(); ?></option>

									<?php endif; ?>


								<?php  endwhile; 
								wp_reset_postdata(); ?>
							</select>
				    </h2>


					<?php get_template_part( 'template-parts/template-videoinner' ); ?>

				</div>
			</div>
		</div>
	</div>
</section>


<script>
	  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
	
<?php get_footer();