<?php

	$curl_handle=curl_init();

	$dateFrom = date('d/m/Y', strtotime($_GET['dateFrom']));
	//echo $dateFrom."<br>";
	$dateTo = date('d/m/Y', strtotime($_GET['dateTo']));
	//echo $dateTo;
	//exit;
	
	$departure = $_GET['from'];
	$destination = $_GET['to'];

	//curl_setopt($curl_handle,CURLOPT_URL,'https://api.skypicker.com/flights?flyFrom=PRG&to=LGW&dateFrom=18/11/2020&dateTo=12/12/2020&partner=picky&v=3');
	
	curl_setopt($curl_handle,CURLOPT_URL,'https://api.skypicker.com/aggregation_flights?fly_from='.$departure.'&fly_to='.$destination.'&v=3&date_from='.$dateFrom.'&date_to='.$dateTo.'&max_fly_duration=6&flight_type=oneway&one_for_city=0&one_per_date=1&adults=1&children=0&infants=0&partner=picky&partner_market=us&curr=EUR&locale=en&limit=30&sort=price&asc=1&xml=0');
	

	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	if (empty($buffer)){
	  print "Nothing returned from url.<p>";
	}
	else{
	  print $buffer;
	}
?>