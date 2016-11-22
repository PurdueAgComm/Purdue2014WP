<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="maincontent col-lg-12 col-md-12 col-sm-12">

	<h1><?php the_title(); ?> <?php bloginfo('name'); ?></h1>

	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<div>
<input class="text" type="text" value=" " name="s" id="s" />
<input type="submit" class="submit button" name="submit" value="<?php _e('Search');?>" />
</div>
</form>


		</div>
	</div>
</div>


<?php get_footer(); ?>


