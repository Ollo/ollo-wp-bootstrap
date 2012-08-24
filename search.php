<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage ollomedia
 */

get_header(); ?>
<div id="content" class="inner">
<?php if ( have_posts() ) : ?>
				<h1><?php printf( __( 'Search Results for: %s', 'ollomedia' ), '' . get_search_query() . '' ); ?></h1>
				<?php
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
					<h2><?php _e( 'Nothing Found', 'ollomedia' ); ?></h2>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'ollomedia' ); ?></p>
					<?php get_search_form(); ?>
<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
