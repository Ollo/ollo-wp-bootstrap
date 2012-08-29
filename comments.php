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

<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<div id="comments">
<?php if ( post_password_required() ) : ?>
    <p class="nopassword">
        <?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?>
    </p>
</div><!-- #comments -->
<?php
        return;
    endif;
?>
<?php if ( have_comments() ) : ?>
    <h3 id="comments-title"><?php
        printf( _n( 'One Comment on %2$s', '%1$s Comments on %2$s', get_comments_number(), 'ollo' ),
        number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
    ?></h3>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    
    <div class="navigation">
        <div class="nav-previous">
            <?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?>
        </div>
        <div class="nav-next">
            <?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
        </div>
    </div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

<ul class="commentlist">
    <?php wp_list_comments(); ?>
</ul>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <div class="navigation">
        <div class="nav-previous">
            <?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?>
        </div>
        <div class="nav-next">
            <?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
        </div>
    </div><!-- .navigation -->
<?php endif; // check for comment navigation ?>
<?php else : // or, if we don't have comments:
        /* If there are no comments and comments are closed,
         * let's leave a little note, shall we?
         */
        if ( ! comments_open() ) :
?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'twentyten' ); ?></p>
        <?php endif; // end ! comments_open() ?>
<?php endif; // end have_comments() ?>
<?php ollo_comment_form(); ?>
</div><!-- #comments -->