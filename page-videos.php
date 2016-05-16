<?php
/**
 * The template for displaying all pages.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();
?>
	
<!-- #Content -->
<div id="Content" class='mps-page'>

	<div id="mps-video-container">
		<div class="content_wrapper clearfix">

			<!-- .sections_group -->
			<div class="sections_group">
			
				<div class="entry-content" itemprop="mainContentOfPage">
					<?php 
						while ( have_posts() ){
							the_post();							// Post Loop
							mfn_builder_print( get_the_ID() );	?> 

							<div class="mps-video-post clearfix">
								<?php
								$the_query = new WP_Query('category_name=videos');
								while ( $the_query->have_posts() ) :
										$the_query->the_post(); ?>

									<div class="mps-video">
										<?php get_template_part( 'includes/content', 'single' ); ?>		
									</div><!-- /vimeoVid -->

								<?php
									endwhile;
									wp_reset_postdata();
								?>	
							</div><!-- /mps-video-post -->
		
					<?php } ?>
				</div>
				
				<?php if( mfn_opts_get('page-comments') ): ?>
					<div class="section section-page-comments">
						<div class="section_wrapper clearfix">
						
							<div class="column one comments">
								<?php comments_template( '', true ); ?>
							</div>
							
						</div>
					</div>
				<?php endif; ?>
		
			</div>
			
			<!-- .four-columns - sidebar -->
			<?php get_sidebar(); ?>

		</div>
	</div><!-- /id=mps-video-container -->
</div>

<?php get_footer(); ?>