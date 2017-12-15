<?php
/**
 * Template part for displaying testimonial single page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

if ( is_single()){
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
		?>
		    <div class="wow fadeInDown testimonials-1 graycolor">
                <div class="col-md-2 col-sm-2 testimonials-1-pic">
                    <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>" class="img-responsive img-circle"/>
                </div>
                <div class="col-md-10 col-sm-10 testimonial-1-info">
                    <h3><?php the_title(); ?> <small><?php echo get_post_meta(get_the_ID(), '_t_designation', true); ?></small></h3>
                    <span><i class="fa fa-1x fa-quote-left icons-blue"></i></span>
                    <?php the_content(); ?>
                </div>
            </div>
			<?php
		endwhile;
	endif;
}
?>