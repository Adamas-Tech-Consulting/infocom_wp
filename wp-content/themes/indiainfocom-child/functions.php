<?php

function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_stylesheet_directory_uri().'/favicon.png" />' . "\n";
}
add_action( 'wp_head', 'favicon_link' );

/* Remove update notification from backend */

function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

//include('function_include.php');

add_filter( 'body_class', 'custom_body_classes' );
function custom_body_classes( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_name;
    }
    return $classes;
}
//include('templates/bs4navwalker.php');
//require_once('bs4navwalker.php');

//nav Menu

register_nav_menus( array(
		'social' => __( 'Social Menu', 'el' ),
	) );

register_nav_menus( array(
		//'main' => __( 'Main Menu', 'el' ),
	) );

register_nav_menus( array(
		//'top-right' => __( 'Top Side Menu', 'el' ),
	) );

register_nav_menus( array(
		//'bottom-right' => __( 'Footer Bottom Menu', 'el' ),
	) );

//Enqueue Script And style

/*Add style */
add_action( 'wp_enqueue_scripts', 'register_child_theme_styles' );
function register_child_theme_styles() {

	//Styles
	
	 wp_register_style('bootcss', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(),'null', 'all');
    wp_enqueue_style('bootcss');
    
     wp_register_style('animatecss', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.compat.min.css', array(),'null', 'all');
    wp_enqueue_style('animatecss');

    wp_register_style('inputtelcss', 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css', array(),'null', 'all');
    wp_enqueue_style('inputtelcss');

    wp_register_style('allcss', get_stylesheet_directory_uri().'/assets/css/all.css', array(),'null', 'all');
    wp_enqueue_style('allcss');
        
     wp_register_style('slickcss', get_stylesheet_directory_uri().'/assets/css/slick.css', array(),'null', 'all');
    wp_enqueue_style('slickcss');

    wp_register_style('magnificcss', get_stylesheet_directory_uri().'/assets/css/magnific-popup.css', array(),'null', 'all');
    wp_enqueue_style('magnificcss');
 
    wp_register_style('maincss', get_stylesheet_directory_uri().'/assets/css/main.css', array(),'null', 'all');
    wp_enqueue_style('maincss');

     wp_register_style('mediacss', get_stylesheet_directory_uri().'/assets/css/media.css', array(),'null', 'all');
    wp_enqueue_style('mediacss');  
    
}

/*Add Js*/
add_action('wp_enqueue_scripts', 'wpEnqueueScripts');
function wpEnqueueScripts(){


    wp_register_script('jqueryjs', get_stylesheet_directory_uri().'/assets/js/jquery.min.js', array(),'null',true);
    wp_enqueue_script('jqueryjs');
    
    wp_register_script('bootjs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array(),'null',true);
    wp_enqueue_script('bootjs');;

    wp_register_script('awesome', 'https://kit.fontawesome.com/c8cc3a92a3.js', array(),'null',true);
    wp_enqueue_script('awesome');
    
    wp_register_script('slickjs', get_stylesheet_directory_uri().'/assets/js/slick.js', array(),'null',true);
    wp_enqueue_script('slickjs');

    wp_register_script('magnificjs', get_stylesheet_directory_uri().'/assets/js/magnific-popup.js', array(),'null',true);
    wp_enqueue_script('magnificjs');

    wp_register_script('wowjs', get_stylesheet_directory_uri().'/assets/js/wow.min.js', array(),'null',true);
    wp_enqueue_script('wowjs');

    wp_register_script('mainjs', get_stylesheet_directory_uri().'/assets/js/main.js', array(),'null',true);
    wp_enqueue_script('mainjs');


}

function arphabet_widgets_init() {

    register_sidebar( array(
        'name' => 'Blog right sidebar',
        'id' => 'cat_list',
        'before_widget' => '<div class="single-post">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );


/**
 * Register Post type 
 */

function brandinsight_post_type() {

        $event_labels = array(
                'add_new_item'  => 'Add New Conference',
                'edit_item'     => 'Edit Conference',
                'search_items'  => 'Search Conferences'
            );
        $event_list = array(
                'public'        => true,
                'label'         => 'Conference',
                'labels'        =>  $event_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );

         $clients_labels = array(
                'add_new_item'  => 'Add New clients',
                'edit_item'     => 'Edit Examination clients',
                'search_items'  => 'Search clients'
            );
        $clients_list = array(
                'public'        => true,
                'label'         => 'Our Clients',
                'labels'        =>  $clients_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );

    
       $testi_labels = array(
                'add_new_item'  => 'Add New Testimonial',
                'edit_item'     => 'Edit Testimonial',
                'search_items'  => 'Search Testimonials'
            );
        $testi_list = array(
                'public'        => true,
                'label'         => 'Testimonials',
                'labels'        =>  $testi_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );

        $video_labels = array(
                'add_new_item'  => 'Add New Session Video',
                'edit_item'     => 'Edit Session Video',
                'search_items'  => 'Search Session Video'
            );
        $video_list = array(
                'public'        => true,
                'label'         => 'Infocom Videos',
                'labels'        =>  $video_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );

        $cio_labels = array(
            'add_new_item'  => 'Add New Cio',
            'edit_item'     => 'Edit Cio',
            'search_items'  => 'Search Cio'
        );
        $cio_list = array(
                'public'        => true,
                'label'         => 'Cio wall',
                'labels'        =>  $cio_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );

        $business_labels = array(
            'add_new_item'  => 'Add New Business Analytics',
            'edit_item'     => 'Edit Business Analytics',
            'search_items'  => 'Search Business Analytics'
        );
        $business_list = array(
                'public'        => true,
                'label'         => 'Business Analytics',
                'labels'        =>  $business_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );

        $tech_labels = array(
            'add_new_item'  => 'Add New Tech',
            'edit_item'     => 'Edit Tech',
            'search_items'  => 'Search Tech'
        );
        $tech_list = array(
                'public'        => true,
                'label'         => 'Tech',
                'labels'        =>  $tech_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );

        $team_labels = array(
            'add_new_item'  => 'Add New Team',
            'edit_item'     => 'Edit Team',
            'search_items'  => 'Search Team'
        );
        $team_list = array(
                'public'        => true,
                'label'         => 'Team',
                'labels'        =>  $team_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );


        $blog_labels = array(
            'add_new_item'  => 'Add New Blog',
            'edit_item'     => 'Edit Blog',
            'search_items'  => 'Search Blog'
        );
        $blog_list = array(
                'public'        => true,
                'label'         => 'Blogs',
                'labels'        =>  $blog_labels,
                'supports'      => array('title', 'author', 'thumbnail', 'editor','custom-field', 'excerpt','tags','comments','categories')
        );
    

     //register_post_type( 'client', $clients_list );
     register_post_type( 'event-list', $event_list );
     //register_post_type( 'testi', $testi_list );
     register_post_type( 'sess-video', $video_list );
      register_post_type( 'ciolist', $cio_list );
     // register_post_type( 'business', $business_list );
     // register_post_type( 'tech', $tech_list );
     // register_post_type( 'team', $team_list );
      register_post_type( 'infocom-blog', $blog_list );
    }

    add_action( 'init', 'brandinsight_post_type' );


  
register_taxonomy( "event-categories", 
    array(  "event-list" ), 
    array(  "hierarchical" => true,
            "labels" => array('name'=>"Conference Categories",'add_new_item'=>"Add New Category"), 
            "singular_label" => __( "Conference Category" ), 
            "rewrite" => array( 'slug' => 'eventlist', // This controls the base slug that will display before each term 
            'with_front' => false)
         ) 
);


register_taxonomy( "sponsor-categories", 
    array(  "event-list" ), 
    array(  "hierarchical" => true,
            "labels" => array('name'=>"Sponsor Categories",'add_new_item'=>"Add New Category"), 
            "singular_label" => __( "Sponsor Category" ), 
            "rewrite" => array( 'slug' => 'eventlist', // This controls the base slug that will display before each term 
            'with_front' => false)
         ) 
);


register_taxonomy( "video-categories", 
    array(  "sess-video" ), 
    array(  "hierarchical" => true,
            "labels" => array('name'=>"Video Categories",'add_new_item'=>"Add New Category"), 
            "singular_label" => __( "Video Category" ), 
            "rewrite" => array( 'slug' => 'sessvideo', // This controls the base slug that will display before each term 
            'with_front' => false)
         ) 
);


  register_taxonomy( "blog-categories", 
    array(  "infocom-blog" ), 
    array(  "hierarchical" => true,
            "labels" => array('name'=>"Blog Categories",'add_new_item'=>"Add New Category"), 
            "singular_label" => __( "Category" ), 
            "rewrite" => array( 'slug' => 'infocom-blog', // This controls the base slug that will display before each term 
                                'with_front' => false)
         ) 
    );

    register_taxonomy('blog-tag','infocom-blog',array(
        'hierarchical' => false,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'tag' ),
    ));
    

register_taxonomy( "product-categories", 
    array(  "prod-view" ), 
    array(  "hierarchical" => true,
            "labels" => array('name'=>"Product Categories",'add_new_item'=>"Add New Category"), 
            "singular_label" => __( "Category" ), 
            "rewrite" => array( 'slug' => 'prodview', // This controls the base slug that will display before each term 
                                'with_front' => false)
         ) 
);
  
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}


add_theme_support( 'post-thumbnails' );


// Create Shortcode to Display Banner Post Types
  
function diwp_create_shortcode_banner_post_type(){
  
    $args = array(
                    'post_type'      => 'banner', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :

        echo '<div class="banner-item">';
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            <?php if($i <= 3) { ?>
                
        
            <div class="banner-details banner<?php echo $i; ?>" style="background-image: url('<?php echo $thumb['0'];?>')">

                <div class="container">

                    <div class="row align-items-center">
                        <div class="col-md-7 wow fadeInUp">
                            <h2><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                            <a href="<?php the_field('add_button_title'); ?>" class="partner-link"><?php echo get_the_excerpt(); ?></a>
                        </div>
                        <div class="col-md-5">
                            <div class="all-picture position-relative">
                                    <img src="<?php the_field('add_infographic_picture'); ?>" class="img-fluid" />
                                    <?php if( get_field('add_shape1') ): ?> 
                                        <div class="shape1"><img src="<?php the_field('add_shape1'); ?>" class="img-fluid" /></div>
                                    <?php endif; ?>
                                    <?php if( get_field('add_shape2') ): ?> 
                                        <div class="shape2"><img src="<?php the_field('add_shape2'); ?>" class="img-fluid" /></div>
                                    <?php endif; ?>
                                    <?php if( get_field('add_shape3') ): ?> 
                                        <div class="shape3"><img src="<?php the_field('add_shape3'); ?>" class="img-fluid" /></div>
                                    <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>

                </div>
                
            </div>

            <?php } else { ?>
            
                <div class="prodbanner-details banner<?php echo $i; ?>">

                <div class="container-fluid p-0">

                    <div class="row m-0">
                        <div class="col-md-12 p-0">


                            <div class="top-part">
                                <div class="content-part">
                                    <div class="part1">
                                        <span><?php the_field('add_top_text'); ?></span>
                                        <img src="<?php the_field('add_shape3'); ?>" class="img-fluid" />
                                    </div>
                                    <div class="part2">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="bottom-part">
                                <div class="shape1">
                                    <img src="<?php the_field('add_shape1'); ?>" class="img-fluid" />
                                </div>

                                <div class="button-link">
                                        <a href="<?php the_field('add_button_title'); ?>" class="partner-link"><?php echo get_the_excerpt(); ?></a>
                                        <br/>
                                        <a href="" class="learn-more">Learn More</a>
                                </div>

                                <div class="shape2">
                                    <img src="<?php the_field('add_shape2'); ?>" class="img-fluid" />
                                </div>

                               
                            </div>


                        </div>
                    </div>

                </div>
                
            </div>

            <?php } ?>
        
  
      <?php $i++; endwhile;  

      echo '</div>';
  
        wp_reset_postdata();
  
    endif;    
  
                
}
  
add_shortcode( 'banner-list', 'diwp_create_shortcode_banner_post_type' ); 


// Create Shortcode to Display Industry Post Types
  
function diwp_create_shortcode_industry_post_type(){
  
    $args = array(
                    'post_type'      => 'industry', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :

        echo '<div class="our-industry"> <div class="row">';
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            
                <div class="col-md-4 mb-4">
                    <div class="cover">
                        <div class="thumb-pic">
                            <img src="<?php the_field('add_list_picture'); ?>" class="img-fluid" />
                        </div>
                        <div class="content-sec">
                            <h3><?php the_title();?></h3>
                            <?php the_content(); ?>
                            <a href="<?php the_permalink();?>" class="learn-more mt-3">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

  
            <?php $i++; endwhile;  

            echo '</div> </div>';
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'industry-list', 'diwp_create_shortcode_industry_post_type' );


// Create Shortcode to Display Client Post Types
  
function diwp_create_shortcode_client_post_type(){
  
    $args = array(
                    'post_type'      => 'client', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :

        echo '<div class="client-slider">';
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            
                <div class="client-item">
                    <?php the_post_thumbnail();?>
                </div>

  
            <?php $i++; endwhile;  

            echo '</div>';
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'client-list', 'diwp_create_shortcode_client_post_type' );



// Create Shortcode to Display Client Post Types
  
function diwp_create_shortcode_testimonial_post_type(){
  
    $args = array(
                    'post_type'      => 'testi', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :

        echo '<div class="testi-slider">';
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            <div class="list">
                <div class="testi-item">
                    <div class="testi-top-part d-flex justify-content-between align-items-center">
                        <div class="author-info">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="<?php the_field('add_profile_picture'); ?>" class="img-fluid" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3><?php the_title();?></h3>
                                    <span><?php echo get_the_excerpt(); ?></span>
                                    <a href="<?php the_field('add_twitter_link'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="<?php the_field('add_linkedin_link'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                </div>
                                </div>
                            </div>
                        <div class="autor-logo">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    </div>

                    <div class="testi-bottom-part">
                        <img src="<?php echo  get_stylesheet_directory_uri() ?>/assets/images/quotes.png" class="img-fluid"/>
                        <?php the_content(); ?>
                    </div>
                </div>

            </div>

            <?php $i++; endwhile;  

            echo '</div>';
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'testimonial-list', 'diwp_create_shortcode_testimonial_post_type' );


// Create Shortcode to Display Digital Transformation Post Types
  
function diwp_create_shortcode_digital_post_type(){
  
    $args = array(
                    'post_type'      => 'digital', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            
                <div class="media-object">
                
                    <div class="media-title">
                        <h3><?php the_title(); ?></h3>
                        <a href="<?php the_permalink(); ?>">Learn More </a>
                    </div>

                    <div class="media-image">
                        <?php the_post_thumbnail(); ?>
                    </div>

                </div>

  
            <?php $i++; endwhile;  
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'digital-list', 'diwp_create_shortcode_digital_post_type' );



// Create Shortcode to Display Business Transformation Post Types
  
function diwp_create_shortcode_business_post_type(){
  
    $args = array(
                    'post_type'      => 'business', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            
                <div class="media-object">
                
                    <div class="media-title">
                        <h3><?php the_title(); ?></h3>
                        <a href="<?php the_permalink(); ?>">Learn More </a>
                    </div>

                    <div class="media-image">
                        <?php the_post_thumbnail(); ?>
                    </div>

                </div>

  
            <?php $i++; endwhile;  
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'business-list', 'diwp_create_shortcode_business_post_type' );



// Create Shortcode to Display Tech Transformation Post Types
  
function diwp_create_shortcode_tech_post_type(){
  
    $args = array(
                    'post_type'      => 'tech', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            
                <div class="media-object">
                
                    <div class="media-title">
                        <h3><?php the_title(); ?></h3>
                        <a href="<?php the_permalink(); ?>">Learn More </a>
                    </div>

                    <div class="media-image">
                        <?php the_post_thumbnail(); ?>
                    </div>

                </div>

  
            <?php $i++; endwhile;  
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'tech-list', 'diwp_create_shortcode_tech_post_type' );


// Create Shortcode to Display Team Post Types
  
function diwp_create_shortcode_eventinfo_post_type(){
    echo '<div class="conference-item row">'; 
    $args = array(  
        'order'     => 'DESC',
    );  
    $product_categories = get_terms( 'event-categories', $args );  
    $count = count($product_categories);
    // echo '<pre>';
    // print_r($product_categories); 
    // echo '</pre>';
    if ( $count > 0 ){  
        foreach ( $product_categories as $product_category ) {
    
            //echo '<h4 class="mb-4 custom '. $product_category->slug .'">' . $product_category->name . '</h4>';

               

                $args =array('posts_per_page' => -1,
                            'post_type' => 'event-list',
                            'order' => 'ASC',                                
                            'tax_query' => array('relation' => 'AND',  
                                                array(  'taxonomy' => 'event-categories',
                                                    'field' => 'slug',
                                                    'terms' => $product_category->slug  
                                                    )  
                                                ),  
                            );  
                $products = new WP_Query( $args );  
    
                while ( $products->have_posts() ) { $products->the_post();  ?> 
                <div class="col-md-3 mb-4">
                        <div class="item <?php echo $product_category->slug ?>">
							<div class="pic-sec event-list">
                                <a href="<?php the_permalink();?>">
                                    <?php the_post_thumbnail(); ?>
                                    <span><?php the_field('add_date'); ?></span>
                                    <h3 class="custom"><?php echo $product_category->name ?></h3>
                                </a>
							</div> 
							<div class="content-sec">
								<h4>
                                    <a href="<?php the_permalink();?>">
                                        <?php the_title(); ?> <br/>
                                        <em><?php echo get_the_excerpt();?></em>
                                    </a>
                                </h4>
								<div class="link-sec">
									<a href="<?php the_permalink();?>" class="explore-now"> See More</a>
								</div>
							</div>
						</div>
                </div> 
                   
         <?php  }  wp_reset_query();

        
    
        }  
        
    }

    echo '</div>';
  
                
}
  
add_shortcode( 'eventinfo-list', 'diwp_create_shortcode_eventinfo_post_type' );




function diwp_create_shortcode_digital_service_post_type(){
  
    $args = array(
                    'post_type'      => 'digital', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :

        echo '<div class="our-industry service-list"> <div class="row">';
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            
                <div class="col-md-4 mb-4">
                    <div class="cover">
                        <div class="thumb-pic">
                            <img src="<?php the_field('add_service_list_picture'); ?>" class="img-fluid" />
                        </div>
                        <div class="content-sec">
                            <h3><?php the_title();?></h3>
                            <?php the_content(); ?>
                            <a href="<?php the_field('add_details_page_link') ?>" class="learn-more mt-3">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

  
            <?php $i++; endwhile;  

            echo '</div> </div>';
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'digitalservice-list', 'diwp_create_shortcode_digital_service_post_type' );




function diwp_create_shortcode_business_service_post_type(){
  
    $args = array(
                    'post_type'      => 'business', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :

        echo '<div class="our-industry service-list"> <div class="row">';
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            
                <div class="col-md-4 mb-4">
                    <div class="cover">
                        <div class="thumb-pic">
                            <img src="<?php the_field('add_service_list_picture'); ?>" class="img-fluid" />
                        </div>
                        <div class="content-sec">
                            <h3><?php the_title();?></h3>
                            <?php the_content(); ?>
                            <a href="<?php the_permalink();?>" class="learn-more mt-3">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

  
            <?php $i++; endwhile;  

            echo '</div> </div>';
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'businessservice-list', 'diwp_create_shortcode_business_service_post_type' );



function diwp_create_shortcode_tech_service_post_type(){
  
    $args = array(
                    'post_type'      => 'tech', // don't forget to replace it with your custom post type name
                    'posts_per_page' => '-1',
                    'order' => 'ASC',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :

        echo '<div class="our-industry service-list"> <div class="row">';
        $i = 1;
        while($query->have_posts()) :
  
            $query->the_post() ; 
            
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            ?>

            
                <div class="col-md-4 mb-4">
                    <div class="cover">
                        <div class="thumb-pic">
                            <img src="<?php the_field('add_service_list_image'); ?>" class="img-fluid" />
                        </div>
                        <div class="content-sec">
                            <h3><?php the_title();?></h3>
                            <?php the_content(); ?>
                            <a href="<?php the_permalink();?>" class="learn-more mt-3">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

  
            <?php $i++; endwhile;  

            echo '</div> </div>';
        
                wp_reset_postdata();
        
            endif;    
  
                
}
  
add_shortcode( 'techservice-list', 'diwp_create_shortcode_tech_service_post_type' );


// Remove version from css/js
function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 1000 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 1000 );




// Add excerpt to every page
add_action('init', 'my_custom_init');
function my_custom_init() {
    add_post_type_support( 'page', 'excerpt' );
}

add_filter( 'get_custom_logo', 'change_logo_class' );


function change_logo_class( $html ) {

    //$html = str_replace( 'custom-logo', 'logo', $html );

    $html = str_replace( 'custom-logo-link', 'navbar-brand', $html );

    return $html;
}

add_theme_support( 'custom-logo' );
function retro_setup() {
    add_theme_support( 'custom-logo', array(
		'width'       => 203,
		'height'      => 140,
		'flex-height' => true,
        'flex-width'  => true,
	) );
}

add_action('after_setup_theme', 'retro_setup',200);


add_filter( 'nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 3 );

function wpse156165_menu_add_class( $atts, $item, $args ) {
    $class = 'nav-link'; // or something based on $item
    $atts['class'] = $class;
    return $atts;
}


if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'trending-pic', 66, 66 );
    add_image_size( 'home-news-pic', 265, 203 );
    add_image_size( 'article-pic', 42, 42 );
    add_image_size( 'footer-logo-pic', 295, 37 );
	//add_image_size( 'ebook-pic', 598, 370, array('center', 'top') );
}


function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);



function wpb_tag_cloud() { 
    $tags = get_tags();
    $args = array(
        'smallest'                  => 10, 
        'largest'                   => 10,
        'unit'                      => 'px', 
        'number'                    => 10,  
        'format'                    => 'flat',
        'separator'                 => " ",
        'orderby'                   => 'random', 
        'order'                     => 'ASC',
        'show_count'                => 0,
        'echo'                      => false
    ); 
     
    $tag_string = wp_generate_tag_cloud( $tags, $args );
     
    return $tag_string; 
     
    } 
    // Add a shortcode so that we can use it in widgets, posts, and pages
    add_shortcode('wpb_popular_tags', 'wpb_tag_cloud'); 
     
    // Enable shortcode execution in text widget
    add_filter ('widget_text', 'do_shortcode'); 


function wpb_widgets_init() {
 

    register_sidebar( array(
        'name' =>__( 'Blog page sidebar', 'wpb'),
        'id' => 'sidebar-2',
        'description' => __( 'Appears on the blog page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_init' );


function weichie_load_more() {
    $post_id = get_the_ID();
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        //$exclude_ids = array( 1, 2, 3 );
        'posts_per_page' => 1,
        'post__not_in' => array($post_id),
        'paged' => $_POST['paged'],
    );
    $arr_posts = new WP_Query( $args );
  
    $response = '';
  
    if($arr_posts->have_posts()) {
      while($arr_posts->have_posts()) : $arr_posts->the_post();
        //$response .= get_template_part( 'template-parts/content/content-single' );

        $response .= '<div class="col-md-6 ">
            <div class="blog-loop">
                    <div class="media-pic">
                        '.get_the_post_thumbnail($post_id, "full", array("class" => "img-fluid")).'
                    </div>
                    <div class="post-details">
                        <ul class="top-list">
                            <li> '.get_field("add_blog_date").'</li>
                            <li> '.get_field("add_reading_time").' min read </li>
                        </ul>
                        <h2> '.get_the_title().' </h2>
                        <p> '.get_the_excerpt().'</p>
                    </div>

            </div>
        </div>';
      endwhile;
    } else {
      $response = '';
    }
  
    echo $response;
    exit;
  }
  add_action('wp_ajax_weichie_load_more', 'weichie_load_more');
  add_action('wp_ajax_nopriv_weichie_load_more', 'weichie_load_more');


  flush_rewrite_rules(true);

  add_action('wp_ajax_filter_projects', 'filter_projects');
  add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

  function filter_projects() {
    $event_id = $_REQUEST['event_id'];
    $event_id_list = $_REQUEST['event_id_list'];
    $flag = $_REQUEST['flag'];
    if($flag==0)
    {
        $event_ids=rtrim($event_id_list,",");
        $event_id_arr=explode(",",$event_ids);
       
        if(count($event_id_arr)>0)
        {
            for($i=0;$i<count($event_id_arr);$i++)
            { 
                $event_id=$event_id_arr[$i];//die();
                if( have_rows('add_conference_videos',$event_id_arr[$i]) )
                {
                    $j=1; while( have_rows('add_conference_videos',$event_id_arr[$i]) ): the_row(); 
                        $add_video_file = get_sub_field('add_video');
                        $add_video_name = get_sub_field('add_video_name');
                        $add_video_date = get_sub_field('add_video_upload_date');
                        $add_video_thumbnail = get_sub_field('add_video_thumbnail');
                        $add_you_tube_link = get_sub_field('add_you_tube_link');
                            if($add_you_tube_link)
                            {
                                $class="popup-youtube";
                                $link=$add_you_tube_link;
                            }
                            else
                            {
                                $class="popup-with-form";
                                $link="#vid-".$i.$j;
                            }
                            $html.='<div class="col-md-3 px-2 py-2 gallery-item">
                            <div class="hover-overlay">
                                <img src="'.$add_video_thumbnail.'" class="img-fluid" />
                                <div class="item-overlay"></div>

                                <div class="event-img-meta white-color">
                                    <h5>'.$add_video_name.'</h5>   
                                            
                                            <p>['.$add_video_date.']</p>
                                </div>

                                <div class="image-zoom icon-xl white-color">
                                    <a class="'.$class.'" 
                                    href="'.$link.'">
                                        <span class="fa-regular fa-circle-play"></span>
                                    </a>
                                </div>
                            </div>

                            <div id="#vid-'.$i.$j.'" class="white-popup-block mfp-hide ">
                                <video class="pop-videos img-fluid" controls>
                                    <source src="'.$add_video_file['url'].'" type="video/mp4">
                                </video> 
                                
                            </div> 
                        </div>';
                        
                    $j++; endwhile;
                }
            }
            echo $html;
            exit;
        }
        
    }
    else
    {
    
        if( have_rows('add_conference_videos',$event_id) )
        {
            $j=1; while( have_rows('add_conference_videos',$event_id) ): the_row(); 
                $add_video_file = get_sub_field('add_video');
                $add_video_name = get_sub_field('add_video_name');
                $add_video_date = get_sub_field('add_video_upload_date');
                $add_video_thumbnail = get_sub_field('add_video_thumbnail');
                $add_you_tube_link = get_sub_field('add_you_tube_link');

                if($add_you_tube_link)
                {
                    $class="popup-youtube";
                    $link=$add_you_tube_link;
                }
                else
                {
                    $class="popup-with-form";
                    $link="#vid-".$i.$j;
                }
                
                    $html.='<div class="col-md-3 px-2 py-2 gallery-item">
                    <div class="hover-overlay">
                        <img src="'.$add_video_thumbnail.'" class="img-fluid" />
                        <div class="item-overlay"></div>

                        <div class="event-img-meta white-color">
                            <h5>'.$add_video_name.'</h5>     
                            <p>['.$add_video_date.']</p>
                        </div>

                        <div class="image-zoom icon-xl white-color">
                            <a class="'.$class.'" 
                            href="'.$link.'">
                                <span class="fa-regular fa-circle-play"></span>
                            </a>
                        </div>
                    </div>

                    <div id="#vid-'.$i.$j.'" class="white-popup-block mfp-hide ">
                        <video class="pop-videos img-fluid" controls>
                            <source src="'.$add_video_file['url'].'" type="video/mp4">
                        </video> 
                    </div>
                </div>';
                
                $j++; endwhile;
        }
        else
        {
            $html="<p>No Videos Found</p>" ;
        }
        echo $html;
        exit;
    }
  
    
  }


  

  add_action('wp_ajax_session_type', 'session_type');
  add_action('wp_ajax_nopriv_session_type', 'session_type');

  function session_type(){
    $session_type = $_REQUEST['session_type'];
    $html="";
    //echo  $session_type; die();
    $args = array(
        'post_type' => 'event-list',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'order_by' => 'date',
        'order' => 'ASC',
    );
        $events = new WP_Query($args);
        
    

    while($events->have_posts()): $events->the_post(); 
        while( have_rows('add_event_details') ): the_row(); 
            while( have_rows('add_events') ): the_row(); 
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

            if($add_session_type==$session_type)
            {
                $html.='<li>
                                <h4 class="d-flex align-items-center">
                                    <span class="pr-2 event-date">
                                        '.$start_time.'
                                    </span>
                                    <hr class="ml-2">
                                </h4>
                                <div class="row my-2">
                                    <div class="col-md-2">
                                        <img src="'.$sponser_img.'" class="img-fluid" />
                                    </div>
                                    <div class="col-md-8">
                                        <em>'.$add_track.'</em>  &nbsp;
                                        <em>
                                            '.$start_time.' '.$end_time.'
                                        </em> &nbsp;
                                        <span class="session-type">'.$add_session_type.'</span>
                                        <h5 class="text-uppercase mt-2">'.$add_subject_details.'</h5>
                                        '.$short_desc.'
                                        
                                        <span class="speaker-details" data-toggle="tooltip">
                                            '.$speaker_name.'
                                        </span>

                                        
                                        <span class="hall_number">Hall '.$add_hall_number.'</span>
                                        

                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </li>';
            }

        endwhile;
        endwhile;
    endwhile;

     echo $html;
    exit;

  }


  add_action('wp_ajax_track_list', 'track_list');
  add_action('wp_ajax_nopriv_track_list', 'track_list');

  function track_list(){
    $track_list = $_REQUEST['track_list'];
    $html="";
    //echo  $session_type; die();
    $args = array(
        'post_type' => 'event-list',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'order_by' => 'date',
        'order' => 'ASC',
    );
        $events = new WP_Query($args);
        
    

    while($events->have_posts()): $events->the_post(); 
        while( have_rows('add_event_details') ): the_row(); 
            while( have_rows('add_events') ): the_row(); 
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

            if($add_track==$track_list)
            {
                $html.='<li>
                                <h4 class="d-flex align-items-center">
                                    <span class="pr-2 event-date">
                                        '.$start_time.'
                                    </span>
                                    <hr class="ml-2">
                                </h4>
                                <div class="row my-2">
                                    <div class="col-md-2">
                                        <img src="'.$sponser_img.'" class="img-fluid" />
                                    </div>
                                    <div class="col-md-8">
                                        <em>'.$add_track.'</em>  &nbsp;
                                        <em>
                                            '.$start_time.' '.$end_time.'
                                        </em> &nbsp;
                                        <span class="session-type">'.$add_session_type.'</span>
                                        <h5 class="text-uppercase mt-2">'.$add_subject_details.'</h5>
                                        '.$short_desc.'
                                        
                                        <span class="speaker-details" data-toggle="tooltip">
                                            '.$speaker_name.'
                                        </span>

                                        
                                        <span class="hall_number">Hall '.$add_hall_number.'</span>
                                        

                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </li>';
            }

        endwhile;
        endwhile;
    endwhile;

     echo $html;
    exit;

  }