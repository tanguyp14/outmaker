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
function liven_add_custom_footer_meta_box() {
    add_meta_box(
        'liven-footer-options',
        'Select Footer',
        'liven_custom_footer_meta_box_display',
        $screen = null,
        'normal',
        'default'
    ); //you can change the 4th paramter i.e. post to custom post type name, if you want it for something else
}
add_action( 'add_meta_boxes', 'liven_add_custom_footer_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function liven_custom_footer_meta_box_display( $post ) {
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'liven_footer_options', 'liven_footer_options_nonce' );

    /*
    * Use get_post_meta() to retrieve an existing value
    * from the database and use the value for the form.
    */
    
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'footer_template.php'
    ));
    $footer_option = get_post_meta( $post->ID, 'footer_option_key', true ); //footer_option_key is a meta_key. Change it to whatever you want

    ?>
        <p><?php esc_html_e( "Footer Page", 'liven' ); ?></p>
        <select name="liven_footer_opt" id="liven_footer_opt">
            <option value=""><?php esc_html_e('Select Footer',"liven"); ?></option>
        <?php
            foreach($pages as $page){
            ?>
                <option value="<?php echo $page->ID; ?>" <?php if($footer_option == $page->ID){ echo "selected"; } ?>><?php esc_html_e($page->post_title,"liven"); ?></option>
            <?php
            }
        ?>
        </select>
    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function liven_save_custom_footer_meta_box_data( $post_id ) {

    /*
    * We need to verify this came from our screen and with proper authorization,
    * because the save_post action can be triggered at other times.
    */

    // Check if our nonce is set.
    if ( !isset( $_POST['liven_footer_options_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( !wp_verify_nonce( $_POST['liven_footer_options_nonce'], 'liven_footer_options' ) ) {
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
    $liven_new_footer_meta_value = ( isset( $_POST['liven_footer_opt'] ) ? sanitize_html_class( $_POST['liven_footer_opt'] ) : '' );
    // Update the meta field in the database.
    update_post_meta( $post_id, 'footer_option_key', $liven_new_footer_meta_value );
}

add_action( 'save_post', 'liven_save_custom_footer_meta_box_data' );
?>