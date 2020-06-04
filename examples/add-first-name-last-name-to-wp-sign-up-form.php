<?php
/*
Plugin Name: Jetpack CRM [Example Code]
Plugin URI: https://jetpackcrm.com
Description: This code example adds first name and last name to your WordPress Registration form
Version: 1.0
Author: <a href="https://jetpackcrm.com">Jetpack CRM</a>
*/

	/* 
		Info
		--------
		This is a code example from JetpackCRM.com, 
        it shows you how to add first name and 
        last name to your WordPress registration page
		--------
		We advise you to rename the plugin and function names to fit your project.
		--------
		Guide: 
			https://kb.jetpackcrm.com/knowledge-base/how-to-capture-first-and-last-name/
		--------
		For extra info on WordPress Hooks & Actions: 
			https://developer.wordpress.org/reference/functions/add_filter/

	*/


add_action( 'register_form', 'jetpack_crm_register_form' );
function jetpack_crm_register_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( sanitize_text_field( $_POST['first_name'] ) ) : '';
    $last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( sanitize_text_field( $_POST['last_name'] ) ) : '';

        ?>
        <p>
            <label for="first_name"><?php _e( 'First Name', 'mydomain' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
        </p>

        <p>
            <label for="last_name"><?php _e( 'Last Name', 'mydomain' ) ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
        </p>

        <?php
    }

    //2. Add validation. In this case, we make sure first_name is required.
    add_filter( 'registration_errors', 'jetpack_crm_registration_errors', 10, 3 );
    function jetpack_crm_registration_errors( $errors, $sanitized_user_login, $user_email ) {

        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
            $errors->add( 'first_name_error', __( '<strong>ERROR</strong>: You must include a first name.', 'mydomain' ) );
        }
        if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['first_name'] ) == '' ) {
            $errors->add( 'last_name_error', __( '<strong>ERROR</strong>: You must include a first name.', 'mydomain' ) );
        }
        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'jetpack_crm_user_register' );
    function jetpack_crm_user_register( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', trim( sanitize_text_field($_POST['first_name'] ) ) );
            update_user_meta( $user_id, 'last_name', trim( sanitize_text_field($_POST['last_name'] ) ) );
        }
    }
