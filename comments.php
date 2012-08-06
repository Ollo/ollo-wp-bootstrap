<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to ollomedia_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage ollomedia
 */
?>

<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'ollomedia' ); ?></p>
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<!-- STARKERS NOTE: The following h3 id is left intact so that comments can be referenced on the page -->
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'ollomedia' ),
			number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'ollomedia' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'ollomedia' ) ); ?>
<?php endif; // check for comment navigation ?>

			<ol>
				<?php
					wp_list_comments( array( 'callback' => 'ollomedia_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'ollomedia' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'ollomedia' ) ); ?>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<?php _e( ' ', 'ollomedia' ); ?>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>