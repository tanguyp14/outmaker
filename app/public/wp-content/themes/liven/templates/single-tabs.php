<?php
/**
 * Template part for displaying tabs single page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

if ( is_single()){
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
		?>
		    <div class="blogcontent">
                <?php the_content(); ?>
            </div>
			<?php
		endwhile;
	endif;
}
?>