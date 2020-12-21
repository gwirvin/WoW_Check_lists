<?php
/** File covenant.phpo
Function to get covenant data **/
// Function for covenant
function getToonCovenantObj ($toonCovenantHref, $tokenPrefix, $myOauthToken, array $get = NULL, array $options = array()) {
//      if (isset ($toonCovenantHref)) {
	$defaults = array(
		CURLOPT_URL => $toonCovenantHref,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	);
	$ch = curl_init();
	curl_setopt_array($ch, ($options + $defaults));
	if ( !$result = curl_exec($ch))
	{
		trigger_error(curl_error($ch));
	}
	curl_close($ch);
	$covenantObj = json_decode($result);
	$defaults = array(
		CURLOPT_URL => $covenantObj->media->key->href.$tokenPrefix.$myOauthToken,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	);
	$ch = curl_init();
	curl_setopt_array($ch, ($options + $defaults));
	if ( !$result = curl_exec($ch))
	{
		trigger_error(curl_error($ch));
	}
	curl_close($ch);
	$covenantMediaObj = json_decode($result);
	return "\n\t\t<td bgcolor=\"000000\"><img src=\"".$covenantMediaObj->assets[0]->value."\" style=\"height:30px;width:30px;border:1;\" alt=\"".$covenantObj->name->en_US."\"></td>";
	}
?>
