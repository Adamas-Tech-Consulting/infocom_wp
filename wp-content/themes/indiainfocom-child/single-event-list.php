<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();?>

	<section class="banner-area position-relative">
		<img src="<?php the_field('add_banner'); ?>" class="img-fluid" />
		<?php if( get_field('add_register_now_link') ): ?>

			<a href="#" class="register-now">Register Now</a>

		<?php endif; ?>

	</section>

	<div class="sticky-menu">
		<div class="container">
			<div class="row">
				<div class="col-md-12 p-0">
					<ul class="event-tab-section">
						<?php if ( get_the_content() ) { ?> <li><a href="#overview">Overview</a></li> <?php } ?>
						
						<?php if( get_field('add_event_details') ): ?><li><a href="#schedule">Agenda</a></li> <?php endif; ?>
						<li class="d-none"><a href="#map">Map</a></li>
						<?php if( get_field('add_speakers') ): ?><li><a href="#speaker">Speakers</a></li> <?php endif; ?>
						<!-- <li><a href="#sponser">Sponsors</a></li>
						<li><a href="#video">Videos</a></li>
						<li><a href="#testimonial">Testimonials</a></li> -->
					</ul>
				</div>
			</div>
		</div>
		
	</div>
		

	<section id="overview" class="post-details">


		<div class="container">
			<div class="row">
				<div class="col-md-12">
				`		
				</div>
			</div>
			<div id="overview" class="row">
				<div class="col-md-8">
					<div class="event-info left">
						
						<h3>
							<?php the_title();?> 
							<?php echo get_the_excerpt(); ?>
						</h3>

						<?php if ( get_the_content() ) { ?>
								<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post(); ?>

									<?php the_content(); ?>

								<?php endwhile;  ?>

						<?php } ?>

						<?php if( get_field('add_conference_details') ): ?>
							<?php the_field('add_conference_details'); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="event-info right">
						

						<div class="conference-logo text-center">
							<img src="<?php the_field('add_conference_logo'); ?>" class="img-fluid" />
						</div>

						<ul class="list-details">
							<li><i class="fa-regular fa-calendar"></i> &nbsp;<?php the_field('add_date');?></li>
							<li><i class="fa-solid fa-location-dot"></i> &nbsp;<?php the_field('add_venue');?></li>
							<li> <i class="fa-solid fa-palette"></i> &nbsp;<?php the_field('add_theme');?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		
	</section>



	
	<section id="schedule" class="agenda">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>
						Agenda
					</h3>
				</div>
			</div>

			<div class="row  mt-4">
				<div class="col-md-3">
					<div class="sidebar">
						<?php $arr_type[]=""; ?>
						<h4 class="">Filter by Track</h4>
						<ul class="track-list">
						<?php while( have_rows('add_event_details') ): the_row(); 
	
							?>

							<?php while( have_rows('add_events') ): the_row(); 
								$add_track = get_sub_field('add_track');
								//echo $add_session_type.'</br>';
								//echo '<pre>';print_r($arr_type);echo '</pre>';
								//$arr_type[]=$add_session_type;
								if (!in_array($add_track, $arr_type))
								{
									$arr_type[]=$add_track;
							?>
							<li data-track="<?php echo $add_track; ?>">
								<?php echo $add_track; ?>
							</li>

							<?php
							}
							?>
								<?php endwhile;  // wp_reset_postdata();?>
							<?php endwhile;   //wp_reset_postdata();?>
							
						</ul>
							<?php $arr_type[]=""; ?>
						<h4>Filter by Session Type</h4>

						<ul class="session-type">

							<?php while( have_rows('add_event_details') ): the_row(); 
	
							?>

							<?php while( have_rows('add_events') ): the_row(); 
								$add_session_type = get_sub_field('add_session_type');
								//echo $add_session_type.'</br>';
								//echo '<pre>';print_r($arr_type);echo '</pre>';
								//$arr_type[]=$add_session_type;
								if (!in_array($add_session_type, $arr_type))
								{
									$arr_type[]=$add_session_type;
							?>
								<li data-type="<?php echo $add_session_type; ?>">
									<?php echo $add_session_type; ?>
								</li>
								<?php
							}
							?>
								<?php endwhile;  // wp_reset_postdata();?>
							<?php endwhile;   //wp_reset_postdata();?>


						</ul>
					</div>
					

				</div>
				<div class="col-md-9">

						<div class="nav nav-tabs" role="tablist">
							<?php $i=1; while( have_rows('add_event_details') ): the_row(); 
								$add_day = get_sub_field('add_day');
								//$add_date = get_sub_field('add_date');
								//$date = DateTime::createFromFormat( 'Ymd', $add_date );
								$date = get_sub_field('add_date');
								$date2 = date('F j', strtotime($date));
							?>
								<button class="nav-link <?php if($i == 1) { echo 'active'; } ?>" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $i; ?>" type="button" role="tab" aria-controls="nav-<?php echo $i; ?>" aria-selected="true">
									<?php echo $add_day; ?> <span><?php echo $date2; ?></span>
								</button>
							<?php $i++; endwhile;   wp_reset_postdata();?>
						</div>

						<div class="tab-content">
							<?php $j=1; while( have_rows('add_event_details') ): the_row(); 
											$add_day = get_sub_field('add_day');

										?>
								
								<div class="tab-pane fade <?php if($j == 1) { echo 'show active'; } ?>" id="nav-<?php echo $j; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $j; ?>">
									
									<ol class="flex flex-col tabular-agenda">
									<?php while( have_rows('add_events') ): the_row();
									        $subtitle = get_sub_field('add_subtitle'); 
											$start_time = get_sub_field('add_start_time');
											$end_time = get_sub_field('add_end_time');
											$sponser_img = get_sub_field('add_sponser_picture');
											$add_subject_details = get_sub_field('add_subject_details');
											$add_hall_number = get_sub_field('add_hall_number');
											$short_desc = get_sub_field('add_short_description');
											$speaker_name = get_sub_field('add_speaker_name');
											$speaker_image = get_sub_field('add_speaker_image');
											$speaker_designation = get_sub_field('add_speaker_designation');
											$add_hall_number = get_sub_field('add_hall_number');
											$add_track = get_sub_field('add_track');
											$add_session_type = get_sub_field('add_session_type');
										?>


											<li>
												<h4 class="d-flex align-items-center">
													<span class="pr-2 event-date">
														<?php echo $start_time; ?>
													</span>
													<hr class="ml-2">
												</h4>
												<div class="row my-2">
													
													<div class="col-md-10">
													<?php if($subtitle) : ?><h2 style="color:#1245a8;"><?php echo $subtitle; ?></h2><?php endif; ?>
														<?php if($add_track) : ?><em><?php echo $add_track; ?></em>  &nbsp; <?php endif; ?>
														<em>
															<?php if($start_time) : ?>
																	<?php echo $start_time; ?>
																<?php endif; ?>
																<?php if($end_time) : ?>
																	- <?php echo $end_time; ?>
																<?php endif; ?>
														</em> &nbsp;
														<?php if($add_session_type) : ?><span class="session-type"> <?php echo $add_session_type; ?></span><?php endif; ?>
															<?php if($add_subject_details) : ?><h5 class="text-uppercase mt-2"><?php echo $add_subject_details; ?></h5><?php endif; ?>
																<?php if($short_desc) : ?><?php echo $short_desc; ?><?php endif; ?>
														<?php if($speaker_image) : ?>
															<span class="speaker-details" data-toggle="tooltip" title="<img src='<?php echo $speaker_image; ?>' class='img-fluid' /> <br/> <?php echo $speaker_designation; ?>">
																<?php echo $speaker_name; ?>
															</span>
														<?php endif; ?>
														<?php if($add_hall_number) : ?>
															<span class="hall_number"> <?php echo $add_hall_number; ?></span>
														<?php endif; ?> 

													</div>


													<div class="col-md-2 align-self-center">
														<img src="<?php echo $sponser_img;?>" class="img-fluid">
													</div>
												</div>
											</li>

									

										<?php endwhile; wp_reset_postdata(); ?>
									</ol>



								</div>

								
							<?php $j++; endwhile;   wp_reset_postdata();?>
						</div>


				</div>
			</div>
			


		</div>
	</section>



	<section id="map" class="gmap d-none">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
						<h2><strong>Event</strong> Location</h2>
						<img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/GoogleMapTA.webp" class="img-fluid" />
				</div>
			</div>
		</div>
	</section>


	<?php if( get_field('add_speakers') ): ?>

		

			<section id="speaker" class="cheif-speakers">
				<div class="container">

					<div class="row">
						<div class="col-md-12">
							<h2><strong>Event</strong> Speakers</h2>

							<ul class="option-link d-none">
								<div class="nav filter-speaker" role="tablist">
									<li class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-highlight" type="button" role="tab" aria-selected="true"><span class="speaker-highlight">Highlight</span></li>
									<li class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-key" type="button" role="tab" aria-selected="true"><span class="speaker-key">KeyNoteSpeaker</span></li>
									<li  class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-regular" type="button" role="tab" aria-selected="true"><span class="speaker-regular">Regular</span></li>
								</div>
														
							</ul>
							
								<div class="tab-content1">
										
										
										<!-- <div class="tab-pane fade show active" id="nav-highlight" role="tabpanel"> -->

												<div class="row">
												<?php $i=1; while( have_rows('add_speakers') ): the_row(); 
													$add_speaker_image = get_sub_field('add_speaker_image');
													$add_speaker_name = get_sub_field('add_speaker_name');
													$add_company_name = get_sub_field('add_company_name');
													$add_designation = get_sub_field('add_designation');
													$options = get_sub_field('choose_speaker_type');
													$linkedin = get_sub_field('add_linkedin_link');
												?>
														
																
													<div class="col-md-3">
														<div class="speaker">
															<div class="hover-overlay">
																<img src="<?php echo $add_speaker_image; ?>" class="img-fluid" />
																<?php if( get_sub_field('add_linkedin_link') ): ?>
																	<a href="<?php echo $linkedin; ?>" class="linkedin-url" target="_blank"><i class="fa fa-linkedin"></i></a>
																<?php endif; ?>
																
																</div>
															<div class="speaker-meta">                                                  
																<h5 class=""><?php echo $add_speaker_name; ?></h5>
																<span class=""><?php echo $add_designation; ?></span>
																<p class=""><?php echo $add_company_name; ?></p>
																
															</div>
														</div>
													</div>
																
														<?php $i++; endwhile; ?>
												</div>
										<!-- </div> -->


										<div class="tab-pane fade d-none" id="nav-key" role="tabpanel">
											<div class="row">
												<?php $i=1; while( have_rows('add_speakers') ): the_row(); 
													$add_speaker_image = get_sub_field('add_speaker_image');
													$add_speaker_name = get_sub_field('add_speaker_name');
													$add_company_name = get_sub_field('add_company_name');
													$add_designation = get_sub_field('add_designation');
													$options = get_sub_field('choose_speaker_type');
												?>
														<?php if( $options && in_array('KeyNoteSpeaker', $options) ) { ?>
															<div class="col-md-3">
																<div class="speaker">
																	<div class="hover-overlay">
																		<img src="<?php echo $add_speaker_image; ?>" class="img-fluid" />
																	</div>
																	<div class="speaker-meta">                                                  
																		<h5 class=""><?php echo $add_speaker_name; ?></h5>
																		<span class=""><?php echo $add_designation; ?></span>
																		<p class=""><?php echo $add_company_name; ?></p>
																		
																	</div>
																</div>
															</div>
														<?php } ?>
												<?php $i++; endwhile; ?>
											</div>
										</div>


										<div class="tab-pane fade d-none" id="nav-regular" role="tabpanel">
											<div class="row">
												<?php $i=1; while( have_rows('add_speakers') ): the_row(); 
													$add_speaker_image = get_sub_field('add_speaker_image');
													$add_speaker_name = get_sub_field('add_speaker_name');
													$add_company_name = get_sub_field('add_company_name');
													$add_designation = get_sub_field('add_designation');
													$options = get_sub_field('choose_speaker_type');
												?>
														<?php if( $options && in_array('Regular', $options) ) { ?>
															<div class="col-md-3">
																<div class="speaker">
																	<div class="hover-overlay">
																		<img src="<?php echo $add_speaker_image; ?>" class="img-fluid" />
																	</div>
																	<div class="speaker-meta">                                                  
																		<h5 class=""><?php echo $add_speaker_name; ?></h5>
																		<span class=""><?php echo $add_designation; ?></span>
																		<p class=""><?php echo $add_company_name; ?></p>
																		
																	</div>
																</div>
															</div>
														<?php } ?>
												<?php $i++; endwhile; ?>
											</div>
										</div>
										
								</div>
							
						</div>
					</div>
				</div>
			</section>
	<?php endif; ?>


	<section id="sponser" class="sponsership d-none">
			<div class="container">
					<div class="row">
						<div class="col-md-8 offset-md-2 text-center">
							<h2>Thank You Sponsors</h2>
							<p>We wouldn't be able to host our conference without 
								help from these amazing companies. A huge thanks to all our sponsors and partners!</p>
						</div>
					</div>
			
					<div class="row brands-holder text-center">
							<div class="col-sm-6 col-md-3">
								<div class="brand-logo">
									<a href="#">
										<img class="img-fluid" src="https://jthemes.net/themes/wp/eventer/wp-content/themes/eventer/images/brand-1.png" loading="lazy" alt="brand-logo" width="200" height="135">
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="brand-logo">
									<a href="#">
										<img class="img-fluid" src="https://jthemes.net/themes/wp/eventer/wp-content/themes/eventer/images/brand-2.png" loading="lazy" alt="brand-logo" width="200" height="135">
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="brand-logo">
									<a href="#">
										<img class="img-fluid" src="https://jthemes.net/themes/wp/eventer/wp-content/themes/eventer/images/brand-3.png" loading="lazy" alt="brand-logo" width="200" height="135">
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="brand-logo">
									<a href="#">
										<img class="img-fluid" src="https://jthemes.net/themes/wp/eventer/wp-content/themes/eventer/images/brand-4.png" loading="lazy" alt="brand-logo" width="200" height="135">
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="brand-logo">
									<a href="#">
										<img class="img-fluid" src="https://jthemes.net/themes/wp/eventer/wp-content/themes/eventer/images/brand-5.png" loading="lazy" alt="brand-logo" width="200" height="135">
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="brand-logo">
									<a href="#">
										<img class="img-fluid" src="https://jthemes.net/themes/wp/eventer/wp-content/themes/eventer/images/brand-6.png" loading="lazy" alt="brand-logo" width="200" height="135">
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="brand-logo">
									<a href="#">
										<img class="img-fluid" src="https://jthemes.net/themes/wp/eventer/wp-content/themes/eventer/images/brand-7.png" loading="lazy" alt="brand-logo" width="200" height="135">
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="brand-logo">
									<a href="#">
										<img class="img-fluid" src="https://jthemes.net/themes/wp/eventer/wp-content/themes/eventer/images/brand-8.png" loading="lazy" alt="brand-logo" width="200" height="135">
									</a>
								</div>
							</div>
						
            		</div>
			</div>
		
	</section>

	<?php if( get_field('add_conference_videos') ): ?>

		<section id="video" class="session-videos white-bg wow fadeInUp" style="background:#ffffff;">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						

						<div class="video-list inner">
							<h2 class="">Videos</h2>
							<div class="row">
							<?php $i=1; while( have_rows('add_conference_videos') ): the_row(); 
									$add_video_file = get_sub_field('add_video');
									$add_video_name = get_sub_field('add_video_name');
									$add_video_date = get_sub_field('add_video_upload_date');
									$add_video_thumbnail = get_sub_field('add_video_thumbnail');
									$add_you_tube_link = get_sub_field('add_you_tube_link');
								?>

										<div class="col-md-3 px-2 py-2 gallery-item">
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
													href="<?php if($add_you_tube_link) { ?><?php echo $add_you_tube_link; ?><?php } else { ?>#vid-<?php echo $i;?>  <?php } ?>">
														<span class="fa-regular fa-circle-play"></span>
													</a>

												</div>
											</div>

											<div id="vid-<?php echo $i; ?>" class="white-popup-block mfp-hide ">
												<video class="pop-videos img-fluid" controls>
													<source src="<?php echo $add_video_file['url']; ?>" type="video/mp4">
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

    <?php endif; ?>


	<section id="testimonial" class="testiminials text-center d-none  wow fadeInUp" style="background: url('<?php the_field('add_testi_bg','option') ?>') no-repeat; ">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>What People Say?</h2>
					<p>More than 84% of 2019 attendees said the Eventer Conference 2019 was 'better' or <br/> 'way better' than similar events that year</p>
					<div class="testi-item">
					<?php while( have_rows('add_testimonial') ): the_row(); 
									$t_name = get_sub_field('add_testimonial_name');
									$t_picture = get_sub_field('add_testimonial_picture');
									$t_content = get_sub_field('add_testimonial_content');
									$t_designation = get_sub_field('add_testimonial_designation');
									$show_in_homepage_testimonial = get_sub_field('show_in_homepage_testimonial');
								?>
								
									<div class="item">
											<div class="image-sec">
												<img src="<?php echo $t_picture; ?>" class="img-fluid" />
											</div>
											<?php echo $t_content; ?>
											<h3><?php echo $t_name; ?></h3>
											<span>(<?php echo $t_designation; ?>)</span>
									</div>
								
						<?php endwhile;  wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	

	<section class="agenda d-none">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<h3>
										Schedule
									</h3>
								</div>
							</div>

							<?php while( have_rows('add_event_details') ): the_row(); 
								$start_time = get_sub_field('add_day');
							?>
								<?php if( have_rows('add_events') ): ?>
									<div class="row">
									
										<?php $i=2; while( have_rows('add_events') ): the_row(); 
											$start_time = get_sub_field('add_start_time');
											$end_time = get_sub_field('add_end_time');
											$add_subject_details = get_sub_field('add_subject_details');
											$add_hall_number = get_sub_field('add_hall_number');
											$short_desc = get_sub_field('add_short_description');
										?>
											<div class="col-md-6 <?php if($i % 2 == 0){ echo 'right'; } ?>">
												<div class="row my-2 schedule-event">
													
													<div class="col-md-12">

														<div class="cont-area">
															<h3><?php echo $add_subject_details; ?></h3>
															<div>
																<span><?php echo $start_time; ?></span>
																<span><?php echo $end_time; ?></span>
															</div>
															<em><?php echo $add_hall_number; ?></em>
														</div>
														
														<?php echo $short_desc; ?>
														
													</div>
												</div>
											</div>
										<?php $i++; endwhile; ?>
									</div>
								<?php endif; ?>
								<?php endwhile; ?>
						</div>
	</section>





	<a href="<?php the_permalink(27); ?>" title="Back to events" class="back-bttn"><i class="fa-solid fa-angles-left"></i></a>

	<script>
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>


<?php
get_footer();
