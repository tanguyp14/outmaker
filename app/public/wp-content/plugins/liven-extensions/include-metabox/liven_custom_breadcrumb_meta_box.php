<?php
/**
 * Liven Dynamic Style Sheet.
 *
 * @package liven
 */
/**
 * Register a meta box using a class.
 */

/**
 * Adds a box to the main column on the Post add/edit screens.
 */
function liven_add_custom_meta_box() {
    add_meta_box(
        'liven-breadcrumb-options',
        'Page Header Block',
        'liven_custom_meta_box_display',
        $screen = null,
        'normal',
        'default'
    ); //you can change the 4th paramter i.e. post to custom post type name, if you want it for something else
}
add_action( 'add_meta_boxes', 'liven_add_custom_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function liven_custom_meta_box_display( $post ) {
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'liven_breadcrumb_options', 'liven_breadcrumb_options_nonce' );

    /*
    * Use get_post_meta() to retrieve an existing value
    * from the database and use the value for the form.
    */
    $breadcrumb_option = get_post_meta( $post->ID, 'breadcrumb_option_key', true ); //breadcrumb_option_key is a meta_key. Change it to whatever you want
    $pagetitle_option = get_post_meta( $post->ID, 'pagetitle_option_key', true ); //pagetitle_option_key is a meta_key. Change it to whatever you want

    ?>
        <p><?php esc_html_e( "Page Title", 'liven' ); ?></p>
        <input type="radio" name="pagetitle_opt" value="on" checked <?php checked( $pagetitle_option, 'on' ); ?> ><?php esc_html_e( "On", 'liven' ); ?> &emsp;
        <input type="radio" name="pagetitle_opt" value="off" <?php checked( $pagetitle_option, 'off' ); ?> ><?php esc_html_e( "Off", 'liven' ); ?>
        
        <p><?php esc_html_e( "Breadcrumb", 'liven' ); ?></p>
        <input type="radio" name="breadcrumb_opt" value="on" checked <?php checked( $breadcrumb_option, 'on' ); ?> ><?php esc_html_e( "On", 'liven' ); ?> &emsp;
        <input type="radio" name="breadcrumb_opt" value="off" <?php checked( $breadcrumb_option, 'off' ); ?> ><?php esc_html_e( "Off", 'liven' ); ?>
    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function liven_save_custom_meta_box_data( $post_id ) {

    /*
    * We need to verify this came from our screen and with proper authorization,
    * because the save_post action can be triggered at other times.
    */

    // Check if our nonce is set.
    if ( !isset( $_POST['liven_breadcrumb_options_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( !wp_verify_nonce( $_POST['liven_breadcrumb_options_nonce'], 'liven_breadcrumb_options' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Sanitize user input.
    $liven_new_meta_value = ( isset( $_POST['breadcrumb_opt'] ) ? sanitize_html_class( $_POST['breadcrumb_opt'] ) : '' );
    // Update the meta field in the database.
    update_post_meta( $post_id, 'breadcrumb_option_key', $liven_new_meta_value );
    
    $liven_page_title_meta_value = ( isset( $_POST['pagetitle_opt'] ) ? sanitize_html_class( $_POST['pagetitle_opt'] ) : '' );
    // Update the meta field in the database.
    update_post_meta( $post_id, 'pagetitle_option_key', $liven_page_title_meta_value );
}

add_action( 'save_post', 'liven_save_custom_meta_box_data' );
?>