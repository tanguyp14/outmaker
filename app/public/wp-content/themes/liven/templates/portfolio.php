<?php
/**
 * Template part for displaying portfoilio single page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

if(have_posts()) :
    while ( have_posts() ) : the_post();
    ?>
        <div class="middlecontent">
            <div class="container">
                <div class="portfolioslider wow fadeInDown">
                    <div>
                        <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="<?php the_title();?>" />
                    </div>
                </div>
                <div class="clr"></div>
                <div class="row">
                    <div class="skilldescription wow fadeInDown">
                        <div class="col-sm-4 col-md-3">
                            <h3><span><?php echo esc_html__('Categories','liven'); ?></span></h3>
                            <div class="skill">
                                <?php
                                    $term_array = get_the_terms( get_the_ID(), 'portfolio_categories' );
                                    foreach($term_array as $term){
                                        echo "<span class='skilltag'>".ucwords(esc_html($term->name))."</span>";
                                    }
                                ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9 description">
                            <h3><span><?php echo esc_html__('Description','liven'); ?></span></h3>
                            <?php the_content();?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="relateportfolio wow fadeInDown">
                        <?php
                            $term_array1 = get_the_terms( get_the_ID(), 'portfolio_categories' );
                            $count = 1;
							$args = '';
		        			$str_uniq = "";
                            foreach($term_array1 as $term1){
                                $str_uniq.=$term1->slug.',';
                            }

                            $rel_posts = "";
                            $rel_posts = new WP_Query(
					                        array(
					                            'portfolio_categories'=>array( $str_uniq ),
							    	    		'showposts' => '3',
								    	    	'post__not_in' =>array( get_the_ID()),
    										    'orderby' => 'rand'
        									)
	        							);

		    	    		if( $rel_posts->have_posts() ) {
			                ?>
                                <div class="col-md-12">
                                    <h1 class="text-left"><?php echo esc_html__('Related Portfolio','liven'); ?></h1>
                                </div>
                                <?php
                                while ($rel_posts->have_posts()) : $rel_posts->the_post();
					                if($count <= 3){
                                    ?>
                                    <div class="col-sm-6 col-md-4 portfolio-rel">
                                        <a href="<?php echo esc_url(the_permalink()); ?>">
                                            <div class="portfolio1">
                                            <?php
			    		    				    $liven_portfolio_img_url = wp_get_attachment_image_src(  get_post_thumbnail_id(get_the_ID()), 'full');
				    		    				echo ' <img src="'.esc_url($liven_portfolio_img_url[0]).'" class="img-responsive" alt="'.get_the_title().'">';
					    		    		    ?>
                                                <div class="mask-img">
                                                    <div class="zoomicon"><img src="<?php echo esc_url(get_template_directory_uri().'/static/images/zoom-icn.png'); ?>" alt="Zoom"></div>
                                                </div>
                                            </div>
                                            <div class="portfoliotitle">
                                                <h4><?php the_title(); ?></h4>
                                                <span>
                                                <?php
                                                    $term_array = get_the_terms( get_the_ID(), 'portfolio_categories' );
                                                    $last_term_array = end($term_array);
                                                    $lastElement = $last_term_array->name;
                                                    foreach($term_array as $term){
                                                        if($lastElement == $term->name){
                                                            echo ucwords($term->name);
                                                        }
                                                        else{
                                                            echo ucwords($term->name).' | ';
                                                        }
				    				    			}
	    					    				?>
		    					    			</span>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                    }
		    			        endwhile;
			    		        $count++;
					        }
					        wp_reset_postdata();
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endwhile;
endif;