<?php
function wbportfolio_fields_get_meta( $value ) {
	global $post;

	$wbportfolio_field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $wbportfolio_field ) ) {
		return is_array( $wbportfolio_field ) ? stripslashes_deep( $wbportfolio_field ) : stripslashes( wp_kses_decode_entities( $wbportfolio_field ) );
	} else {
		return false;
	}
}

function wbportfolio_fields_add_meta_box() {
	add_meta_box(
		'wbportfolio_fields-wbportfolio-fields',
		__( 'wbportfolio Fields', 'wbportfolio_fields' ),
		'wbportfolio_fields_html',
		'wbportfolio',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'wbportfolio_fields_add_meta_box' );

function wbportfolio_fields_html( $post) {
	wp_nonce_field( '_wbportfolio_fields_nonce', 'wbportfolio_fields_nonce' ); ?>

	<p>
		<label for="wbportfolio_fields_company_name"><?php _e( 'Company Name', 'wbportfolio_fields' ); ?></label><br>
		<input type="text" name="wbportfolio_fields_company_name" id="wbportfolio_fields_company_name" value="<?php echo wbportfolio_fields_get_meta( 'wbportfolio_fields_company_name' ); ?>" size="30" placeholder="wpbrim">
	</p>	<p>
		<label for="wbportfolio_fields_project_url"><?php _e( 'Project URL', 'wbportfolio_fields' ); ?></label><br>
		<input type="text" name="wbportfolio_fields_project_url" id="wbportfolio_fields_project_url" value="<?php echo wbportfolio_fields_get_meta( 'wbportfolio_fields_project_url' ); ?>" size="30" placeholder="https://wpbrim.com">
	</p><?php
}

function wbportfolio_fields_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['wbportfolio_fields_nonce'] ) || ! wp_verify_nonce( $_POST['wbportfolio_fields_nonce'], '_wbportfolio_fields_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['wbportfolio_fields_company_name'] ) )
		update_post_meta( $post_id, 'wbportfolio_fields_company_name', esc_attr( $_POST['wbportfolio_fields_company_name'] ) );
	if ( isset( $_POST['wbportfolio_fields_project_url'] ) )
		update_post_meta( $post_id, 'wbportfolio_fields_project_url', esc_attr( $_POST['wbportfolio_fields_project_url'] ) );
}
add_action( 'save_post', 'wbportfolio_fields_save' );

 ?>
