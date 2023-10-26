<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="top" class="site">


	<?php get_template_part( 'template-parts/header/site-header' ); ?>

	<?php if(is_front_page()) { ?>

		<?php $args = array(
            'post_type' => 'event-list',
            'posts_per_page' => -1,
            'order' => 'DESC',
         );
            $slider = new WP_Query($args);
         ?>


         <div class="banner-item">
		        <?php while($slider->have_posts()): $slider->the_post(); 
		        		$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		        	?>

					
			<?php
			    $show_on_homepage_banner = get_field('show_on_homepage_banner');
				if($show_on_homepage_banner)
			{ ?>

				<div class="item">

		             <!-- <div class="banner-details banner<?php // echo $i; ?>" style="background: url('<?php // echo $backgroundImg['0'];?>')"> -->
					 <div class="banner-details banner<?php echo $i; ?>" style="background: url('<?php the_field('homepage_banner_url'); ?>')"> -->

		                <div class="container">

		                    <div class="row">
		                      
								<div class="col-md-12 text-center">
									<div class="logo-sec">
										<!-- <img src="<?php // the_field('add_conference_logo'); ?>" class="img-fluid" /> -->
										<img src="<?php the_field('add_conference_logo_url'); ?>" class="img-fluid" />
									</div>
									<h2><?php the_title();?> <?php if ( ! has_excerpt() ) {
											echo '';
										} else { 
											echo get_the_excerpt();
										}?>
										 </h2>
									<h3><?php the_field('add_date'); ?> | <?php the_field('add_venue'); ?></h3>
									<a href="<?php the_permalink();?>" class="explore-now">Explore Now</a>
									

									<?php if( get_field('add_register_now_link') ): ?>

									   <a href="#" class="register-now">Register Now</a>

									<?php endif; ?>
								</div>
		 
		                    </div>

		                </div>
		                
		            </div>
				
				</div>

			<?php }  ?>

				 <?php endwhile;  wp_reset_postdata(); ?>

		  </div>

		<?php }  ?>



	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
