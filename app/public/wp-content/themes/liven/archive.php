<?php
/**
 * The template for displaying home page.
 *
 * @package liven
 */
?>
<?php
    get_header();
    get_template_part( 'templates/breadcrumb', get_post_format() ); 

    $liven_blog_style            = get_theme_mod('liven_blog_style');
    $liven_blog_sidebar          = get_theme_mod('liven_blog_sidebar');
    $liven_blog_sidebar_position = get_theme_mod('liven_blog_sidebar_position');
?>
<!--middle content-->
<div class="middlecontent">
    <div class="container">
        <div class="row">
        <?php
            if($liven_blog_style == 'liven_blog_style_1' || $liven_blog_style == '' ){
                if($liven_blog_sidebar == 'off'){
                ?>
                    <div class="col-md-12">
                        <div class="blog">
                            <div class="columns" style="column-width:320px; column-gap: 30px;">
                            <?php
                                get_template_part( 'templates/content-blog', get_post_format() );
                            ?>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                            ?>
                        </div>
                    </div>
                    <?php
                }
                else {
                    if($liven_blog_sidebar_position == 'right' || $liven_blog_sidebar_position == ''){
                    ?>
                        <div class="col-md-8">
                            <div class="blog">
                                <div class="columns" style="column-width:320px; column-gap: 30px;">
                                    <?php
                                        get_template_part( 'templates/content-blog', get_post_format() );
                                    ?>
                                </div>
                                <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                                ?>
                            </div>
                        </div>
                    <?php get_template_part('sidebar');
                    }
                    else {
                        get_template_part('sidebar');
                        ?>
                        <div class="col-md-8">
                            <div class="blog">
                                <div class="columns" style="column-width:320px; column-gap: 30px;">
                                    <?php
                                        get_template_part( 'templates/content-blog', get_post_format() );
                                    ?>
                                </div>
                                <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            
            else if($liven_blog_style == 'liven_blog_style_2'){
                if($liven_blog_sidebar == 'off'){
                ?>
                    <div class="col-md-12">
                        <div class="blog">
                            <?php
                                get_template_part( 'templates/content-blog', get_post_format() );
                            ?>
                            <div class="clr"></div>
                        </div>
                        <?php
                            the_posts_pagination( array( 'mid_size' => 2 ) );
                        ?>
                    </div>
                <?php
                }
                else {
                    if($liven_blog_sidebar_position == 'right' || $liven_blog_sidebar_position == ''){
                    ?>
                        <div class="col-md-8">
                            <div class="blog">
                                <?php
                                    get_template_part( 'templates/content-blog', get_post_format() );
                                ?>
                                <div class="clr"></div>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                            ?>
                        </div>
                        <?php 
                        get_template_part('sidebar');
                    }
                    else {
                        get_template_part('sidebar');
                        ?>
                        <div class="col-md-8">
                            <div class="blog">
                                <?php
                                    get_template_part( 'templates/content-blog', get_post_format() );
                                ?>
                                <div class="clr"></div>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                            ?>
                        </div>
                        <?php
                    }
                }   
            }
                    
            else if($liven_blog_style == 'liven_blog_style_3'){
                if($liven_blog_sidebar == 'off'){
                ?>
                    <div class="col-md-12">
                        <div class="blog">
                        <?php
                            get_template_part( 'templates/content-blog', get_post_format() );
                        ?>    
                        </div>
                        <?php
                            the_posts_pagination( array( 'mid_size' => 2 ) );
                        ?>
                    </div>
                <?php
                }
                else {
                    if($liven_blog_sidebar_position == 'right' || $liven_blog_sidebar_position == ''){
                    ?>
                        <div class="col-md-8">
                            <div class="blog">
                            <?php
                                get_template_part( 'templates/content-blog', get_post_format() );
                            ?>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                            ?>
                        </div>
                        <?php 
                        get_template_part('sidebar');
                    }
                    else {
                        get_template_part('sidebar');
                        ?>
                        <div class="col-md-8">
                            <div class="blog">
                            <?php
                                get_template_part( 'templates/content-blog', get_post_format() );
                            ?>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                            ?>
                        </div>
                        <?php
                    }
                }
            }
            
            else if($liven_blog_style == 'liven_blog_style_4'){
                if($liven_blog_sidebar == 'off'){
                ?>
                    <div class="col-md-12">
                        <div class="blog">
                        <?php
                            get_template_part( 'templates/content-blog', get_post_format() );
                        ?>
                        </div>
                        <?php
                           the_posts_pagination( array( 'mid_size' => 2 ) );
                        ?>
                    </div>
                <?php
                }
                else{
                    if($liven_blog_sidebar_position == 'right' || $liven_blog_sidebar_position == ''){
                    ?>
                        <div class="col-md-8">
                            <div class="blog">
                            <?php
                                get_template_part( 'templates/content-blog', get_post_format() );
                            ?>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );                                
                            ?>
                        </div>
                        <?php 
                        get_template_part('sidebar');
                    }
                    else{
                        get_template_part('sidebar');
                        ?>
                        <div class="col-md-8">
                            <div class="blog">
                            <?php
                                get_template_part( 'templates/content-blog', get_post_format() );
                            ?>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                            ?>
                        </div>
                        <?php
                    }
                }    
            }
            
            else if($liven_blog_style == 'liven_blog_style_5'){
                if($liven_blog_sidebar == 'off'){
                ?>
                    <div class="col-md-12">
                        <div class="blog blogfull">
                            <?php get_template_part( 'templates/content-blog', get_post_format() );?>
                        </div>
                        <?php
                            the_posts_pagination( array( 'mid_size' => 2 ) );
                        ?>
                    </div>
                <?php
                }
                else{
                    if($liven_blog_sidebar_position == 'right' || $liven_blog_sidebar_position == ''){
                    ?>
                        <div class="col-md-8">
                            <div class="blog blogfull">
                                <?php get_template_part( 'templates/content-blog', get_post_format() );?>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                            ?>
                        </div>
                        <?php 
                        get_template_part('sidebar');
                    }
                    else{
                        get_template_part('sidebar');?>
                        <div class="col-md-8">
                            <div class="blog blogfull">
                                <?php get_template_part( 'templates/content-blog', get_post_format() );?>
                            </div>
                            <?php
                                the_posts_pagination( array( 'mid_size' => 2 ) );
                            ?>
                        </div>
                        <?php
                    }
                }   
            }
			?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
