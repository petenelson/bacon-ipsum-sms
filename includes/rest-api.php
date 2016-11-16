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
				),

			)
	);

	// TODO add a voice reply option

}

function handle_sms_request() {

	$filler = apply_filters( 'anyipsum-generate-filler', array(
		'number-of-sentences' => 3,
		'max-number-of-paragraphs' => 1,
		'start-with-lorem' => 1,
		)
	);

	return rest_ensure_response( $filler );
}
