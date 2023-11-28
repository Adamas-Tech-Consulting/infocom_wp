<?php

/**

 Template Name: Video Inner

 */

get_header(); ?>



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
														href="<?php if($add_you_tube_link) { ?><?php echo $add_you_tube_link; ?><?php } else { ?>#vid-<?php echo $i.$j;?>  <?php } ?>">
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

					</div>

	
<?php get_footer();