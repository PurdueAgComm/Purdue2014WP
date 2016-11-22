<?php /* Template name: Content 3 Column */ ?>
<?php get_header(); ?>


<div class="breadcrumb">
  <div class="container">
    <div class="row">
      <div id="breadcrumbs">
          <?php the_breadcrumb(); ?>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="row">
		<div class="rightnav col-lg-2 col-md-2 col-sm-2 right">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar Navigation') ) : ?>
			<?php endif; ?>
		</div>

		<div class="maincontent col-lg-7 col-md-7 col-sm-7 right">
			
			<?php if( get_field('content_2_banner_image') ): ?>
			<img class="banner" src="<?php the_field('content_2_banner_image'); ?>">
			<?php endif; ?>
			 
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
		
		<?php get_sidebar( 'sidenav' ); ?>
		
		<?php get_sidebar('sidecontent'); ?>	

	</div>
</div>

<?php get_footer(); ?>





