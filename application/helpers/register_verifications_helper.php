<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Use the REST API Client to make requests to the Twilio REST API
			use Twilio\Rest\Client;
	
	if ( ! function_exists('mobile_otp'))
	{
	    function mobile_otp($mobile_no = ''){
	        $ci=& get_instance();
	        // Required if your environment does not handle autoloading
			//require __DIR__ . '/vendor/autoload.php';
	        $otp = $ci->session->userdata("mobile_otp");
			// Your Account SID and Auth Token from twilio.com/console
			$sid = 'AC67ba3de3b7345497442587ac29fb10ee';
			$token = '847daf1643ba1009aad61d83b833d47e';
			$client = new Client($sid, $token);

			// Use the client to do fun stuff like send text messages!
			$client = $client->messages->create(
			    // the number you'd like to send the message to
			    '+923077299400',
			    array(
			        // A Twilio phone number you purchased at twilio.com/console
			        'from' => '+14063565283',
			        // the body of the text message you'd like to send
			        'body' => 'Hey Honey this is your OTP'. $otp
			    )
			);
	    }   
	}


?>