<?php
/**
 * Template part for displaying team member single page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

if ( is_single()){
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
		?>
		    <div class="col-md-4 col-sm-4 team-box wow fadeInDown">
                <div class="team2-img">
                    <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>"/>
                </div>
                <?php 
                    the_title( '<h3>', '</h3>' ); 
                    
                    $member_designation = get_post_meta(get_the_ID(), '_t_designation', true);
                    if($member_designation != ""){
                    ?>
                        <p><span><?php echo esc_html($member_designation); ?></span></p>
                    <?php
                    }
                
                    $liven_facbookurl  = get_post_meta(get_the_ID(), '_t_facebook_url', true);
                    $liven_twitterurl  = get_post_meta(get_the_ID(), '_t_twitter_url', true);
                    $liven_googlerurl  = get_post_meta(get_the_ID(), '_t_googleplus_url', true);
                    $liven_linkedinurl = get_post_meta(get_the_ID(), '_t_linkedin_url', true);
                    
                    if($liven_facbookurl != "" || $liven_twitterurl != "" || $liven_googlerurl != "" || $liven_linkedinurl != ""){
                    ?>
                        <div class="team-social">
                        <?php
                            if($liven_facbookurl != ""){
                            ?>
                                <a href="<?php echo esc_url($liven_facbookurl); ?>" class="team-facebook" target="_BLANK"></a>
                            <?php
                            }
                            if($liven_twitterurl != ""){
                            ?>
                                <a href="<?php echo esc_url($liven_twitterurl); ?>" class="team-twitter" target="_BLANK"></a>
                            <?php
                            }
                            if($liven_googlerurl != ""){
                            ?>
                                <a href="<?php echo esc_url($liven_googlerurl); ?>" class="team-gplus" target="_BLANK"></a>
                            <?php
                            }
                            if($liven_linkedinurl != ""){
                            ?>
                                <a href="<?php echo esc_url($liven_linkedinurl); ?>" class="team-linkedin" target="_BLANK"></a>
                            <?php
                            }
                        ?>
                        </div>
                    <?php
                    }
                ?>
            </div>
			<?php
		endwhile;
	endif;
}
?>