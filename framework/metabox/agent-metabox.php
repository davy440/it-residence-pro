<?php

/**
 *
 *	PHP file for the Metabox containing Property Details
 *
**/
if ( !function_exists('itlst_agent_metabox') ) {
    function itlst_agent_metabox() {
        add_meta_box( 'itre_agent_meta', __( 'Agent Details', 'it-residence' ), 'itlst_agent_meta_callback', 'agent','normal','high' );
    }
    add_action( 'add_meta_boxes', 'itlst_agent_metabox' );
}

/**
 * Outputs the content of the meta box
 */
if ( !function_exists('itlst_agent_meta_callback') ) {
    function itlst_agent_meta_callback( $post ) {
        wp_nonce_field( basename( __FILE__ ), 'itlst_nonce' );
        $itlst_stored_meta = get_post_meta( $post->ID );

        $about	            =	isset( $itlst_stored_meta['about']) ? $itlst_stored_meta['about'][0] : "";
        $designation	    =	isset( $itlst_stored_meta['designation']) ? $itlst_stored_meta['designation'][0] : "";
        $phone	            =	isset( $itlst_stored_meta['phone']) ? $itlst_stored_meta['phone'][0] : 0;
        $mail	            =	isset( $itlst_stored_meta['mail']) ? $itlst_stored_meta['mail'][0] : "";
        ?>
            
            <div class="itre-prop-metafields row">
                <div class="half-width">
                    <label for="about">
                        <h4><?php echo __('About the Author', 'it-residence'); ?></h4>
                        <textarea id="about" name="about" rows="5"><?php echo esc_html__($about, 'it-residence'); ?><?php echo esc_html__($about, 'it-residence'); ?></textarea>
                    </label>
                </div>

                <div class="half-width">
                    <label for="designation">
                        <h4><?php echo __('Designation', 'it-residence'); ?></h4>
                        <input type="text" id="designation" name="designation" value="<?php echo esc_html__($designation, 'it-residence'); ?>" />
                    </label>

                    <label for="phone">
                        <h4><?php echo __('Phone', 'it-residence'); ?></h4>
                        <input type="text" id="phone" name="phone" value="<?php echo esc_html__($phone, 'it-residence'); ?>" />
                    </label>

                    <label for="mail">
                        <h4><?php echo __('Mail', 'it-residence'); ?></h4>
                        <input type="text" id="mail" name="mail" value="<?php echo esc_html__($mail, 'it-residence'); ?>" />
                    </label>
                </div>
            </div>
            
        <?php
    }
}


/**
 * Saves the custom meta input
 */
if ( !function_exists('itlst_agent_meta_save') ) {
    function itlst_agent_meta_save( $post_id ) {

        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'itlst_nonce' ] ) && wp_verify_nonce( $_POST[ 'itlst_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || !$is_valid_nonce ) {
            return;
        }

        $about = isset($_POST['about']) ? sanitize_textarea_field($_POST['about']) : '';
    	update_post_meta( $post_id, 'about', $about);

        $designation = isset($_POST['designation']) ? sanitize_text_field($_POST['designation']) : '';
    	update_post_meta( $post_id, 'designation', $designation);

        $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    	update_post_meta( $post_id, 'phone', $phone);
        
        $mail = isset($_POST['mail']) ? sanitize_text_field($_POST['mail']) : '';
    	update_post_meta( $post_id, 'mail', $mail);
        
        
    }
    add_action( 'save_post', 'itlst_agent_meta_save' );
}