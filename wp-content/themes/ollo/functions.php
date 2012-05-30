<?php
/**
 * @package WordPress
 * @subpackage #themeName
 */


// load includes to keep functions simple if possible  
require_once('inc/post-types.php');

// Remove junk from wp_head()
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');


if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run ollomedia_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'ollomedia_setup' );

if ( ! function_exists( 'ollomedia_setup' ) ):
/**
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function ollomedia_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	//add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'ollomedia' ),
	) );

}
endif;

function ollomedia_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'ollomedia' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'ollomedia' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'ollomedia' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'ollomedia_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function ollomedia_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ollomedia_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 */
function ollomedia_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'ollomedia_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function ollomedia_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ollomedia' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and ollomedia_continue_reading_link().
 */
function ollomedia_auto_excerpt_more( $more ) {
	return ' &hellip;' . ollomedia_continue_reading_link();
}
add_filter( 'excerpt_more', 'ollomedia_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function ollomedia_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= ollomedia_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'ollomedia_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 */
function ollomedia_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'ollomedia_remove_gallery_css' );

if ( ! function_exists( 'ollomedia_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */

function ollomedia_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'ollomedia' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'ollomedia' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'ollomedia' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'ollomedia' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'ollomedia' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'ollomedia'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 */
function ollomedia_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'ollomedia' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'ollomedia' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'ollomedia' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'ollomedia' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'ollomedia' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'ollomedia' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'ollomedia' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'ollomedia' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'ollomedia' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'ollomedia' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'ollomedia' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'ollomedia' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running ollomedia_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'ollomedia_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function ollomedia_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'ollomedia_remove_recent_comments_style' );

if ( ! function_exists( 'ollomedia_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function ollomedia_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'ollomedia' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'ollomedia' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'ollomedia_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
function ollomedia_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ollomedia' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ollomedia' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ollomedia' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

function registerScripts() {
if(!is_admin()){
	// Ckeck if Google's jQuery CDN is working and if it is load their jQuery library, if it is not, fallback to a local jQuery library script…
	$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'; // The URL to check against
	$test_url = @fopen($url,'r'); // Test parameters
	if($test_url !== false) { // Test if the URL exists
    	function load_external_jQuery() { // Load external file
        	wp_deregister_script( 'jquery' ); // Deregisters the default WordPress jQuery
        	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'); // Register the external file. * be sure to update version numbers whenever there is a newer version of jQuery
        	wp_enqueue_script('jquery'); // Enqueue the external file
    	}
		add_action('wp_enqueue_scripts', 'load_external_jQuery'); // Initiate the function
	} else {
    	function load_local_jQuery() {
        	wp_deregister_script('jquery'); // Initiate the function
        	wp_register_script('jquery', bloginfo('template_url').'/js/libs/jquery-1.7.2.min.js', __FILE__, false, '1.7.1', true); // Register the local file
        	wp_enqueue_script('jquery'); // Enqueue the local file
    	}
		add_action('wp_enqueue_scripts', 'load_local_jQuery'); // Initiate the function
	}
    
    // Load all other scripts you may need...
    wp_register_script('modernizer', get_bloginfo('template_directory') .'/js/modernizr.js','jquery'); // Always include Modernizr when using HTML5
    
    // *You should always redownload a minified/minimal version of Modernizr when pushing to a live site @ http://modernizr.com/download/
    wp_enqueue_script('modernizer'); // Automatically load Modernizr into the header…

    // Whenver possible, try to include any scripts bellow this comment in the footer and not the header...
	}
	
	// 


}

add_action( 'init', 'registerScripts' );

