<?php


/** file: blz_oauth_inc.php 
 * This is a function to get OAuth2 tokens that will later be put unto the _SESSION array
 * **/
# Using a curl function to get info
function getOauthToken ($blizzardOauthUrl) {
	$secret = "4lDDBAihtzLRkljrtYmwRTL1L6xZeOGv";
	$clientId = "2abc5bd3a1d64274a2aa9575404cf0e9";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $blizzardOauthUrl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);

	$headers = array();
	$headers[] = "Content-Type: application/x-www-form-urlencoded";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = json_decode(curl_exec($ch));
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close ($ch);
	$resultArray = (array) $result;	
	return $resultArray;
}
?>
