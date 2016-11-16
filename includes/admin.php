<?php

namespace Bacon_Ipsum\SMS\Admin;

function setup() {

	add_action( 'admin_init', __NAMESPACE__ . '\register_settings' );

}

function register_settings() {

	register_setting( 'general', 'bacon-ipsum-sms-twilio-sid',   'sanitize_text_field' );
	register_setting( 'general', 'bacon-ipsum-sms-twilio-token', 'sanitize_text_field' );
	register_setting( 'general', 'bacon-ipsum-sms-twilio-phone', 'sanitize_text_field' );

	add_settings_section( 'bacon-ipsum-sms', 'Bacon Ipsum SMS', null, 'general' );

	add_settings_field( 'bacon-ipsum-sms-twilio-sid',
		'Twilio Account SID', __NAMESPACE__ . '\sid_input', 'general', 'bacon-ipsum-sms' );

	add_settings_field( 'bacon-ipsum-sms-twilio-token',
		'Twilio Token', __NAMESPACE__ . '\token_input', 'general', 'bacon-ipsum-sms' );

	add_settings_field( 'bacon-ipsum-sms-twilio-phone',
		'From Phone #', __NAMESPACE__ . '\phone_input', 'general', 'bacon-ipsum-sms' );
}

function sid_input() {
	$value = get_option( 'bacon-ipsum-sms-twilio-sid' );
	?>
		<input type="text" name="bacon-ipsum-sms-twilio-sid" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
	<?php
}

function token_input() {
	$value = get_option( 'bacon-ipsum-sms-twilio-token' );
	?>
		<input type="text" name="bacon-ipsum-sms-twilio-token" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
	<?php
}

function phone_input() {
	$value = get_option( 'bacon-ipsum-sms-twilio-phone' );
	?>
		<input type="text" name="bacon-ipsum-sms-twilio-phone" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
	<?php
}
