<?php /* Template name: News/Blog */ ?>
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

		<?php if( get_field('news_banner_image') ): ?>
			<img class="banner" src="<?php the_field('news_banner_image'); ?>">
			<?php endif; ?>

		<h1><?php wp_title(''); ?></h1>
			 
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div style="float:left; margin-right:5px;"><?php the_post_thumbnail('thumbnail'); ?></div>


			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	    		<p><em><?php the_time('l, F jS, Y'); ?></em></p>
	    	<hr>
			<?php the_excerpt ('Read on...'); ?>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</div>

		<?php get_sidebar('sidenav'); ?>	
		<?php get_sidebar('sidecontent'); ?>	

	</div>
</div>

<?php get_footer(); ?>
