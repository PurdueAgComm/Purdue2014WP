<?php /* Template name: Archives */ ?>
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

			<?php the_post(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<?php get_search_form(); ?>
			
			<h2>Archives by Month:</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
			
			<h2>Archives by Subject:</h2>
			<ul>
				 <?php wp_list_categories(); ?>
			</ul>

		</div>

		<?php get_sidebar('sidenav'); ?>	
		<?php get_sidebar('sidecontent'); ?>	

	</div>
</div>

<?php get_footer(); ?>