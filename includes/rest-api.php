<?php

namespace Bacon_Ipsum\SMS\REST_API;

function setup() {
	add_action( 'rest_api_init', __NAMESPACE__ . '\add_sms_endpoint' );
}

function add_sms_endpoint() {

	register_rest_route(
		'bacon-ipsum',
		'v1/sms',
		array(
			'callback'      => __NAMESPACE__ . '\handle_sms_request',
			'methods'       => array( 'GET', 'POST' ),
			'args'          => array(
				'From' => array(
					'required' => false,
					),
				'Body' => array(
					'required' => false,
					),
				),

			)
	);

	// TODO add a voice reply option

}

function handle_sms_request( $request ) {

	$filler = apply_filters( 'anyipsum-generate-filler', array(
		'number-of-sentences' => 3,
		'max-number-of-paragraphs' => 1,
		'start-with-lorem' => 1,
		)
	);

	$response = new \stdClass();
	$response->send_result = false;
	$response->filler = $filler;

	$client = new \Twilio\Rest\Client( get_option( 'bacon-ipsum-sms-twilio-sid' ), get_option( 'bacon-ipsum-sms-twilio-token' ) );

	$from = $request['From'];
	$body = trim( strtolower( $request['Body'] ) );

	if ( 'bacon ipsum' === $body ) {
		$reply_with = $filler;	
	} else {
		$reply_with = "I don't understand that.";
	}

	// Use the client to do fun stuff like send text messages!
	$client->messages->create(
		// the number you'd like to send the message to
		$from,
		array(
		// A Twilio phone number you purchased at twilio.com/console
			'from' => get_option( 'bacon-ipsum-sms-twilio-phone' ),
			// the body of the text message you'd like to send
			'body' => $reply_with,
		)
	);

	return rest_ensure_response( $response );
}
