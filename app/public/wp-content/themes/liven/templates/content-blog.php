<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

$liven_blog_style = get_theme_mod('liven_blog_style');

if ( is_home() || is_search() || is_archive()){
    if($liven_blog_style == 'liven_blog_style_1' ){
        if ( have_posts() ) :
            if ( is_home() && ! is_front_page() ) : 
            endif;
                            
            /* Start the Loop */
            while ( have_posts() ) : the_post();
    
                /*
                * Include the Post-Format-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                */
                if(get_post_type()==="post"){
                ?>
                <div id="<?php echo esc_html__('post-','liven');the_ID(); ?>" <?php post_class(); ?>>
                    <div class="p-gallery wow fadeInDown">
                        <?php if( has_post_thumbnail() ) :?>
                            <div class="p-gallery-img">
                                <a href="<?php esc_url(the_permalink()); ?>">
                                    <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>"/>
                                </a>
                            </div>
                        <?php endif;?>
                        
                        <?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" >', '</a></h3>' ); ?>
                        <div class="bloginfo">
                            <i class="fa fa-x fa-user icons-gray"></i> <small><?php echo get_the_author_posts_link(); ?></small> 
                            <a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-x fa-calendar icons-gray"></i> <small><?php echo get_the_date(); ?></small></a>
                            <i class="fa fa-x fa-comment icons-gray"></i> 
                            <small>
                            <?php 
                                $comments_count = wp_count_comments( get_the_ID() );
                                echo $comments_count->approved.esc_html__(' Comments ','liven');
                            ?>
                            </small>
                        </div>
                        <?php echo '<p>'.liven_blog_excerpt($GLOBALS['content_width']).'</p>'; ?>
                    </div>
                </div>
                <?php
                }
            endwhile;
        else :
            get_template_part( 'templates/content', 'none' );
        endif;
    }
    
    else if($liven_blog_style == 'liven_blog_style_2'){
        if ( have_posts() ) :
            if ( is_home() && ! is_front_page() ) : 
            endif;
                            
            /* Start the Loop */
            while ( have_posts() ) : the_post();
    
                /*
                * Include the Post-Format-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                */
                if(get_post_type()==="post"){
                ?>
                <div id="<?php echo esc_html__('post-','liven');the_ID(); ?>" <?php post_class(); ?>>
                    <div class="blog2 wow fadeInDown">
                        <div class="blog2-img">
                            <a href="<?php esc_url(the_permalink()); ?>">
                                <?php if( has_post_thumbnail() ) :?>
                                    <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>"/>
                                <?php endif;?>
                                <div class="mask-blog">
                                    <?php the_title( '<h4>', '</h4>' ); ?>
                                </div>
                            </a>
                        </div>
                        <div class="bloginfo">
                            <i class="fa fa-x fa-user icons-gray"></i> <small><?php the_author_posts_link(); ?></small> 
                            <a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-x fa-calendar icons-gray"></i> <small><?php echo get_the_date(); ?></small></a>
                            <i class="fa fa-x fa-comment icons-gray"></i> 
                            <small>
                            <?php 
                                $comments_count = wp_count_comments( get_the_ID() );
                                echo $comments_count->approved.esc_html__(' Comments ','liven');
                            ?>
                            </small>
                        </div>
                    </div>
                </div>
                <?php
                }
            endwhile;
        else :
            get_template_part( 'templates/content', 'none' );
    
        endif;
    ?>
        
    <?php
    }
    
    else if($liven_blog_style == 'liven_blog_style_3' || $liven_blog_style == ''){
        if ( have_posts() ) :
            if ( is_home() && ! is_front_page() ) : 
            endif;
                            
            /* Start the Loop */
            while ( have_posts() ) : the_post();
    
                /*
                * Include the Post-Format-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                */
                if(get_post_type()==="post"){
                ?>
                <div id="<?php echo esc_html__('post-','liven');the_ID(); ?>" <?php post_class(); ?>>
                    <div class="blog3 wow fadeInDown">
                        <?php if( has_post_thumbnail() ) :?>
                        <div class="blog3-img">
                            <a href="<?php esc_url(the_permalink()); ?>">
                                <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>"/>
                            </a>
                        </div>
                        <?php endif;?>
                        <?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" >', '</a></h3>' ); ?>
                        <div class="bloginfo">
                            <i class="fa fa-x fa-user icons-gray"></i> <small><?php the_author_posts_link(); ?></small> 
                            <a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-x fa-calendar icons-gray"></i> <small><?php echo get_the_date(); ?></small></a>
                            <i class="fa fa-x fa-comment icons-gray"></i> 
                            <small>
                            <?php 
                                $comments_count = wp_count_comments( get_the_ID() );
                                echo $comments_count->approved.esc_html__(' Comments ','liven');
                            ?>
                            </small>
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
                        <?php echo '<p>'.liven_blog_excerpt($GLOBALS['content_width']).'</p>'; ?>
                        <div class="tagcloud"><?php the_tags("",""); ?></div>
                    </div>
				</div>                    
                <?php
                }
            endwhile;
        else :
            get_template_part( 'templates/content', 'none' );
        endif;
    }
    
    else if($liven_blog_style == 'liven_blog_style_4'){
         if ( have_posts() ) :
            if ( is_home() && ! is_front_page() ) : 
            endif;
                            
            /* Start the Loop */
            while ( have_posts() ) : the_post();
    
                /*
                * Include the Post-Format-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                */
                if(get_post_type()==="post"){
                ?>
                <div id="<?php echo esc_html__('post-','liven');the_ID(); ?>" <?php post_class(); ?>>
                    <div class="blog4 wow fadeInDown">
                        <?php if( has_post_thumbnail() ) :?>
                        <div class="blog4-img">
                            <a href="<?php esc_url(the_permalink()); ?>">
                                <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>"/>
                            </a>
                        </div>
                        <div class="blogdetail">
                        <?php else: ?>
                        <div class="blogdetail autoWidth">
                        <?php endif;?>
                            <?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" >', '</a></h3>' ); ?>
                            <div class="bloginfo">
                                <i class="fa fa-x fa-user icons-gray"></i> <small><?php the_author_posts_link(); ?></small> 
                                <a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-x fa-calendar icons-gray"></i> <small><?php echo get_the_date(); ?></small></a>
                                <i class="fa fa-x fa-comment icons-gray"></i> 
                                <small>
                                <?php 
                                    $comments_count = wp_count_comments( get_the_ID() );
                                    echo $comments_count->approved.esc_html__(' Comments ','liven');
                                ?>
                                </small>
                            </div>
                            <?php echo '<p>'.liven_blog_excerpt($GLOBALS['content_width']).'</p>'; ?>
                        </div>
                        <div class="clr"></div>
                    </div>
				</div>                    
                <?php
                }
            endwhile;
        else :
            get_template_part( 'templates/content', 'none' );
        endif;
    }
    
    else if($liven_blog_style == 'liven_blog_style_5'){
        $post_count = 0;
        if ( have_posts() ) :
            if ( is_home() && ! is_front_page() ) : 
            endif;
            
            echo '<div class="blog-month">';                
            /* Start the Loop */
            while ( have_posts() ) : the_post();
    
                /*
                * Include the Post-Format-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                */
                if(get_post_type()==="post"){
                    $current_month = get_the_date('F Y');
                    if( $wp_query->current_post === 0 ) { 
                        echo '<div class="monthtitle">';
                        echo get_the_date( 'F Y' );
                        echo '</div>';
                        echo '<div class="clr"></div>';
                    }
                    else{ 
                        $f = $wp_query->current_post - 1;       
                        $old_date =   mysql2date( 'F Y', $wp_query->posts[$f]->post_date ); 
                        if($current_month != $old_date) {
                            echo"<div class='clr'></div>";
                            echo '<div class="monthtitle">';
                            echo get_the_date( 'F Y' );
                            echo '</div>';
                            echo '<div class="clr"></div>';
                            $post_count = 0;
                        }
                    }
                    
                    if($post_count % 2 == 0 ){
                    ?>
                    <div id="<?php echo esc_html__('post-','liven');the_ID(); ?>" <?php post_class(); ?>>
                        <div class="blog5 wow fadeInDown ">
                            <h3 class="text-left"><strong><?php echo get_the_date('d'); ?></strong>&nbsp;<?php echo get_the_date('F'); ?> </h3>
                            <?php if( has_post_thumbnail() ) :?>
                            <div class="blog5-img">
                                <a href="<?php esc_url(the_permalink()); ?>">
                                    <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>"/>
                                </a>
                            </div>
                            <?php endif;?>
                            <div class="blog5-info text-left">
                                <?php the_title( '<h5><a href="' . esc_url( get_permalink() ) . '" >', '</a></h5>' ); ?>
                                <div class="bloginfo">
                                    <i class="fa fa-x fa-user icons-gray"></i> <small><?php the_author_posts_link(); ?></small> 
                                    <a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-x fa-calendar icons-gray"></i> <small><?php echo get_the_date(); ?></small></a>
                                    <i class="fa fa-x fa-comment icons-gray"></i> 
                                    <small>
                                    <?php 
                                        $comments_count = wp_count_comments( get_the_ID() );
                                        echo $comments_count->approved.esc_html__(' Comments ','liven');
                                    ?>
                                    </small>
                                </div>
                                <?php echo '<p>'.liven_blog_excerpt($GLOBALS['content_width']).'</p>'; ?>
                            </div>
                        </div>
					</div>                        
                    <?php
                    }
                    else{
                    ?>
                    <div id="<?php echo esc_html__('post-','liven');the_ID(); ?>" <?php post_class(); ?>>
                        <div class="blog5 wow fadeInDown margin-top-50">
                            <h3 class="text-left"><strong><?php echo get_the_date('d'); ?></strong>&nbsp;<?php echo get_the_date('F'); ?></h3>
                            <?php if( has_post_thumbnail() ) :?>
                            <div class="blog5-img">
                                <a href="<?php esc_url(the_permalink()); ?>">
                                    <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php echo the_title(); ?>"/>
                                </a>
                            </div>
                            <?php endif;?>
                            <div class="blog5-info text-left">
                                <?php the_title( '<h5><a href="' . esc_url( get_permalink() ) . '" >', '</a></h5>' ); ?>
                                <div class="bloginfo">
                                    <i class="fa fa-x fa-user icons-gray"></i> <small><?php the_author_posts_link(); ?></small> 
                                    <a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-x fa-calendar icons-gray"></i> <small><?php echo get_the_date(); ?></small></a>
                                    <i class="fa fa-x fa-comment icons-gray"></i> 
                                    <small>
                                    <?php 
                                        $comments_count = wp_count_comments( get_the_ID() );
                                        echo $comments_count->approved.esc_html__(' Comments ','liven');
                                    ?>
                                    </small>
                                </div>
                                <?php echo '<p>'.liven_blog_excerpt($GLOBALS['content_width']).'</p>'; ?>
                            </div>
                        </div>
					</div>                        
                    <?php
                    }
                }
            $post_count++;
            endwhile;
            echo '<div class="clr"></div> </div>';
            
        else :
            get_template_part( 'templates/content', 'none' );
    
        endif;
    }
}
?>