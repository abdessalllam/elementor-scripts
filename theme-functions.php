/**
 * I got a WP theme and _elementor_data keeps overriding my post_content
 * So, I made the script to prevent that from happening again.
 * Permanently disables Elementor's content override for all products.
 * This function hooks into the product saving process and deletes the
 * '_elementor_data' meta field, forcing the theme to use the
 * standard WordPress content editor (the long description).
 * The script should be in the theme's functions.php file (use Child theme).
 */
add_action( 'save_post_product', 'wes_disable_elementor_for_products', 99, 1 );
function wes_disable_elementor_for_products( $post_id ) {

    // Safety check to prevent it from running on revisions or autosaves.
    if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
        return;
    }

    // Check if the user has permission to edit the post.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Temporarily remove the action to prevent an infinite loop.
    remove_action( 'save_post_product', 'wes_disable_elementor_for_products', 99, 1 );

    // THE KEY ACTION: Delete the Elementor data meta field for this post.
    delete_post_meta( $post_id, '_elementor_data' );

    // Add the action back so it works for the next save.
    add_action( 'save_post_product', 'wes_disable_elementor_for_products', 99, 1 );
}
