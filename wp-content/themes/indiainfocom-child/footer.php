<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	

	<footer id="colophon" class="site-footer">

		<div class="container-fluid px-4">
			<div class="row">
				<div class="col-md-4 px-4">
					<?php if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					} ?>

					<a href="<?php echo site_url();?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/Infocom-Main-Logo-2022.png"></a>

					<h3>Connect Us</h3>

					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'container'      => '',
								'menu_class'     => 'social-link',
								'add_li_class'  => '',
								'depth'          => 0,
							) 
					); ?>
				</div>


				<div class="col-md-4">

					<h3>Quick Links</h3>

					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => '',
								'menu_class'     => 'foot-menu',
								'add_li_class'  => '',
								'depth'          => 0,
							) 
					); ?>
					
				</div>


				<div class="col-md-4">

					<h5 class="d-flex justify-content-between align-items-center">Powered by
						<a href="https://adamastech.in/" target="_blank">
							<img src="https://adamastech.in/wp-content/uploads/2023/05/logo.png" class="custom-logo" alt="Logo" decoding="async" width="236" height="69">
						</a>
					</h5>

					<h3 class="mt-4"> Get subscribed today! </h3>

					<form method="post" class="mail-subscribe" action="<?php echo get_site_url(); ?>/?na=s">
						<input type="hidden" name="nlang" value="">
						<div class="tnp-field tnp-field-email">
							<input class="tnp-email" placeholder="Enter your email" type="email" name="ne" id="tnp-1" value="" required>
						</div>
						<div class="tnp-field tnp-field-button">
							<button type="submit">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</button>
						</div>
					</form>

					

				</div>

			</div>
		</div>

	</footer><!-- #colophon -->

	<div class="small-footer">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-6 px-4">
					<p> &copy; <?php the_field('add_copywrite_text','option'); ?> </p>
				</div>
				<div class="col-md-6 text-right px-5">
					<ul class="foot-links">
						<li>
							<a href="">Terms & Conditions</a>
						</li>
						<li>
							<a href="<?php echo get_home_url(); ?>/privacy-policy">Privacy Policy</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

</div><!-- #page -->

<a href="#top" class="back-to-top">
	<i class="fa-solid fa-angles-up"></i>
</a>

<?php wp_footer(); ?>

</body>
</html>
