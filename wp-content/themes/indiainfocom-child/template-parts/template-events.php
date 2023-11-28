<?php

/**

 Template Name: Conference

 */

get_header(); ?>

<section class="banner-area">
	<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
</section>
<section class="event-conference">
	<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="top">
						<h2><strong>Our</strong> Events </h2>
						<?php echo do_shortcode('[caf_filter id="298"]'); ?>
					</div>
					
				</div>
			</div>
	</div>
</section>

<section class="event-conference d-none">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><strong>Our</strong> Events  
			
					<select class="form-select year-filter" aria-label="Default select example">
						<option value="1">2023</option>
						<option value="2">2022</option>
						<option value="3">2021</option>
					</select>

			    </h2>
				<?php echo do_shortcode('[eventinfo-list]'); ?>
			
			</div>
		</div>
	</div>
</section>
	
<?php get_footer();