<?php

/* ---------------------------------------------------------------------------
 * Child Theme URI | DO NOT CHANGE
 * --------------------------------------------------------------------------- */
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );


/* ---------------------------------------------------------------------------
 * Define | YOU CAN CHANGE THESE
 * --------------------------------------------------------------------------- */

// White Label --------------------------------------------
define( 'WHITE_LABEL', false );

// Static CSS is placed in Child Theme directory ----------
define( 'STATIC_IN_CHILD', false );


/* ---------------------------------------------------------------------------
 * Enqueue Style
 * --------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'mfnch_enqueue_styles', 101 );
function mfnch_enqueue_styles() {
	
	// Enqueue the parent stylesheet
// 	wp_enqueue_style( 'parent-style', get_template_directory_uri() .'/style.css' );		//we don't need this if it's empty
	
	// Enqueue the parent rtl stylesheet
	if ( is_rtl() ) {
		wp_enqueue_style( 'mfn-rtl', get_template_directory_uri() . '/rtl.css' );
	}
	
	// Enqueue the child stylesheet
	wp_dequeue_style( 'style' );
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() .'/style.css' );

}


/* ---------------------------------------------------------------------------
 * Load Textdomain
 * --------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'mfnch_textdomain' );
function mfnch_textdomain() {
    load_child_theme_textdomain( 'betheme',  get_stylesheet_directory() . '/languages' );
    load_child_theme_textdomain( 'mfn-opts', get_stylesheet_directory() . '/languages' );
}

function mps_custom_js_file() {
	// Custom JS file
	wp_enqueue_script('child-scripts', get_stylesheet_directory_uri().'/js/child-scripts.js', array('jquery'), false, true);

}
add_action('wp_enqueue_scripts', 'mps_custom_js_file', 100);

/* ---------------------------------------------------------------------------
 * Column One [one] [/one]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_one' ) )
{
	function sc_one( $attr, $content = null )
	{
		if(is_page('Home')){
			$output  = '<div class="column one mps-home-col-one clearfix">';	
		}else{
			$output  = '<div class="column one">';
		}
		$output .= do_shortcode($content);
		$output .= '</div>'."\n";
		
	    return $output;
	}

}

/* ---------------------------------------------------------------------------
 * Testimonials [testimonials]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_testimonials' ) )
{
	function sc_testimonials( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'category' 		=> '',
			'orderby' 		=> 'menu_order',
			'order' 		=> 'ASC',
			'style' 		=> '',
			'hide_photos' 	=> '',
		), $attr));
		
		$args = array(
			'post_type' 			=> 'testimonial',
			'posts_per_page' 		=> -1,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts' 	=>1,
		);
		if( $category ) $args['testimonial-types'] = $category;
		
		$query_tm = new WP_Query();
		$query_tm->query( $args );
		
		$output = '<div class="mps-testimonials-container clearfix"><span class="mps-testimonials-title"><h3>Testimonials</h3></span>';
		if ($query_tm->have_posts())
		{
			$mpsReviews = "window.open('http://icheckup.com?PA=522194&TabID=2&Click=1','ScoreCard','scrollbars=yes,toolbar=no,location=center,menubar=no');";
			$output .= '<div class="testimonials_slider '. $style .'">';
			
				// photos | pagination (style == default)
				if( ! $style && ! $hide_photos ){
					$output .= '<ul class="slider_pager slider_images">';
						while ($query_tm->have_posts())
						{
							$query_tm->the_post();
							$output .= '<a href="#">';
								if( has_post_thumbnail() ){
									$output .= get_the_post_thumbnail( null, 'testimonials', array('class'=>'scale-with-grid' ) );
								} else {
									$output .= '<img class="scale-with-grid" src="'. THEME_URI .'/images/testimonials-placeholder.png" alt="'. get_post_meta(get_the_ID(), 'mfn-post-author', true) .'" />';
								}
							$output .= '</a>';
						}
						wp_reset_query();
					$output .= '</ul>';
				}
		
				// testimonials | contant
				$output .= '<ul class="testimonials_slider_ul">';
					while ($query_tm->have_posts())
					{
						$query_tm->the_post();
						$output .= '<li>';
						
							if( $style == 'single-photo' && ! $hide_photos ){
								$output .= '<div class="single-photo-img">';
									if( has_post_thumbnail() ){
										$output .= get_the_post_thumbnail( null, 'testimonials', array('class'=>'scale-with-grid' ) );
									} else {
										$output .= '<img class="scale-with-grid" src="'. THEME_URI .'/images/testimonials-placeholder.png" alt="'. get_post_meta(get_the_ID(), 'mfn-post-author', true) .'" />';
									}
								$output .= '</div>';
							}
							
							$output .= '<div class="bq_wrapper">';	
								$output .= '<blockquote>'. get_the_content() .'</blockquote>';	
							$output .= '</div>';
								
							$output .= '<div class="hr_dots"><span></span><span></span><span></span></div>';	
							
							$output .= '<div class="author">';
								$output .= '<h5>by ';
									if( $link = get_post_meta(get_the_ID(), 'mfn-post-link', true) ) $output .= '<a target="_blank" href="'. $link .'">';
										$output .= get_post_meta(get_the_ID(), 'mfn-post-author', true);
									if( $link ) $output .= '</a>';
								$output .= '</h5>';
								$output .= '<span class="company">'. get_post_meta(get_the_ID(), 'mfn-post-company', true) .'</span>';
							$output .= '</div>';
							
						$output .= '</li>';
					}
					wp_reset_query();
				$output .= '</ul>';
				
				// photos | pagination (style == single-photo)
				if( $style == 'single-photo' ){
					$output .= '<ul class="slider_pager slider_pagination">';
					while ($query_tm->have_posts())
					{
						$query_tm->the_post();
						$output .= '<a href="#">1</a>';
					}
					wp_reset_query();
					$output .= '</ul>';
				}
	
				// navigation
				$output .= '<a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>';
				$output .= '<a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>';
				
			$output .= '</div><span class="mps-span-button"><button onclick='.$mpsReviews.' target="_blank" class="mps-testimonials-readmore">READ MORE</button></span></div>'."\n";
		}
		
		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Testimonials List [testimonials_list]
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'sc_testimonials_list' ) )
{
	function sc_testimonials_list( $attr, $content = null )
	{
		extract(shortcode_atts(array(
			'category' 	=> '',
			'orderby' 	=> 'menu_order',
			'order' 	=> 'ASC',
		), $attr));
		
		$args = array(
			'post_type' 			=> 'testimonial',
			'posts_per_page' 		=> -1,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'ignore_sticky_posts' 	=>1,
		);
		if( $category ) $args['testimonial-types'] = $category;
		
		$query_tm = new WP_Query();
		$query_tm->query( $args );

		$output = '';
		if ($query_tm->have_posts())
		{
			$output .= '<div class="testimonials_list">';
			
			while ($query_tm->have_posts())
			{
				$query_tm->the_post();
				
				$gmt_timestamp = get_post_time('F jS, Y', true);
				// classes
				$class = '';
				if( ! has_post_thumbnail() ) $class .= 'no-img';

				$output .= '<div class="item '. $class .'">';
				
					if( has_post_thumbnail() ){
						$output .= '<div class="photo">';
							$output .= '<div class="image_frame no_link scale-with-grid has_border">';
								$output .= '<div class="image_wrapper">';
									$output .= get_the_post_thumbnail( null, 'full', array('class'=>'scale-with-grid' ) );
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					}
					
					$output .= '<div class="desc">';
					
						$output .= '<h4>'. get_the_title() . '<span class="mps-cilent"> - ';
							if( $link = get_post_meta(get_the_ID(), 'mfn-post-link', true) ) $output .= '<a target="_blank" href="'. $link .'">';
								$output .= get_post_meta(get_the_ID(), 'mfn-post-author', true);
							if( $link ) $output .= '</a>';
						$output .= '</span></h4>';
						
						$output .= '<p class="subtitle">'. get_post_meta(get_the_ID(), 'mfn-post-company', true) .'</p>';
						$output .= '<hr class="hr_color" />';
						$output .= '<div class="blockquote">';
							$output .= '<blockquote>'. get_the_content() .'</blockquote>';
						$output .= '</div>';
						
					$output .= '<span class="mps-post-date">' . $gmt_timestamp . '</span>' . '</div>';
					
				$output .= '</div>'."\n";
			}
			wp_reset_query();
				
			$output .= '</div>'."\n";
		}
		
		return $output;
	}
}

add_filter( 'show_admin_bar' , '__return_false' );
?>