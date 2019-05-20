<?php
	$url = 'https://rest.nexmo.com/sms/json?'. http_build_query(
		[
		  'api_key' =>  'e41079ea',
		  'api_secret' => '409ae162',
		  'to' => '00256783313038',
		  'from' => '00256787151854',
		  'text' => 'Hello from Nexmo'
		]
	);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	echo $response;
	$decoded_response = json_decode($response, true);

	  error_log('You sent ' . $decoded_response['message-count'] . ' messages.');

	  foreach ( $decoded_response['messages'] as $message ) {
		  if ($message['status'] == 0) {
			  error_log("Success " . $message['message-id']);
		  } else {
			  error_log("Error {$message['status']} {$message['error-text']}");
		  }
	  }

?>