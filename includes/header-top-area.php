<?php $translate['wpml-no'] = mfn_opts_get('translate') ? mfn_opts_get('translate-wpml-no','No translations available for this page') : __('No translations available for this page','betheme'); ?>

<?php if( mfn_opts_get('action-bar')): ?>
	<div id="Action_bar">
		<div class="container">
			<div class="column one">
			
				<ul class="contact_details">
					<?php
						if( $header_slogan = mfn_opts_get( 'header-slogan' ) ){
							echo '<li class="slogan">'. $header_slogan .'</li>';
						}
						if( $header_phone = mfn_opts_get( 'header-phone' ) ){
							echo '<li class="phone"><i class="icon-phone"></i><a href="tel:'. str_replace(' ', '', $header_phone) .'">'. $header_phone .'</a></li>';
						}					
						if( $header_phone_2 = mfn_opts_get( 'header-phone-2' ) ){
							echo '<li class="phone"><i class="icon-phone"></i><a href="tel:'. str_replace(' ', '', $header_phone_2) .'">'. $header_phone_2 .'</a></li>';
						}					
						if( $header_email = mfn_opts_get( 'header-email' ) ){
							echo '<li class="mail"><i class="icon-mail-line"></i><a href="mailto:'. $header_email .'">'. $header_email .'</a></li>';
						}
					?>
				</ul>
				
				<?php 
					if( has_nav_menu( 'social-menu' ) ){

						// #social-menu
						mfn_wp_social_menu();

					} else {

						$target = mfn_opts_get('social-target') ? 'target="_blank"' : false;
						
						echo '<ul class="social">';
							if( mfn_opts_get('social-skype') ) echo '<li class="skype"><a '.$target.' href="'. mfn_opts_get('social-skype') .'" title="Skype"><i class="icon-skype"></i></a></li>';
							if( mfn_opts_get('social-facebook') ) echo '<li class="facebook"><a '.$target.' href="'. mfn_opts_get('social-facebook') .'" title="Facebook"><i class="icon-facebook"></i></a></li>';
							if( mfn_opts_get('social-googleplus') ) echo '<li class="googleplus"><a '.$target.' href="'. mfn_opts_get('social-googleplus') .'" title="Google+"><i class="icon-gplus"></i></a></li>';
							if( mfn_opts_get('social-twitter') ) echo '<li class="twitter"><a '.$target.' href="'. mfn_opts_get('social-twitter') .'" title="Twitter"><i class="icon-twitter"></i></a></li>';
							if( mfn_opts_get('social-vimeo') ) echo '<li class="vimeo"><a '.$target.' href="'. mfn_opts_get('social-vimeo') .'" title="Vimeo"><i class="icon-vimeo"></i></a></li>';
							if( mfn_opts_get('social-youtube') ) echo '<li class="youtube"><a '.$target.' href="'. mfn_opts_get('social-youtube') .'" title="YouTube"><i class="icon-play"></i></a></li>';						
							if( mfn_opts_get('social-flickr') ) echo '<li class="flickr"><a '.$target.' href="'. mfn_opts_get('social-flickr') .'" title="Flickr"><i class="icon-flickr"></i></a></li>';
							if( mfn_opts_get('social-linkedin') ) echo '<li class="linkedin"><a '.$target.' href="'. mfn_opts_get('social-linkedin') .'" title="LinkedIn"><i class="icon-linkedin"></i></a></li>';
							if( mfn_opts_get('social-pinterest') ) echo '<li class="pinterest"><a '.$target.' href="'. mfn_opts_get('social-pinterest') .'" title="Pinterest"><i class="icon-pinterest"></i></a></li>';
							if( mfn_opts_get('social-dribbble') ) echo '<li class="dribbble"><a '.$target.' href="'. mfn_opts_get('social-dribbble') .'" title="Dribbble"><i class="icon-dribbble"></i></a></li>';
							if( mfn_opts_get('social-instagram') ) echo '<li class="instagram"><a '.$target.' href="'. mfn_opts_get('social-instagram') .'" title="Instagram"><i class="icon-instagram"></i></a></li>';
							if( mfn_opts_get('social-behance') ) echo '<li class="behance"><a '.$target.' href="'. mfn_opts_get('social-behance') .'" title="Behance"><i class="icon-behance"></i></a></li>';
							if( mfn_opts_get('social-tumblr') ) echo '<li class="tumblr"><a '.$target.' href="'. mfn_opts_get('social-tumblr') .'" title="Tumblr"><i class="icon-tumblr"></i></a></li>';
							if( mfn_opts_get('social-vkontakte') ) echo '<li class="vkontakte"><a '.$target.' href="'. mfn_opts_get('social-vkontakte') .'" title="VKontakte"><i class="icon-vkontakte"></i></a></li>';
							if( mfn_opts_get('social-viadeo') ) echo '<li class="viadeo"><a '.$target.' href="'. mfn_opts_get('social-viadeo') .'" title="Viadeo"><i class="icon-viadeo"></i></a></li>';
							if( mfn_opts_get('social-xing') ) echo '<li class="xing"><a '.$target.' href="'. mfn_opts_get('social-xing') .'" title="Xing"><i class="icon-xing"></i></a></li>';
							if( mfn_opts_get('social-rss') ) echo '<li class="rss"><a '.$target.' href="'. get_bloginfo('rss2_url') .'" title="RSS"><i class="icon-rss"></i></a></li>';
						echo '</ul>';
				
					}
				?>

			</div>
		</div>
	</div>
