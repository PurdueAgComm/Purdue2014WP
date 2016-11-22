<?php /* Template name: Department 2 */ ?>
<?php get_header(); ?>



<div class="container">
	<div class="row">
		<div class="hero col-lg-8 col-md-8 col-sm-8" style="background-image:url('<?php the_field('dept2_carousel_image'); ?>');">


			<a href="<?php the_field('dept2_carousel_link'); ?>"></a>
			<div class="carousel-caption">				<h2><?php the_field('dept2_carousel_title'); ?></h2>
				<p><?php the_field('dept2_carousel_caption'); ?></p>
			</div>
		</div>

		<div class="deptaudience col-lg-4 col-md-4 col-sm-4">
			<div class="currentstudents col-lg-6 col-md-6 col-sm-12 col-xs-6"><a style="background-image:url('<?php the_field('box_1_image'); ?>');" href="<?php the_field('box_1_link'); ?>"><span class="caption"><?php the_field('box_1_text'); ?></span></a></div>
			<div class="prospectivestudents col-lg-6 col-md-6 col-sm-12 col-xs-6"><a style="background-image:url('<?php the_field('box_2_image'); ?>');" href="<?php the_field('box_2_link'); ?>"><span class="caption"><?php the_field('box_2_text'); ?></span></a></div>
			<div class="communityoutreach col-lg-6 col-md-6 col-sm-12 col-xs-6"><a style="background-image:url('<?php the_field('box_3_image'); ?>');" href="<?php the_field('box_3_link'); ?>"><span class="caption"><?php the_field('box_3_text'); ?></span></a></div>
			<div class="alumnidonors col-lg-6 col-md-6 col-sm-12 col-xs-6"><a style="background-image:url('<?php the_field('box_4_image'); ?>');" href="<?php the_field('box_4_link'); ?>"><span class="caption"><?php the_field('box_4_text'); ?></span></a></div>
		</div>

	</div>
	<div class="row">
		<div class="maincontent col-lg-9 col-md-9 col-sm-9 right">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php 
			/* IF statement to remove title from static front page */ 
			?>

			<?php if (is_front_page()) : ?>
			<?php else : ?>
			<h1 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php endwhile; else: ?>
				<p><?php _e('Sorry, this page does not exist.'); ?></p>
			<?php endif; ?>
		</div>
		<div class="feature col-lg-3 col-md-3 col-sm-3">
			<a href="<?php the_field('dept2_feature_link_one_url'); ?>"><?php the_field('dept2_feature_link_one_text'); ?></a> 
			<a href="<?php the_field('dept2_feature_link_two_url'); ?>"><?php the_field('dept2_feature_link_two_text'); ?></a>
			<a href="<?php the_field('dept2_feature_link_three_url'); ?>"><?php the_field('dept2_feature_link_three_text'); ?></a>
			<a href="<?php the_field('dept2_feature_link_four_url'); ?>"><?php the_field('dept2_feature_link_four_text'); ?></a>


		</div>
	</div>
</div>

<?php get_footer(); ?>






