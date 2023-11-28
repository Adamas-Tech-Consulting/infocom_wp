<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= ( true === get_theme_mod( 'display_title_and_tagline', true ) ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>

<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?> site-head">

		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12 px-5 top-menu">

				<div class="basic-contact">
									<ul>
										<li>
											<a href="mailto:<?php the_field('add_email_id','option'); ?>">
												<i class="fas fa-envelope"></i>
												<?php the_field('add_email_id','option'); ?>
											</a>
										</li>
										<li>
											<a href="tel:+91 <?php the_field('add_phone_number','option'); ?>">
												<i class="fas fa-phone"></i>
												+91 <?php the_field('add_phone_number','option'); ?> 
											</a>
										</li>
									</ul>
								</div>
					
								<ul class="login-menu">
									<li class="list-inline-item">
										<a href="https://www.facebook.com/infocomconnect" target="_blank" class="nav-link"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									</li>
									<li class="list-inline-item">
										<a href="https://www.linkedin.com/company/infocomconnect/" target="_blank" class="nav-link"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
									</li>
									<li  class="list-inline-item">
										<a href="http://twitter.com/infocomconnect" target="_blank" class="nav-link"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									</li>
									
								</ul>
					
				</div>
			</div>

			<div class="row py-2">
				<div class="col-md-12 px-5">

				<div class="cover d-flex align-items-center">

					<?php if ( function_exists( 'the_custom_logo' ) ) {
							// the_custom_logo();
						} ?>

<a href="<?php echo site_url();?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/Infocom-Main-Logo-2022.png" style="height:51px;"></a>

						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'container'      => '',
									'menu_class'     => 'main-menu',
									'add_li_class'  => 'list-inline-item',
									'depth'          => 0,
								) 
						); ?>

				</div>

				
						
				</div>
			</div>			
		
		</div>

</header><!-- #masthead -->
