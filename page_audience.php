<?php 
/* Template name: Audience 
*/ ?>
<?php get_header(); ?>
<div class="content">

	<div class="audience" style="background-image: url('<?php the_field('audience_banner_image'); ?>') !important;">
	<!-- Change image by adding custom css
	.audience { background-image:url('path/to/image'); }
	 -->
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<h2><?php the_field('audience_banner_title'); ?></h2>	
						<p><?php the_field('audience_banner_text'); ?></p>

					<?php endwhile; else: ?>
						<p><?php _e('Sorry, this page does not exist.'); ?></p>
					<?php endif; ?>							
				</div>
				<div class="col-lg-7 col-md-7 col-sm-6">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<?php
						 
						if(get_field('button_1_url'))
						{
							echo '<a class="btn" href="' . get_field('button_1_url') . '" role="button">';
						}
						 
						?>
						<?php
						 
						if(get_field('button_1_text'))
						{
							echo get_field('button_1_text') . '</a>';
						}
						 
						?>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<?php
						 
						if(get_field('button_2_url'))
						{
							echo '<a class="btn" href="' . get_field('button_2_url') . '" role="button">';
						}
						 
						?>
						<?php
						 
						if(get_field('button_2_text'))
						{
							echo get_field('button_2_text') . '</a>';
						}
						 
						?>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<?php
						 
						if(get_field('button_3_url'))
						{
							echo '<a class="btn" href="' . get_field('button_3_url') . '" role="button">';
						}
						 
						?>
						<?php
						 
						if(get_field('button_3_text'))
						{
							echo get_field('button_3_text') . '</a>';
						}
						 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="resources">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="links col-lg-3 col-md-3 col-sm-3 col-xs-6">

						<?php if( get_field('resources_column_1_header') ): ?>
						<h6><?php the_field('resources_column_1_header'); ?></h6>
						<?php endif; ?>
						<?php if( get_field('resources_column_1_links') ): ?>	
						<?php the_field('resources_column_1_links'); ?>
						<?php endif; ?>
					</div>
					<div class="links col-lg-3 col-md-3 col-sm-3 col-xs-6">
						<?php if( get_field('resources_column_2_header') ): ?>
						<h6><?php the_field('resources_column_2_header'); ?></h6>
						<?php endif; ?>
						<?php if( get_field('resources_column_2_links') ): ?>	
						<?php the_field('resources_column_2_links'); ?>
						<?php endif; ?>
					</div>
					<div class="links col-lg-3 col-md-3 col-sm-3 col-xs-6">
						<?php if( get_field('resources_column_3_header') ): ?>
						<h6><?php the_field('resources_column_3_header'); ?></h6>
						<?php endif; ?>
						<?php if( get_field('resources_column_3_links') ): ?>	
						<?php the_field('resources_column_3_links'); ?>
						<?php endif; ?>
					</div>
					<div class="links col-lg-3 col-md-3 col-sm-3 col-xs-6">
						<?php if( get_field('resources_column_4_header') ): ?>
						<h6><?php the_field('resources_column_4_header'); ?></h6>
						<?php endif; ?>
						<?php if( get_field('resources_column_4_links') ): ?>	
						<?php the_field('resources_column_4_links'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="events">
		<div class="container">
			<div class="row">
				<div class="photo col-lg-4 col-md-4 col-sm-4" style="background-image: url('<?php the_field('events_image'); ?>') !important;">
				</div>

					
				
				<!-- Events calendar image
				
				Manually override the CSS in WP dashboard menu -> "Appearance" -> "Edit CSS" with the following:

				.events .photo {
				background-image: url('http://path/to/image') !important; 
				}

				Image size should be 640px wide by 430px high. The image view will change dynamically on the page depending at what device (mobile phone, tablet or computer) is being used to view the page.

				 -->


				<div class="col-lg-8 col-md-8 col-sm-8">
					<h4><?php the_field('events_feed_header'); ?></h4>

					<script src="http://feed2js.org//feed2js.php?src=http%3A%2F%2Fwww.purdue.edu%2Fnewsroom%2Frss%2FEventNews.xml&amp;num=3&amp;date=y&amp;targ=y&amp;utf=y" charset="UTF-8" language="JavaScript"></script>

				</div>
				

			
				

			

				


				
			</div>
		</div>
	</div>
	<div class="audiencefeature" style="background-image:url('<?php the_field('audience_feature_image'); ?>');">

		
		<div class="container">
			<div class="row">
				<div class="caption col-lg-5 col-md-5 col-sm-6">
				<h3><?php the_field('featured_title'); ?></h3>
				<p><?php the_field('featured_text'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>





