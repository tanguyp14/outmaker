<?php
function liven_portfolio_texonomy() {
	$labels = array(
		'name'              => _x( 'Portfolio Categories', 'liven' ),
		'singular_name'     => _x( 'Portfolio Category', 'liven' ),
		'search_items'      => esc_html__( 'Search Portfolio Categories', 'liven' ),
		'all_items'         => esc_html__( 'All Portfolio Categories' , 'liven'),
		'parent_item'       => esc_html__( 'Parent Portfolio Category', 'liven' ),
		'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'liven' ),
		'edit_item'         => esc_html__( 'Edit Portfolio Category' , 'liven'),
		'update_item'       => esc_html__( 'Update Portfolio Category' , 'liven'),
		'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'liven' ),
		'new_item_name'     => esc_html__( 'New Portfolio Category Name' , 'liven'),
		'menu_name'         => esc_html__( 'Portfolio Category' , 'liven'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio_categories' ),
	);
    register_taxonomy( 'portfolio_categories','portfolio', $args );
}
add_action( 'init', 'liven_portfolio_texonomy' );

function liven_portfolio_posttype() {
    // Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Portfolio', 'Post Type General Name', 'liven' ),
		'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'liven' ),
		'menu_name'           => esc_html__( 'Portfolio', 'liven' ),
		'parent_item_colon'   => esc_html__( 'Parent Portfolio', 'liven' ),
		'all_items'           => esc_html__( 'All Portfolios', 'liven' ),
		'view_item'           => esc_html__( 'View Portfolio', 'liven' ),
		'add_new_item'        => esc_html__( 'Add New Portfolio', 'liven' ),
		'add_new'             => esc_html__( 'Add New', 'liven' ),
		'edit_item'           => esc_html__( 'Edit Portfolio', 'liven' ),
		'update_item'         => esc_html__( 'Update Portfolio', 'liven' ),
		'search_items'        => esc_html__( 'Search Portfolio', 'liven' ),
		'not_found'           => esc_html__( 'Not Found', 'liven' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'liven' ),
	);
	
	$args = array(
		'label'               => esc_html__( 'portfolio', 'liven' ),
		'description'         => esc_html__( 'Portfolio ', 'liven' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title',  'editor','thumbnail' ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'portfolio_categories' ),
	
		'hierarchical'         => true,
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_in_admin_bar'    => true,
		'menu_position'        => 100,
		'can_export'           => true,
		'has_archive'          => true,
		'exclude_from_search'  => false,
		'publicly_queryable'   => true,
		'menu_icon'            => 'dashicons-portfolio',
		'query_var'            => true,
		'show_admin_column'    => true,
		'capability_type'      => 'post',
        'rewrite'              => true,
		'register_meta_box_cb' => 'liven_portfolio_metaboxes',
	);
    // Registering your Custom Post Type
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'liven_portfolio_posttype', 0 );


function liven_remove_portfoliodiv_metaboxes(){
	remove_meta_box( 'slugdiv', 'portfolio', 'normal' );
}
add_action( 'remove_meta_boxes', 'liven_remove_portfoliodiv_metaboxes' );


function liven_portfolio_metaboxes() {
	  add_meta_box('liven_portfolio_option', 'Portfolio Options', 'liven_portfolio_option', 'portfolio', 'normal', 'high');
}
add_action( 'add_meta_boxes', 'liven_portfolio_metaboxes' );


function liven_portfolio_option() {
	global $post;
	
	echo '<input type="hidden" name="liven_portfolio_option_noncename" id="liven_portfolio_option_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$pg_link = get_post_meta($post->ID, '_pg_link', true);
	
	// Echo out the field
    echo '<p>'.esc_html__('Link:','liven').'</p>';
	echo '<input type="text" name="_pg_link"  placeholder="Please enter link" value="' . esc_url($pg_link)  . '" class="widefat" />';
}



function liven_portfolio_place_holder($title , $post){
    if( $post->post_type == 'portfolio' ){
        return "Portfolio Title";
    }
    return $title;
}
add_filter('enter_title_here', 'liven_portfolio_place_holder' , 20 , 2 );


// Save the Metabox Data

function liven_save_portfolio_meta($post_id, $post) {
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if (!empty($_POST['liven_portfolio_option_noncename'])){
    	if ( !wp_verify_nonce( $_POST['liven_portfolio_option_noncename'], plugin_basename(__FILE__) )) {
	        return $post->ID;
	    }

	    // Is the user allowed to edit the post or page?
	    if ( !current_user_can( 'edit_post', $post->ID ))
		    return $post->ID;

	    // OK, we're authenticated: we need to find and save the data
	    // We'll put it into an array to make it easier to loop though.
	    $pg_link = get_post_meta($post->ID, '_pg_link', true);
	
        $liven_portfolio_meta['_pg_link'] = $_POST['_pg_link'];
	
    	// Add values of $events_meta as custom fields
	
	    foreach ($liven_portfolio_meta as $key => $value) { // Cycle through the $events_meta array!
		    if( $post->post_type == 'revision' ) return; // Don't store custom data twice
            $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			    update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
			    add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
        }
	}
}
add_action('save_post', 'liven_save_portfolio_meta', 1, 2); // save the custom fields


// ADD NEW COLUMN
function liven_portfolio_columns_head($defaults) {
    $defaults['featured_image'] = 'Featured Image';
    return $defaults;
}


function liven_portfolio_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}


function liven_portfolio_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = liven_portfolio_get_featured_image($post_ID);
        if ($post_featured_image) {
            // HAS A FEATURED IMAGE
            echo '<img style="max-width: 70px;"   src="' . esc_url($post_featured_image) . '" />';
        }
        else {
            // NO FEATURED IMAGE, SHOW THE DEFAULT ONE
            echo '<img style="max-width: 70px;"  src="' . get_bloginfo( 'template_url' ) . '/images/default.jpg" />';
        }
    }
}

add_filter('manage_portfolio_posts_columns', 'liven_portfolio_columns_head', 10);
add_action('manage_portfolio_posts_custom_column', 'liven_portfolio_columns_content', 10, 2);