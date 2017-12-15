<?php
/**
 * liven functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package liven
 */

if(!function_exists('liven_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 	if ( ! function_exists( 'liven_theme_name' ) ) :
		function liven_theme_name() {
			$liven_theme = wp_get_theme();
			return  $liven_theme->get( 'Name' ) ;
		}
	endif;
	
	if ( ! function_exists( 'liven_theme_version' ) ) :
		function liven_theme_version() {
			$liven_theme = wp_get_theme();
			return  $liven_theme->get( 'Version' );
		}
	endif;
	
	if ( ! function_exists( 'liven_htmldata' ) ) :
		function  liven_htmldata( $liven_value, $liven_domain="liven" ) {
			global $allowedtags;
			return wp_kses( $liven_value ,$allowedtags );
		}
	endif;
	
	function liven_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on liven, use a find and replace
		* to change 'liven' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'liven', get_template_directory() . '/languages' );
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		
		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );
		
		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );
		
		// This theme uses wp_nav_menu() in multiple locations.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Top primary menu', 'liven' ),
		) );
		
		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status'
		) );
		
		/*
		* Enable support for custom-header.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'custom-header' );
		
		/*
		* Enable support for custom-background.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'custom-background' );
	}
endif;
add_action( 'after_setup_theme', 'liven_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( ! function_exists( 'liven_widgets_init' ) ) :
function liven_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'liven' ),
		'id'            => 'liven_sidebar_1',
		'description'   => esc_html__( 'Sidebar of Blog', 'liven' ),
		'before_widget' => '<div id="%1$s" class="%2$s row wow fadeInDown"> <div class="col-lg-12 margin-bottom-30 ">  ',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
endif;
add_action( 'widgets_init', 'liven_widgets_init' );

/*
* custom search form for header
* 
*/

if ( ! function_exists( 'liven_custom_search_form' ) ) :
function liven_custom_search_form( $form ) {
	$form = '<form method="get" class="search-form" id="liven-quick-search" action="'.esc_url(home_url( "/" )).'" >';
	$form .= '<input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_html__("Search....","liven").'"/>';
	$form .= '<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>';
	$form .= '</form>';
	return $form;
}
endif;

/*
* Enable excerpt for posts
* 
*/
if (!function_exists('liven_blog_excerpt')) {
    function liven_blog_excerpt($limit) {
        $liven_blog_excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($liven_blog_excerpt)>=$limit) {
            array_pop($liven_blog_excerpt);
            $liven_blog_excerpt = implode(" ",$liven_blog_excerpt).'...';
        } else {
            $liven_blog_excerpt = implode(" ",$liven_blog_excerpt);
        }	
        $liven_blog_excerpt = preg_replace('`\[[^\]]*\]`','',$liven_blog_excerpt);
        return $liven_blog_excerpt;
    }
}

/**
 * Include Required files from inc folder
 */
foreach ( glob( get_template_directory() . "/inc/*.php" ) as $file ) {
    include_once $file;
}


/*
    comment form for header
*/
if ( ! function_exists( 'liven_comment_format' ) ) :
   function liven_comment_format($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
       <li <?php comment_class(); ?> id="<?php echo "li-comment-";comment_ID(); ?>">
           <div id="<?php echo "comment-";comment_ID(); ?>">
               <div class="comment-author vcard"> <?php echo get_avatar($comment,$size='48' ); ?> </div>
               <div class="comment-meta commentmetadata"> <?php printf(wp_kses( __('<span class="fn">%s</span>','liven'), array( 'span' => array( 'class' => array() ) )), get_comment_author_link()); ?>
                   <span class="dt">
                       <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="datetxtb">
                           <?php printf(wp_kses( __('%1$s at %2$s','liven'), array( 'span' => array( 'class' => array() ) )), get_comment_date(),  get_comment_time()); ?>
                       </a>
                   </span>
                   <?php edit_comment_link( esc_html__('(Edit)','liven'),'  ','') ?>
                   <div class="reply">
                       <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                   </div>
                   <?php if ($comment->comment_approved == '0') : ?>
                       <div class="comment-noapprove"><em>
                           <?php esc_html_e('Your comment is awaiting moderation.','liven') ?>
                       </em> </div>
                   <?php endif; ?>
               </div>
               <div class="comment-cnt"><?php comment_text() ?></div>
           </div>       
   <?php
   }
endif;


