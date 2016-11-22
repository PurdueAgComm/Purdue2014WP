<?php
/* Theme setup */


/* Theme setup */
add_action( 'after_setup_theme', 'purduetwentyfourteen_setup' );
    if ( ! function_exists( 'purduetwentyfourteen_setup' ) ):
        function purduetwentyfourteen_setup() {  
            register_nav_menu( 'primary', __( 'Primary navigation', 'purduetwentyfourteen' ) );
        } endif;

/* 
add_action( 'after_setup_theme', 'purduetwentyfourteen_setup' );
    if ( ! function_exists( 'purduetwentyfourteen_setup' ) ):
        function purduetwentyfourteen_setup() {  
            register_nav_menus( array(
			    'primary' => __( 'Primary Navigation Menu', 'purduetwentyfourteen' ),
			    secondary' => __( 'Information Menu', 'purduetwentyfourteen' ),
			    'tertiary' => __( 'Quick Links Menu', 'purduetwentyfourteen' ), 
			) );
        } endif;
*/

/* Bootstrap core JavaScript */
/*  Placed in functions.php as recommended by WordPress */

function purduetwentyfourteen_scripts() {
	wp_enqueue_style( 'bootstrap.min', get_stylesheet_uri() );
    wp_enqueue_script('bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array(), true
);
}

add_action( 'wp_enqueue_scripts', 'purduetwentyfourteen_scripts' );



// Register Bootstrap custom navigation walker

require_once('wp_bootstrap_navwalker.php');

add_theme_support( 'post-thumbnails' );

// Image size for single posts
add_image_size( 'single-post-thumbnail', 652, 235 );

add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function my_post_image_html( $html, $post_id, $post_image_id ) {
    $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
    return $html;
}


/*
 * Breadcrumb function originally posted by Stuart on http://cazue.com and modded for Bootstrap 3 by Travis Kelleher https://gist.github.com/traviskelleher/11356562
 * http://cazue.com/articles/wordpress-creating-breadcrumbs-without-a-plugin-2013
 * This modified example also includes Dan Miller's fix for allowing parent/children pages with Boostrap 3's breadcrumb structure.
 * Instead of using text for the "Home" link, it now uses the icon "glyphicon-home" from Bootstrap.
 */

function the_breadcrumb() {
    global $post;
    echo '<ol class="col-lg-12 col-md-12 col-sm-12">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '"';
        echo 'title="Home">';
        echo '<span class="glyphicon glyphicon-home">';
        echo '</a></li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo '</li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>' . $output ;
                }
                echo $output;
                echo '<li class="active">'.$title.'</li>';
            } else {
                echo '<li class="active">'.get_the_title().'</li>';
            }
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ol>';
}

