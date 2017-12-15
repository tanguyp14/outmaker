<?php
/**
 * Template part for displaying clients single page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

if ( is_single()){
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
		$pg_link = get_post_meta(get_the_ID(), '_pg_link', true);
		?>
		    <a href="<?php echo esc_url($pg_link); ?>" target="_blank">
                <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>" />
            </a> 
        <?php
		endwhile;
	endif;
}
?>