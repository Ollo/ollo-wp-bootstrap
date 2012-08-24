<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage ollomedia
 */

get_header(); ?>
<div id="content" class="inner">

    <?php
    	if ( have_posts() )
    		the_post();
    ?>

    				<h1><?php printf( __( 'Posts By: %s', 'ollomedia' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h1>

    <?php
    if ( get_the_author_meta( 'description' ) ) : ?>

    							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'ollomedia_author_bio_avatar_size', 60 ) ); ?>
    							<h2><?php printf( __( 'About %s', 'ollomedia' ), get_the_author() ); ?></h2>
    							<?php the_author_meta( 'description' ); ?>

    <?php endif; ?>

<?php
	rewind_posts();
	get_template_part( 'loop', 'author' );
?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>