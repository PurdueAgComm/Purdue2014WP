<?php
/**
 * The template for displaying 404 pages (Not Found).
 */
 
get_header(); ?>
 
  
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
        <div class="maincontent col-lg-9 col-md-9 col-sm-9 left">
            <div id="primary" class="content-area">
                <div id="content" class="site-content" role="main">
         
                    <article id="post-0" class="post error404 not-found">
                        <header class="entry-header">
                            <h1 class="entry-title"><?php _e( 'Sorry, Boilermaker. That page cannot be found.', 'purduetwentyfourteen' ); ?></h1>
                        </header><!-- .entry-header -->
         
                        <div class="entry-content">
                            <p>It looks like nothing was found at this location. Maybe try one of the links below or go back to the <a href="<?php bloginfo('url'); ?>">home page</a>?</p>
         
                            <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
         
                            <div class="widget">
                                <h2 class="widgettitle"><?php _e( 'Most Used Categories', 'purduetwentyfourteen' ); ?></h2>
                                <ul>
                                <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
                                </ul>
                            </div><!-- .widget -->
         
                            <?php
                            /* translators: %1$s: smilie */
                            $archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'purduetwentyfourteen' ), convert_smilies( ':)' ) ) . '</p>';
                            the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
                            ?>
         
                            <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
         
                        </div><!-- .entry-content -->
                    </article><!-- #post-0 .post .error404 .not-found -->
         
                </div><!-- #content .site-content -->
            </div><!-- #primary .content-area -->
        </div>
    </div>
</div>

<?php get_footer(); ?>