/*
recent post sidebar widget
*/
if (! class_exists( 'liven_recent_posts_widget' ) ) {
    Class liven_recent_posts_widget extends WP_Widget_Recent_Posts {
        function widget($args, $instance) {
	        extract( $args );
		
            $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Recent Posts','liven'): $instance['title'], $instance, $this->id_base);
				
            if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ){
			    $number = 10;
			}
					
            $liven_recent_posr= new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
            if( $liven_recent_posr->have_posts() ) :
			    echo $before_widget;
                if( $title ){
                    echo '<h3>'. esc_html($title) . '</h3>';
                }
                ?>
                <div>
                    <?php while( $liven_recent_posr->have_posts() ) : $liven_recent_posr->the_post(); ?>
                        <div class="postdiv wow fadeInUp">
                        <?php  
                            $liven_recent_post_image_check = esc_url(wp_get_attachment_url( get_post_thumbnail_id($liven_recent_posr->ID) ));
							if($liven_recent_post_image_check != "") {
							?>
                                <div class="recentblogimg">
                                    <a href="<?php esc_url(the_permalink()); ?>"> <img src="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id($liven_recent_posr->ID) )) ?>" alt="<?php the_title(); ?>" class="img-responsive"> 
                                    </a>
                                </div>
                                <div class="rightpostimg">
                                    <h3>
                                        <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php 
                                        if ( 'post' === get_post_type() ) : 
                                        ?>
                                            <div class="bloginfo">
                                                <i class="fa fa-x fa-user icons-gray"></i> <small> <?php esc_url(the_author_posts_link()); ?></small> 
                                                <a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-x fa-calendar icons-gray"></i> <small><?php echo get_the_date(); ?></small></a>
                                                <i class="fa fa-x fa-comment icons-gray"></i> 
                                                <small>
                                                <?php 
                                                    $comments_count = wp_count_comments( get_the_ID() );
                                                    echo esc_html($comments_count->approved).esc_html__(' Comments ','liven');
                                                ?>
                                                </small>
                                            </div>
                                        <?php
									    endif; 
									?>
                                </div>
                                <div class="clr"></div>
                                <?php
                            }
							else{
							?>
                                <div class="rightpostwithoutimg">
                                    <h3>
                                        <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php 
                                        if ( 'post' === get_post_type() ) : 
                                        ?>
                                            <div class="bloginfo">
                                                <i class="fa fa-x fa-user icons-gray"></i> <small> <?php esc_url(the_author_posts_link()); ?></small> 
                                                <a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-x fa-calendar icons-gray"></i> <small><?php echo get_the_date(); ?></small></a>
                                                <i class="fa fa-x fa-comment icons-gray"></i> 
                                                <small>
                                                <?php 
                                                    $comments_count = wp_count_comments( get_the_ID() );
                                                    echo esc_html($comments_count->approved).esc_html__(' Comments ','liven');
                                                ?>
                                                </small>
                                            </div>
                                        <?php
                                        endif;
                                    ?>
                                </div>
                                <div class="clr"></div>
                                <?php	
                            }
							?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php
			    echo $after_widget;
		        wp_reset_postdata();
		    endif;
        }
    }
}

if ( ! function_exists( 'liven_recent_widget_registration' ) ) :
    function liven_recent_widget_registration() {
        register_widget('liven_recent_posts_widget');
    }
endif;
add_action('widgets_init', 'liven_recent_widget_registration');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
 if ( ! function_exists( 'liven_content_width' ) ) :
function liven_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'liven_content_width', 300 );
}
endif;
add_action( 'after_setup_theme', 'liven_content_width', 0 );

/**
 * Get the cloud
 */

 if ( ! function_exists( 'liven_tags_cloud' ) ) :
function liven_tags_cloud() {
	the_tags( '<ul><li>', '</li><li>', '</li></ul>' );
}
endif;
add_action( 'after_setup_theme', 'liven_tags_cloud', 0 );



/*
    dynamically add css of footer page 
*/
if ( ! function_exists( 'liven_tags_custom_footer_styles_add' ) ) :
function liven_tags_custom_footer_styles_add() {
    $liven_footer_page = get_theme_mod('liven_footer_page');
    $footer_opt        = get_post_meta(get_the_ID(), 'footer_option_key', true);
	
	wp_enqueue_style( 
        'liven_custom_footer_style', 
        get_template_directory_uri() . '/static/css/liven_custom_dynamic_styles.css'
    );
	
    if(!empty($footer_opt)){
        $the_query = new WP_Query( 'page_id='. $footer_opt);
        if ( $footer_opt ) {
            $shortcodes_custom_css = get_post_meta( $footer_opt, '_wpb_shortcodes_custom_css', true );
            if ( ! empty( $shortcodes_custom_css ) ) {
                $shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
                $custom_footer_css = esc_html($shortcodes_custom_css);
                wp_add_inline_style( 'liven_custom_footer_style', $custom_footer_css );
            }
        }
    }
    else{
        if (  $liven_footer_page ) {
            $shortcodes_custom_css = get_post_meta( $liven_footer_page, '_wpb_shortcodes_custom_css', true );
            if ( ! empty( $shortcodes_custom_css ) ) {
                $shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
                $custom_footer_css = esc_html($shortcodes_custom_css);
                wp_add_inline_style( 'liven_custom_footer_style', $custom_footer_css );
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'liven_tags_custom_footer_styles_add',150);
endif;