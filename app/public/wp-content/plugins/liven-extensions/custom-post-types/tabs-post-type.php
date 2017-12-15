<?php

function liven_tabs_posttype() {
    // Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Tabs', 'Post Type General Name', 'liven' ),
		'singular_name'       => _x( 'Tab', 'Post Type Singular Name', 'liven' ),
		'menu_name'           => esc_html__( 'Tabs', 'liven' ),
		'parent_item_colon'   => esc_html__( 'Parent Tab', 'liven' ),
		'all_items'           => esc_html__( 'All Tabs', 'liven' ),
		'view_item'           => esc_html__( 'View Tab', 'liven' ),
		'add_new_item'        => esc_html__( 'Add New Tab', 'liven' ),
		'add_new'             => esc_html__( 'Add New', 'liven' ),
		'edit_item'           => esc_html__( 'Edit Tab', 'liven' ),
		'update_item'         => esc_html__( 'Update Tab', 'liven' ),
		'search_items'        => esc_html__( 'Search Tab', 'liven' ),
		'not_found'           => esc_html__( 'Not Found', 'liven' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'liven' ),
	);
	
	$args = array(
		'label'               => esc_html__( 'liven_tabs', 'liven' ),
		'description'         => esc_html__( 'Tab', 'liven' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title',  'editor'),
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
		'menu_icon'            => 'dashicons-editor-table',
		'query_var'            => true,
		'show_admin_column'    => true,
		'capability_type'      => 'post',
        'rewrite'              => true,
	);
    // Registering your Custom Post Type
	register_post_type( 'liven_tabs', $args );
}
add_action( 'init', 'liven_tabs_posttype', 0 );


function liven_remove_tabsdiv_metaboxes(){
	remove_meta_box( 'slugdiv', 'liven_tabs', 'normal' );
}
add_action( 'remove_meta_boxes', 'liven_remove_tabsdiv_metaboxes' );


// ADD NEW COLUMN
function liven_tabs_columns_head($defaults) {
    $defaults['featured_image'] = 'Featured Image';
    return $defaults;
}


add_action('manage_tabs_posts_custom_column', 'liven_tabs_columns_content', 10, 2);
 
?>