<?php endif; ?>

<?php 
	if( mfn_header_style( true ) == 'header-overlay' ){
		
		// Overlay ----------
		echo '<div id="Overlay">';
			mfn_wp_overlay_menu();
		echo '</div>';
		
		// Button ----------
		echo '<a class="overlay-menu-toggle" href="#">';
			echo '<i class="open icon-menu"></i>';
			echo '<i class="close icon-cancel"></i>';
		echo '</a>';
		
	}
?>

<!-- .header_placeholder 4sticky  -->
<div class="header_placeholder"></div>

<div id="Top_bar" class="loading mps-top-bar">

	<div class="container">
		<div class="column one">
		
			<div class="top_bar_left mps-header-background clearfix">
			
				<!-- .logo -->
				<div class="logo<?php if( $textlogo = mfn_opts_get('logo-text') ) echo ' text-logo'; ?> clearfix">

					<?php 
						// Logo | Options
						$logo_options = mfn_opts_get( 'logo-link' ) ? mfn_opts_get( 'logo-link' ) : false;
						$logo_before = $logo_after = '';

						// Logo | Link
						if( isset( $logo_options['link'] ) ){
							$logo_before 	= '<a id="logo" href="'. get_home_url() .'" title="'. get_bloginfo( 'name' ) .'">';
							$logo_after 	= '</a>';
						} else {
							$logo_before 	= '<span id="logo">';
							$logo_after 	= '</span>';
						}
						
						// Logo | H1
						if( is_front_page() ){
							if( is_array( $logo_options ) && isset( $logo_options['h1-home'] )){
								$logo_before = '<h1>'. $logo_before;
								$logo_after .= '</h1>';
							}
						} else {
							if( is_array( $logo_options ) && isset( $logo_options['h1-all'] )){
								$logo_before = '<h1>'. $logo_before;
								$logo_after .= '</h1>';
							}
						}
						
						// Logo | Source
						if( $layoutID = mfn_layout_ID() ){
						
							$logo_src 		= get_post_meta( $layoutID, 'mfn-post-logo-img', true );
							$logo_sticky 	= get_post_meta( $layoutID, 'mfn-post-sticky-logo-img', true ) ? get_post_meta( $layoutID, 'mfn-post-sticky-logo-img', true ) : $logo_src;
							$logo_mobile 	= $logo_src;
													
						} else {
						
							$logo_src 		= mfn_opts_get( 'logo-img', THEME_URI .'/images/logo/logo.png' );
							$logo_sticky 	= mfn_opts_get( 'sticky-logo-img' ) ? mfn_opts_get( 'sticky-logo-img' ) : $logo_src;
							$logo_mobile 	= mfn_opts_get( 'responsive-logo-img' ) ? mfn_opts_get( 'responsive-logo-img' ) : $logo_src;
						
						}
						
						// Logo | SVG width
						if( $width = mfn_opts_get( 'logo-width' ) ){
							$width = 'width="'. $width .'"';
						} else {
							$width = false;
						}
						
						// Logo | Print
						echo $logo_before;

							if( $textlogo ){
								
								echo $textlogo;
								
							} else {
								
								echo '<a href="'.home_url(). '"><img class="logo-main   scale-with-grid" src="'. $logo_src .'" 	alt="'. get_bloginfo( 'name' ) .'" '. $width .'/></a>';
								echo '<a href="'.home_url(). '"><img class="logo-sticky scale-with-grid" src="'. $logo_sticky .'" alt="" '. $width .'/></a>';
								echo '<a href="'.home_url(). '"><img class="logo-mobile scale-with-grid" src="'. $logo_mobile .'" alt="" '. $width .'/></a>';
								
							}
							
						echo $logo_after;
					?>


					<img onclick="window.open('http://icheckup.com?PA=522194&TabID=2&Click=1','ScoreCard','scrollbars=yes,toolbar=no,location=center,menubar=no');" class= 'mps-patientApproved' src="<?php echo get_stylesheet_directory_uri(); ?>/images/patient-approved.png">

					<div class="mps-topContactInfo">
						<p><a href="<?php echo site_url(); ?>/contact-us/">Contact Us:</a></p>
						<p><a href="<?php echo site_url(); ?>/contact-us/">410-553-9444</a></p>
					</div><!-- /topContactInfo -->

				</div>
			
				<div class="menu_wrapper">

					<div class="mps-tablet-icons-container">
						<div class="mps-tablet-icons-1">
							<div class="mps-tablet-phone">
								<h3><a href="<?php echo site_url(); ?>/contact-us/">410-553-9444</a></h3>
							</div><!-- /mps-contact-icon -->		
						</div><!-- /mps-tablet-icons -->
						<div class="mps-tablet-icons-2">
							<div class="mps-patientApproved-tablet">
								<img onclick="window.open('http://icheckup.com?PA=522194&TabID=2&Click=1','ScoreCard','scrollbars=yes,toolbar=no,location=center,menubar=no');" src="<?php echo get_stylesheet_directory_uri(); ?>/images/patient-approved.png">
							</div><!-- /mps-patientApproved-tablet -->
						</div><!-- /mps-tablet-icons -->
					</div><!-- /mps-tablet-icons-container clearfix -->

					<div class="mps-mobile-icons-container clearfix">
						<div class="mps-mobile-icons">
							<a href="<?php echo site_url(); ?>/testimonials/">
								<div class="mps-reviews-icon"></div><!-- /mps-reviews-icon -->
								<h3>REVIEWS</h3>
							</a>
						</div><!-- /mps-mobile-icons -->
						<div class="mps-mobile-icons">
							<a href="<?php echo site_url(); ?>/location/">
								<div class="mps-location-icon"></div><!-- /mps-locations-icon -->
								<h3>LOCATION</h3>
							</a>
						</div><!-- /mps-mobile-icons -->
						<div class="mps-mobile-icons">
							<a href="<?php echo site_url(); ?>/contact-us/">
								<div class="mps-contact-icon"></div><!-- /mps-contact-icon -->
								<h3>CONTACT</h3>
							</a>
						</div><!-- /mps-mobile-icons -->
					</div><!-- /mps-mobile-icons-container -->
		
					<?php 
						if( ( mfn_header_style( true ) != 'header-overlay' ) && ( mfn_opts_get( 'menu-style' ) != 'hide' ) ){
	
							// TODO: modify the mfn_header_style() function to be able to find the text 'header-split' in headers array
							
							// #menu --------------------------
							if( in_array( mfn_header_style(), array('header-split','header-below header-split') ) ){
								// split -------
								mfn_wp_split_menu();
							} else { 
								// default -----
							?>
								<div class='mps-nav-toggle'>
									<?php mfn_wp_nav_menu(); ?>
								</div>
							<?php }
						
							// responsive menu button ---------
							$mb_class = '';
							if( mfn_opts_get('header-menu-mobile-sticky') ) $mb_class .= ' is-sticky';

							echo '<div class="mps-menu-toggle"><a class="responsive-menu-toggle '. $mb_class .'" href="#">';
								if( $menu_text = mfn_opts_get( 'header-menu-text' ) ){
									echo '<span>'. $menu_text .'</span>';
								} else {
									echo '<i class="icon-menu"></i><div class="mps-mobile-icons-menutext"><h3>MENU</h3></div>';
								}  
							echo '</a></div>';
							
						}
					?>					
				</div>			
				
				<div class="secondary_menu_wrapper">
					<!-- #secondary-menu -->
					<?php mfn_wp_secondary_menu(); ?>
				</div>
							
			</div>

		</div>
	</div>
</div>