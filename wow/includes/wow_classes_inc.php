<?php

/** file: wow_classes_inc.php
 *
 * Trying to get the general data from Blizzard API
 * for use with the toon_obj
 *
 * My hope here, is to do less with processing and
 * more with cramming objects together.
 * **/


# BEGIN: Block for testing
$wow_url = "https://us.api.battle.net/wow/";
$blizz_locale = "locale=en_US";
$api_key = "apikey=fkff3mjw67rm6eqzsf2u9vxgfk4y5b88";
# END: Block for testing

$classUrl = $wow_url."data/character/classes?".$blizz_locale."&".$api_key;

# Using a curl function to get info
function getClassInfo ($classUrl, array $get = NULL, array $options = array())
{
	$defaults = array(
		CURLOPT_URL => $classUrl,
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
	return $result;
}

$classJson = getClassInfo($classUrl);
$classObj = json_decode($classJson);
print_r($classObj);

?>
