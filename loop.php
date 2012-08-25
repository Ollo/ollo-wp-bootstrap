<?php
/**
 * The loop that displays posts. 
 * DUE FOR A RECODE AS I WANT MY OWN
 * @package WordPress
 * @subpackage ollomedia
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<?php next_posts_link( __( '&larr; Older posts', 'ollomedia' ) ); ?>
		<?php previous_posts_link( __( 'Newer posts &rarr;', 'ollomedia' ) ); ?>
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
		<h1><?php _e( 'Not Found', 'ollomedia' ); ?></h1>
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'ollomedia' ); ?></p>
		<?php get_search_form(); ?>

<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display all other posts. */ ?>
    <div id="content" class="inner">
		<h2 class="heading">
		    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'ollomedia' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div><?php the_excerpt(); ?></div>
	<?php else : ?>
			<div><?php the_content( __( 'Continue reading &rarr;', 'ollomedia' ) ); ?></div>
	<?php endif; ?>
    </div>
				
	<?php
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ):
	?>
	<?php printf( __( 'Tagged %2$s', 'ollomedia' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
	
	<?php endif; ?>
    <hr />
    
<?php endwhile; ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<?php next_posts_link( __( '&larr; Older posts', 'ollomedia' ) ); ?>
				<?php previous_posts_link( __( 'Newer posts &rarr;', 'ollomedia' ) ); ?>
<?php endif; ?>