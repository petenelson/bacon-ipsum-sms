<?php

namespace Bacon_Ipsum\SMS\REST_API;

function setup() {
	add_action( 'rest_api_init', __NAMESPACE__ . '\add_sms_endpoint' );
	add_filter( 'rest_pre_serve_request', __NAMESPACE__ . '\send_bacon_ipsum_response', 10, 3 );
}

function add_sms_endpoint() {

	register_rest_route(
		'bacon-ipsum',
		'v1/sms',
		array(
			'callback'      => __NAMESPACE__ . '\handle_sms_request',
			'methods'       => array( 'GET', 'POST' ),
			'args'          => array(
				'Body' => array(
					'required' => false,
					),
				),

			)
	);

	// TODO add a voice reply option

}

function handle_sms_request( $request ) {

	$args = array(
		'number-of-sentences' => 3,
		'number-of-paragraphs' => 1,
		'max-number-of-paragraphs' => 1,
		'start-with-lorem' => 1,
		'type' => 'meat-and-filler',
		'source' => 'sms',
		'format' => 'text',
	);

	$filler = apply_filters( 'anyipsum-generate-filler', $args );

	$body = trim( strtolower( $request['Body'] ) );

	$response = '';

	if ( 'bacon ipsum' === $body ) {
		$response = reset( $filler );
		$args['output'] = $response;
	} else {
		$response = "Try 'bacon ipsum', it's delicious.";
		$args['error'] = $body;
	}

	// send notification for anything else that's hooked in.
	do_action( 'anyipsum-filler-generated', $args );

	return $response;
}

function send_bacon_ipsum_response( $served, $result, $request ) {
	if ( '/bacon-ipsum/v1/sms' === $request->get_route() ) {
		header( 'Content-Type: text/xml' );
		?><?xml version="1.0" encoding="UTF-8"?>
		<Response>
			<Message><?php echo $result->data; ?></Message>
		</Response><?php
		$served = true;
		exit;
	}
	return $served;
}
