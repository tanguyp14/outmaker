<?php
/**
 * Template part for displaying singe blog post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

if ( is_single()){
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
		?>
		   <div class="blogdetailhead">
			    <?php the_title( '<h2>', '</h2>' ); ?>
				<span>
				<?php 
				    echo esc_html__('by ','liven' ) ; echo ucwords(get_the_author()); echo esc_html__(' | ','liven' ) ;
					the_date(get_option( 'date_format' )); echo esc_html__(' | ','liven' ) ;
					                
					$comments_count = wp_count_comments( get_the_ID() );
                    echo ($comments_count->approved == 1) ? $comments_count->approved.esc_html__(' Comment ','liven' ) : $comments_count->approved.esc_html__(' Comments ','liven' );
                ?>
				</span>
				<div class="blog-cat-list">
                <?php
                    $post_terms = get_the_category( get_the_ID() );
                    $last_term_array = end($post_terms);
                    $lastElement = $last_term_array->cat_name;
                    foreach($post_terms as $terms){
                        if($lastElement == $terms->cat_name){
                        ?>
                            <a href="<?php echo esc_url(get_term_link( $terms->term_id)); ?>"><?php echo esc_html($terms->cat_name); ?></a>
                        <?php
                        }
                        else{
                        ?>
                            <a href="<?php echo esc_url(get_term_link( $terms->term_id)); ?>"><?php echo esc_html($terms->cat_name).esc_html__(', ','liven'); ?></a>
                        <?php
                        }
                    }
                ?>
                </div>
            </div>
            
            <?php if( has_post_thumbnail() ) :?>
            <div class="blogdetailimg">
                <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>" />
            </div>
            <?php endif;?>
            <div class="blogcontent">
                <?php the_content();?>
            </div>
            <div class="tagcloud"><?php the_tags("",""); ?></div>
			<?php
			wp_link_pages( );
		endwhile;
	endif;
	if ( comments_open() || get_comments_number() ) :
        comments_template();
	endif;
}
?>