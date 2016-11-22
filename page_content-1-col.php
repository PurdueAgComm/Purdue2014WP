<?php /* Template name: Content 1 Column */ ?>
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
		<div class="maincontent col-lg-12 col-md-12 col-sm-12">


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


	</div>
</div>

<?php get_footer(); ?>





