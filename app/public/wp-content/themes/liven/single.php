<?php
/**
 * The template for displaying Blog Detail page.
 *
 * @package liven
 */
?>
<?php
    get_header();
    get_template_part( 'templates/breadcrumb', get_post_format() ); 

    $liven_blog_sidebar              = get_theme_mod('liven_blog_sidebar') ;
    $liven_blog_sidebar_position     = get_theme_mod('liven_blog_sidebar_position') ;
?>
<!--middle content-->
<div class="middlecontent">
    <div class="container">
        <div class="row">
        <?php
            if($liven_blog_sidebar == 'off'){
            ?>
            <div class="col-md-12">
                <div class="blog">
                <?php get_template_part( 'templates/single-blog', get_post_format() );?>
                </div>
            </div>
            <?php
            }
            else {
                if($liven_blog_sidebar_position == 'right' || $liven_blog_sidebar_position == ''){
                ?>
                <div class="col-md-8">
                    <div class="blog">
                        <?php get_template_part( 'templates/single-blog', get_post_format() );?>
                    </div>
                </div>
                <?php get_template_part('sidebar');
                }
                else {
                    get_template_part('sidebar');
                    ?>
                    <div class="col-md-8">
                        <div class="blog">
                            <?php get_template_part( 'templates/single-blog', get_post_format() );?>
                        </div>
                    </div>
                    <?php
                }
            }
        ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