function purduetwentyfourteen_widgets_init() {

// Include Advanced Custom Fields plugin in theme
    if (is_file('/var/www/html/root/wordpress/wp-content/plugins/advanced-custom-fields-pro/acf.php')) {
	include_once('/var/www/html/root/wordpress/wp-content/plugins/advanced-custom-fields/acf.php');
    }
    elseif (is_file('/var/www/html/root/wordpress/wp-content/plugins/advanced-custom-fields/acf.php')) {
	include_once('/var/www/html/root/wordpress/wp-content/plugins/advanced-custom-fields/acf.php');
    }
    else {
	define( 'ACF_LITE', true);
    	include_once('advanced-custom-fields/acf.php');
    }


// Register Advanced Custom Fields. This is the default set for Purdue 2014 theme.

    if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_audience-template',
        'title' => 'Audience Template',
        'fields' => array (
            array (
                'key' => 'field_53f64a555d992',
                'label' => 'Audience Banner Image',
                'name' => 'audience_banner_image',
                'type' => 'image',
                'instructions' => 'Please use a 1200px x 575px  image size that is either black and white, or tinted in one of the audience color schemes: 
    Current Students - PMS 7473 (#2EAFA4)
    Prospective Students - PMS 132 (#A3792C)
    Research – PMS 652 (#7299C6)
    Faculty and Staff - PMS 398 (#B8B308)
    Careers – PMS 584 (#D9DA56)
    Business with Purdue – PMS 576 (#5C8727)
    Social & Visit Campus – PMS 7405 (#E3AE24)
    Events & News – PMS 405 (#746C66)
    Alumni - Gray (#888888)
    
    use the following procedure for color tinting http://www.purdue.edu/marketing/toolkit/web/multiplied.html',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53f7a8da95646',
                'label' => 'Audience Banner Title',
                'name' => 'audience_banner_title',
                'type' => 'text',
                'instructions' => 'Recommended title length is 25 characters or less',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 30,
            ),
            array (
                'key' => 'field_53f7a90e95647',
                'label' => 'Audience Banner Text',
                'name' => 'audience_banner_text',
                'type' => 'text',
                'instructions' => 'Word limit for the intro text is 30 words or less',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 180,
            ),
            array (
                'key' => 'field_53d16fd383988',
                'label' => 'Button 1 text',
                'name' => 'button_1_text',
                'type' => 'text',
                'instructions' => 'There is space in the banner region for up to 3 feature buttons. The recommended limit for these buttons is 22 characters or less.',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 25,
            ),
            array (
                'key' => 'field_53d170d3a7dac',
                'label' => 'Button 1 url',
                'name' => 'button_1_url',
                'type' => 'text',
                'instructions' => 'include full url of link, i.e. http://purdue.edu/link',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53d17370168c2',
                'label' => 'Button 2 text',
                'name' => 'button_2_text',
                'type' => 'text',
                'instructions' => 'There is space in the banner region for up to 3 feature buttons. The recommended limit for these buttons is 22 characters or less.',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 25,
            ),
            array (
                'key' => 'field_53d173479c301',
                'label' => 'Button 2 url',
                'name' => 'button_2_url',
                'type' => 'text',
                'instructions' => 'include full url of link, i.e. http://purdue.edu/link',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53d17361898ce',
                'label' => 'Button 3 text',
                'name' => 'button_3_text',
                'type' => 'text',
                'instructions' => 'There is space in the banner region for up to 3 feature buttons. The recommended limit for these buttons is 22 characters or less.',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 25,
            ),
            array (
                'key' => 'field_53d17353898cd',
                'label' => 'Button 3 url',
                'name' => 'button_3_url',
                'type' => 'text',
                'instructions' => 'include full url of link, i.e. http://purdue.edu/link',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53e9331a62fbc',
                'label' => 'Resources column 1 header',
                'name' => 'resources_column_1_header',
                'type' => 'text',
                'instructions' => 'Header to be displayed on first resources column',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53e9364e8a797',
                'label' => 'Resources column 1 links',
                'name' => 'resources_column_1_links',
                'type' => 'wysiwyg',
                'instructions' => 'List of links to be displayed on first resources column. Select bulleted list from tool bar.',
                'default_value' => '',
                'toolbar' => 'basic',
                'media_upload' => 'no',
            ),
            array (
                'key' => 'field_53e9337b62fbe',
                'label' => 'Resources column 2 header',
                'name' => 'resources_column_2_header',
                'type' => 'text',
                'instructions' => 'Header to be displayed on second resources column',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53e93764ceef6',
                'label' => 'Resources column 2 links',
                'name' => 'resources_column_2_links',
                'type' => 'wysiwyg',
                'instructions' => 'List of links to be displayed on second resources column. Select bulleted list from tool bar.',
                'default_value' => '',
                'toolbar' => 'basic',
                'media_upload' => 'no',
            ),
            array (
                'key' => 'field_53e933a4e2ac9',
                'label' => 'Resources column 3 header',
                'name' => 'resources_column_3_header',
                'type' => 'text',
                'instructions' => 'Header to be displayed on third resources column',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53e937763711b',
                'label' => 'Resources column 3 links',
                'name' => 'resources_column_3_links',
                'type' => 'wysiwyg',
                'instructions' => 'List of links to be displayed on third resources column. Select bulleted list from tool bar.',
                'default_value' => '',
                'toolbar' => 'basic',
                'media_upload' => 'no',
            ),
            array (
                'key' => 'field_53e933b5e2aca',
                'label' => 'Resources column 4 header',
                'name' => 'resources_column_4_header',
                'type' => 'text',
                'instructions' => 'Header to be displayed on fourth resources column',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53e9378e4fa59',
                'label' => 'Resources column 4 links',
                'name' => 'resources_column_4_links',
                'type' => 'wysiwyg',
                'instructions' => 'List of links to be displayed on fourth resources column. Select bulleted list from tool bar.',
                'default_value' => '',
                'toolbar' => 'basic',
                'media_upload' => 'no',
            ),
            array (
                'key' => 'field_53fcc69a29bd5',
                'label' => 'Events Image',
                'name' => 'events_image',
                'type' => 'image',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53f365586d39d',
                'label' => 'Events Feed Header',
                'name' => 'events_feed_header',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53f365766d39e',
                'label' => 'Events RSS Feed',
                'name' => 'events_rss_feed',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
            array (
                'key' => 'field_53f35ab1f3ff0',
                'label' => 'Audience Feature Image',
                'name' => 'audience_feature_image',
                'type' => 'image',
                'instructions' => 'Use 1138px x 760px image size. The subject in the photo should be located on the right third of the image for best results. Note: The image view will change dynamically on the page depending at what device (mobile phone, tablet or computer) is being used to view the page.',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53e92fd39bbe0',
                'label' => 'Featured Title',
                'name' => 'featured_title',
                'type' => 'text',
                'instructions' => 'Title for feature',
                'required' => 1,
                'default_value' => 'Featured Student',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53e931f600683',
                'label' => 'Featured Text',
                'name' => 'featured_text',
                'type' => 'wysiwyg',
                'instructions' => 'Story features for this region should be 120 words or less.',
                'required' => 1,
                'default_value' => '',
                'toolbar' => 'basic',
                'media_upload' => 'no',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page_audience.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_content-1',
        'title' => 'Content 1',
        'fields' => array (
            array (
                'key' => 'field_53ecb8deb5b86',
                'label' => 'Banner Image',
                'name' => 'content_1_banner_image',
                'type' => 'image',
                'instructions' => 'Image size should be 840px x 235px. Use an image here that matches the content strategy for the page. Note: The image view will change dynamically on the page depending at what device (mobile phone, tablet or computer) is being used to view the page.',
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page_content-2-col.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_content-2',
        'title' => 'Content 2',
        'fields' => array (
            array (
                'key' => 'field_53ecbb022c3f1',
                'label' => 'Banner Image',
                'name' => 'content_2_banner_image',
                'type' => 'image',
                'instructions' => 'Image size should be 840px x 235px. Use an image here that matches the content strategy for the page. Note: The image view will change dynamically on the page depending at what device (mobile phone, tablet or computer) is being used to view the page.',
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page_content-3-col.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_department-1',
        'title' => 'Department 1',
        'fields' => array (
            array (
                'key' => 'field_53ea6a86c6983',
                'label' => 'Carousel Image',
                'name' => 'carousel_image',
                'type' => 'image',
                'instructions' => 'Use image size 800px x 400px',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53ea67125effd',
                'label' => 'Carousel Title',
                'name' => 'carousel_title',
                'type' => 'text',
                'instructions' => 'The photo title should be no more than 22 characters.',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 25,
            ),
            array (
                'key' => 'field_53ea67955effe',
                'label' => 'Carousel Caption',
                'name' => 'carousel_caption',
                'type' => 'text',
                'instructions' => 'The subtitle should be no more than 60 characters.',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 60,
            ),
            array (
                'key' => 'field_53ea6ba35a3ba',
                'label' => 'Carousel Link',
                'name' => 'carousel_link',
                'type' => 'text',
                'instructions' => 'Enter full URL, including http://',
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea71b0b514b',
                'label' => 'Resources heading',
                'name' => 'resources_heading',
                'type' => 'text',
                'instructions' => 'Header text underneath Resources tab',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea72562b382',
                'label' => 'Resources content',
                'name' => 'resources_content',
                'type' => 'wysiwyg',
                'instructions' => 'Content within Resources tab',
                'required' => 1,
                'default_value' => '',
                'toolbar' => 'basic',
                'media_upload' => 'no',
            ),
            array (
                'key' => 'field_53ea730b96176',
                'label' => 'Feature Link one text',
                'name' => 'feature_link_one_text',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea732896177',
                'label' => 'Feature Link one URL',
                'name' => 'feature_link_one_url',
                'type' => 'text',
                'instructions' => 'Enter full URL including, http://',
                'default_value' => 'http://',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea735a7882d',
                'label' => 'Feature Link two text',
                'name' => 'feature_link_two_text',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea734ed7830',
                'label' => 'Feature Link two URL',
                'name' => 'feature_link_two_url',
                'type' => 'text',
                'instructions' => 'Enter full URL including, http://',
                'default_value' => 'http://',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53fb59aa2e47e',
                'label' => 'Feature Link three text',
                'name' => 'feature_link_three_text',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53fb59c42e47f',
                'label' => 'Feature Link three URL',
                'name' => 'feature_link_three_url',
                'type' => 'text',
                'instructions' => 'Enter full URL including, http://',
                'default_value' => 'http://',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page_department1.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_department-2',
        'title' => 'Department 2',
        'fields' => array (
            array (
                'key' => 'field_53ea7b974176a',
                'label' => 'Dept2 Carousel Image',
                'name' => 'dept2_carousel_image',
                'type' => 'image',
                'instructions' => 'Use images size 800px x 400px',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53ea7b4c41768',
                'label' => 'Dept2 Carousel Title',
                'name' => 'dept2_carousel_title',
                'type' => 'text',
                'instructions' => 'The photo title should be no more than 22 characters.',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 25,
            ),
            array (
                'key' => 'field_53ea7b7041769',
                'label' => 'Dept2 Carousel Caption',
                'name' => 'dept2_carousel_caption',
                'type' => 'text',
                'instructions' => 'The subtitle should be no more than 60 characters.',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => 60,
            ),
            array (
                'key' => 'field_53ea7bcfb42e5',
                'label' => 'Dept2 Carousel Link',
                'name' => 'dept2_carousel_link',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7c4df1022',
                'label' => 'Box 1 Image',
                'name' => 'box_1_image',
                'type' => 'image',
                'instructions' => 'Bottom color strip and image effect is based on #2EAFA4',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53ea7c0606e5f',
                'label' => 'Box 1 link',
                'name' => 'box_1_link',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7caded286',
                'label' => 'Box 1 text',
                'name' => 'box_1_text',
                'type' => 'text',
                'instructions' => 'You may need to add a break tag between words, see placeholder for example',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'Caption<br />Text',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7c7748c22',
                'label' => 'Box 2 Image',
                'name' => 'box_2_image',
                'type' => 'image',
                'instructions' => 'Bottom color strip and image effect is based on #a3792c',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53ea7c222c4df',
                'label' => 'Box 2 link',
                'name' => 'box_2_link',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7d0150ddc',
                'label' => 'Box 2 text',
                'name' => 'box_2_text',
                'type' => 'text',
                'instructions' => 'You may need to add a break tag between words, see placeholder for example',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'Caption<br />Text',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7c8002d58',
                'label' => 'Box 3 Image',
                'name' => 'box_3_image',
                'type' => 'image',
                'instructions' => 'Bottom color strip and image effect is based on #7ed0e0',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53ea7c382c4e1',
                'label' => 'Box 3 link',
                'name' => 'box_3_link',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7d0f93a50',
                'label' => 'Box 3 text',
                'name' => 'box_3_text',
                'type' => 'text',
                'instructions' => 'You may need to add a break tag between words, see placeholder for example',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'Caption<br />Text',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7c8b4b12e',
                'label' => 'Box 4 Image',
                'name' => 'box_4_image',
                'type' => 'image',
                'instructions' => 'Bottom color strip and image effect is based on #3b3b3b',
                'required' => 1,
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_53ea7c43b4016',
                'label' => 'Box 4 link',
                'name' => 'box_4_link',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7d19e09a7',
                'label' => 'Box 4 text',
                'name' => 'box_4_text',
                'type' => 'text',
                'instructions' => 'You may need to add a break tag between words, see placeholder for example',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'Caption<br />Text',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7d90a2553',
                'label' => 'Feature Link One Text',
                'name' => 'dept2_feature_link_one_text',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7d3bf6f28',
                'label' => 'Feature Link One URL',
                'name' => 'dept2_feature_link_one_url',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7da4a2554',
                'label' => 'Feature Link Two Text',
                'name' => 'dept2_feature_link_two_text',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53ea7d6f7e04d',
                'label' => 'Feature Link Two URL',
                'name' => 'dept2_feature_link_two_url',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53f647eb097dd',
                'label' => 'Feature Link Three Text',
                'name' => 'feature_link_three_text',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53f647b17ec17',
                'label' => 'Feature Link Three URL',
                'name' => 'feature_link_three_url',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53f64800a67cf',
                'label' => 'Feature Link Four Text',
                'name' => 'feature_link_four_text',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53f647d6d6b90',
                'label' => 'Feature Link Four URL',
                'name' => 'feature_link_four_url',
                'type' => 'text',
                'instructions' => 'full url, including http://',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'http://',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page_department2.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_news-template',
        'title' => 'News Template',
        'fields' => array (
            array (
                'key' => 'field_53fb7a8e5f645',
                'label' => 'News Banner Image',
                'name' => 'news_banner_image',
                'type' => 'image',
                'instructions' => 'Image size should be 840px x 235px. Use an image here that matches the content strategy for the page. Note: The image view will change dynamically on the page depending at what device (mobile phone, tablet or computer) is being used to view the page.',
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'home.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}


// Main Sidebar


    register_sidebar(array(
		'id'            => 'sidenav-sidebar',
		'name'          => 'Left Sidebar Navigation',
		'description'   => 'Appears only on 2 column and 3 column templates. Use a text widget with an unordered list <ul> for navigation links. Leave title field blank. Alternatively, create a new menu and use the Custom Menu widget and visibility function.',
		'class'         => 'sidenav col-lg-3 col-md-3 col-sm-3',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
	   ));

    register_sidebar(array(
        'id'            => 'sidecontent',
        'name'          => 'Left Sidebar Content',
        'description'   => 'Appears only on 2 column and 3 column templates. Use a widget for left sidebar content. Use a text widget for custom content.',
        'before_title'  => '<h5 class="widgettitle">',
        'after_title'   => '</h5>',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        ));


// Right Nav sidebar for 3 column template


	register_sidebar(array(
		'id'            => 'sidebar-rightnav',
		'name'          => 'Right Sidebar Navigation',
		'description'   => 'Appears only on 3 column template. Use a text widget and include a title for right sidebar content or navigation. Alternatively, create a new menu and use the Custom Menu widget and visibility function.',
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => '</h5>',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
    ));

// Prevent Page Scroll When Clicking the More Link

    function remove_more_link_scroll( $link ) {
        $link = preg_replace( '|#more-[0-9]+|', '', $link );
        return $link;
    }
    add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

// Events widget

     register_sidebar(array(
        'name' => 'Events Calendar Tab',
        'id'   => 'events',
        'description'   => 'Display calendar in Events Tab. e.g., use Events List widget from Modern Tribe Events Calendar plugin http://tri.be/shop/wordpress-events-calendar/',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
    ));

// News Widget

     register_sidebar(array(
        'name' => 'News Feed Tab',
        'id'   => 'news',
        'description'   => 'Display feed in News Tab. e.g., use RSS widget or Text widget for news feed.',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
    ));
 
// Remove Comment Form Allowed Tags
  
function remove_comment_form_allowed_tags() {
add_filter('comment_form_defaults','wordpress_comment_form_defaults');
}
add_action('after_setup_theme','remove_comment_form_allowed_tags');
/**
* @author Brad Dalton - WP Sites
* @learn more http://wp.me/p1lTu0-9Yd
*/
function wordpress_comment_form_defaults($default) {
	unset($default['comment_notes_after']);
	unset($default['comment_notes_before']);
	return $default;
}

// Footer widgets

// footerone not editable per Purdue Marketing and Media

/*    register_sidebar(array(
        'name' => 'Footer Far Left',
        'id'   => 'footerone',
        'description'   => 'Far left footer widget. Use a text widget, leave title field empty, and create an unordered list <ul> for links <li>',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
   ));

// footertwo not editable per Purdue Marketing and Media    

    register_sidebar(array(
        'name' => 'Footer Center Left',
        'id'   => 'footertwo',
        'description'   => 'Center left footer widget. Use a text widget, leave title field empty, and create an unordered list <ul> for links <li>',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
    ));

*/

    register_sidebar(array(
        'name' => 'Footer Center Right',
        'id'   => 'footerthree',
        'description'   => 'Center right footer widget. Use a text widget, leave title field empty, and create an unordered list <ul> for links <li>',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
    ));

    register_sidebar(array(
        'name' => 'Footer Far Right',
        'id'   => 'footerfour',
        'description'   => 'Far right footer widget. Use a text widget, leave title field empty, and create an unordered list <ul> for links <li>',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
    ));

    register_sidebar(array(
        'name' => 'Social Media Links',
        'id'   => 'social-media-links',
        'description'   => 'Add social media links to the footer. Use a text widget and the following snippet of code as a guide to customize and refer to Font Awesome for icon font usage. <a href="http://www.facebook.com/LifeAtPurdue" target="_blank"><span class="fa fa-facebook"></span></a> <a href="http://twitter.com/LifeAtPurdue" target="_blank"><span class="fa fa-twitter"></span></a> <a href="http://www.youtube.com/purdue" target="_blank"><span class="fa fa-youtube"></span></a> <a href="http://www.instagram.com/lifeatpurdue" target="_blank"><span class="fa fa-instagram"></span></a> <a href="http://www.pinterest.com/lifeatpurdue/" target="_blank"><span class="fa fa-pinterest"></span></a>',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
    ));

    register_sidebar(array(
        'name' => 'Head Code',
        'id'   => 'head-code',
        'description'   => 'Add code to the head tag of the page. Use a text widget to add code like google analytics tracking code.',
        'before_widget' => '',
        'after_widget'  => '',
    ));
    

}
add_action( 'widgets_init', 'purduetwentyfourteen_widgets_init' );
?>
