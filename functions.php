<?php
/**
 * @package WordPress
 * @subpackage ollomedia
 */

// load includes to keep functions simple if possible  
require_once('inc/post-types.php');
require_once('inc/widgets.php');
require_once('inc/scripts.php');

// Remove junk from wp_head()
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');


/** Tell WordPress to run ollomedia_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'ollomedia_setup' );

if ( ! function_exists( 'ollomedia_setup' ) ):
/**
 *
 * @uses add_theme_support() To add support for post thumbnails.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 *
 * @since Twenty Ten 1.0
 */
function ollomedia_setup() {

	// Not sure I'm going to use this but keeping it for now
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// set up wp_nav_menu() add more as needed 
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'ollomedia' ),
	) );

}
endif;

// custom images 
add_image_size('work-thumbnail', 200, 200);
add_image_size( 'homepage-thumb', 400, 400);

function ollomedia_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

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
 * function for custom excerpt link based on input passed 
 */
function print_excerpt($length) {
	global $post;
	$text = $post->post_excerpt;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
	}
	$text = strip_shortcodes($text);
	$text = strip_tags($text,'<p><a>');
	//$text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

	$text = substr($text,0,$length);
	$excerpt = reverse_strrchr($text, '.', 1);
	if( $excerpt ) {
		echo apply_filters('the_excerpt',$excerpt);
	} else {
		echo apply_filters('the_excerpt',$text);
	}
}
function reverse_strrchr($haystack, $needle, $trail) {
    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}

/**
 * Returns a "Continue Reading" link for the_excerpt / keeping but using the custom function above
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
 * Template for comments and pingbacks.
 */

function ollo_comment_form( $args = array(), $post_id = null ) {
         global $user_identity, $id;

         if ( null === $post_id )
                 $post_id = $id;
         else
                 $id = $post_id;

         $commenter = wp_get_current_commenter();

         $req = get_option( 'require_name_email' );
         $aria_req = ( $req ? " aria-required='true'" : '' );
         $fields =  array(
                 'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '<span class="required">*</span></label> ' . ( $req ? '' : '' ) .
                             '<input id="author" name="author" type="text" class="span6" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
                 'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '<span class="required">*</span></label> ' . ( $req ? '' : '' ) .
                             '<input id="email" name="email" type="text" class="span6" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
                 'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
                             '<input id="url" name="url" type="text" class="span6" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
         );

         $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
         $defaults = array(
                 'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
                 'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" class="span6" rows="5" aria-required="true"></textarea></p>',
                 'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
                 'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
                 'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
                 'comment_notes_after'  => '',
                 'id_form'              => 'commentform',
                 'id_submit'            => 'submit',
                 'class_submit'         => 'submit btn btn-primary',
                 'title_reply'          => __( 'Join the Conversation' ),
                 'title_reply_to'       => __( 'Your thoughts on %s' ),
                 'cancel_reply_link'    => __( 'Cancel reply' ),
                 'label_submit'         => __( 'Submit' ),
         );

         $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

         ?>
                 <?php if ( comments_open() ) : ?>
                         <?php do_action( 'comment_form_before' ); ?>
                         <div class="span8">
                         <div id="respond" class="left row">
                                 <h3 id="reply-title" clas="heading"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
                                 <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                                         <?php echo $args['must_log_in']; ?>
                                         <?php do_action( 'comment_form_must_log_in_after' ); ?>
                                 <?php else : ?>
                                         <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
                                                 <?php do_action( 'comment_form_top' ); ?>
                                                 <?php if ( is_user_logged_in() ) : ?>
                                                         <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                                                         <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                                                 <?php else : ?>
                                                         <?php echo $args['comment_notes_before']; ?>
                                                         <?php
                                                         do_action( 'comment_form_before_fields' );
                                                         foreach ( (array) $args['fields'] as $name => $field ) {
                                                                 echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                                                         }
                                                         do_action( 'comment_form_after_fields' );
                                                         ?>
                                                 <?php endif; ?>
                                                 <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                                                 <?php echo $args['comment_notes_after']; ?>
                                                 <p class="form-submit">
                                                         <input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" class="<?php echo esc_attr( $args['class_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
                                                         <?php comment_id_fields(); ?>
                                                 </p>
                                                 <?php do_action( 'comment_form', $post_id ); ?>
                                         </form>
                                 <?php endif; ?>
                         </div><!-- #respond -->
                    </div><!-- conatiner -->
                         <?php do_action( 'comment_form_after' ); ?>
                 <?php else : ?>
                         <?php do_action( 'comment_form_comments_closed' ); ?>
                 <?php endif; ?>
         <?php
}


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
?>