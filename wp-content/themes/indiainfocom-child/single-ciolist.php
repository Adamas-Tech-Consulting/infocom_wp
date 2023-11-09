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

get_header(); ?>

<div class="cio-banner position-relative">
	<?php the_post_thumbnail(); ?>
	<div class="container">
		<div class="negative-space">
			<div class="row">
				<div class="col-md-12">
					<div class="d-flex">
						<div class="flex-shrink-0">
							<img src="<?php the_field('add_profile_picture');?>" class="img-fluid" />
						</div>
						<div class="flex-grow-1 blog-cover p-4">
							<h3><?php the_title(); ?></h3>
							<span><?php the_field('add_designation');?></span>
							<strong><?php the_field('add_company_name');?></strong>
							<em><?php the_field('add_location');?></em>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
/* Start the Loop */
while ( have_posts() ) :
	the_post(); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="cio-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>


<?php	
endwhile; // End of the loop.

get_footer();
