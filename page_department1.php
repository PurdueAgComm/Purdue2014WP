<?php /* Template name: Department 1 */ ?>
<?php get_header(); ?>



<div class="container">
	<div class="row">
		<div class="hero col-lg-8 col-md-8 col-sm-8" style="background-image:url('<?php the_field('carousel_image'); ?>');">


			<a href="<?php the_field('carousel_link'); ?>"></a>
			<div class="carousel-caption">
				<h2><?php the_field('carousel_title'); ?></h2>
				<p><?php the_field('carousel_caption'); ?></p>
			</div>
		</div>

		<div class="feed col-lg-4 col-md-4 col-sm-4">
			<ul class="nav nav-tabs">
			<li class="active col-lg-4 col-md-4 col-sm-4 col-xs-4"><a data-toggle="tab" href="#news">News</a></li>
			<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a data-toggle="tab" href="#events">Events</a></li>
			<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a data-toggle="tab" href="#resources"><?php the_field('resources_heading'); ?></a></li>
			</ul>
			<div class="tab-content">

				<div class="tab-pane fade in active" id="news">

					<div class="news-tab"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('News Feed Tab') ) : ?>
					<?php endif; ?>
					</div>
					<!-- original script
					<script language="JavaScript" src="https://www.purdue.edu/newsroom/php/feed2js-hp-news/feed2js.php?src=https%3A%2F%2Fmarketing.purdue.edu%2FIntranet%2FPurdue%2FAdministration%2FMM%2FNews%2FFeatured%2Ffeed.rss&amp;num=5&amp;targ=y&amp;utf=y" charset="UTF-8" type="text/javascript"></script>

					<div class="rss-box">
						<ul class="rss-items"><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/newsroom/releases/2014/Q2/colombia-students-to-learn-from-research-at-purdue.html" target="_blank">Colombia students learn from research at Purdue</a><br></li><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/newsroom/releases/2014/Q3/study-boosting-neural-pathway-from-gut-to-brain-could-play-part-in-weight-control.html" target="_blank">Study: Boosting neural pathway from gut to brain could play part in weight control</a><br></li><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/newsroom/releases/2014/Q3/indiana-lt.-gov.-ellspermann-to-keynote-purdue-summer-commencement.html" target="_blank">Indiana Lt. Gov. Ellspermann to keynote Purdue summer commencement</a><br></li><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/newsroom/releases/2014/Q2/engineering-alumnus-gift-propels-zucrow-labs-expansion.html" target="_blank">Engineering alumnus' gift propels Zucrow labs expansion</a><br></li><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/timely-warnings/" target="_blank">Campus Safety and Timely Warnings</a><br></li></ul>
					</div>
					 -->
				</div>
				<div class="tab-pane fade" id="events">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Events Calendar Tab') ) : ?>
					<?php endif; ?>


					<!-- <script language="JavaScript" src="https://www.purdue.edu/newsroom/php/feed2js-hp-tmp-smb/feed2js.php?src=https%3A%2F%2Fmarketing.purdue.edu%2FIntranet%2FPurdue%2FAdministration%2FMM%2FNews%2FEvents%2Ffeed.rss&amp;num=5&amp;targ=y&amp;utf=y" charset="UTF-8" type="text/javascript"></script><div class="rss-box"><ul class="rss-items"><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/newsroom/releases/2014/Q3/mothers,-daughters-invited-to-learn-about-engineering.html" target="_blank">Aug. 2 - Mothers, daughters invited to learn about engineering</a><br></li><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/newsroom/releases/2014/Q3/purdue-day-at-indiana-state-fair-set-for-aug.-8.html" target="_blank">Aug. 8 - Purdue Day at Indiana State Fair</a><br></li><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/newsroom/releases/2014/Q3/purdue-extension-offers-education,-fun-at-state-fair.html" target="_blank">Aug. 8 - Purdue Extension offers education, fun at state fair</a><br></li><li class="rss-item"><a class="rss-item" href="http://www.purdue.edu/newsroom/releases/2014/Q2/purdue-galleries-presents-papercuts-in-three-galleries.html" target="_blank">Through Aug. 9 - Purdue Galleries presents 'Papercuts' in three galleries</a><br></li><li class="rss-item"><a class="rss-item" href="http://calendar.purdue.edu" target="_blank">Additional University Calendar Events &gt;&gt;</a><br></li></ul></div> -->
				</div>
				<div class="tab-pane fade" id="resources">
					<h3><?php the_field('resources_heading'); ?></h3>
					<?php the_field('resources_content'); ?>
				</div>
			</div>
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
			<a href="<?php the_field('feature_link_one_url'); ?>"><?php the_field('feature_link_one_text'); ?></a> 
			<a href="<?php the_field('feature_link_two_url'); ?>"><?php the_field('feature_link_two_text'); ?></a>
          <a href="<?php the_field('feature_link_three_url'); ?>"><?php the_field('feature_link_three_text'); ?></a>
		</div>
	</div>
</div>

<?php get_footer(); ?>






