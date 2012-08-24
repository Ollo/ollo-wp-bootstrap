<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Ollomedia
 */

get_header(); ?>

<?php
	if ( have_posts() )
		the_post();
?>
<div id="content" class="inner">

    			<h1>
    <?php if ( is_day() ) : ?>
    				<?php printf( __( 'Daily Archives: %s', 'ollomedia' ), get_the_date() ); ?>
    <?php elseif ( is_month() ) : ?>
    				<?php printf( __( 'Monthly Archives: %s', 'ollomedia' ), get_the_date('F Y') ); ?>
    <?php elseif ( is_year() ) : ?>
    				<?php printf( __( 'Yearly Archives: %s', 'ollomedia' ), get_the_date('Y') ); ?>
    <?php else : ?>
    				<?php _e( 'Blog Archives', 'ollomedia' ); ?>
    <?php endif; ?>
    			</h1>

<?php
    rewind_posts();

	get_template_part( 'loop', 'archive' );
?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>